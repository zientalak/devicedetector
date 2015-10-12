<?php

namespace DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\Capability\Collator;
use DeviceDetectorIO\DeviceDetector\Detector\CacheDetector;
use DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface;
use DeviceDetectorIO\DeviceDetector\DeviceCache\GenericDeviceCache;
use DeviceDetectorIO\DeviceDetector\Fingerprint\GenericGenerator;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\RegexEvaluator;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver\Resolver;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\StrposEvalulator;
use DeviceDetectorIO\DeviceDetector\Rule\Comparer\TypeAndValueComparer;
use DeviceDetectorIO\DeviceDetector\Rule\Incrementation\Incrementation;
use DeviceDetectorIO\DeviceDetector\Rule\Matcher\IndexableMatcher;
use DeviceDetectorIO\DeviceDetector\Rule\Matcher\NonIndexableMatcher;
use DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\PriorityAndCategoryMergingStrategy;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\DynamicCapabilitiesProcessor;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\OccurrencesAnalyser;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder\Finder;
use DeviceDetectorIO\DeviceDetector\Rule\Repository\PHPRepository;
use DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPool;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use DeviceDetectorIO\DeviceDetector\Visitor;
use DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManager;

/**
 * Class DeviceUserAgentFactory
 * @package DeviceDetectorIO\DeviceDetector\Factory
 */
class DeviceUserAgentFactory implements DeviceUserAgentFactoryInterface
{
    /**
     * @var DeviceDetectorInterface
     */
    protected $deviceDetector;

    /**
     * @var TokenPoolInterface
     */
    protected $tokenPool;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @param CacheInterface $cache
     * @param bool $cacheResult
     */
    public function __construct(CacheInterface $cache = null)
    {
        $this->cache = $cache;
        $this->tokenPool = new TokenPool();
        $detectorClass = null === $this->cache
            ? '\DeviceDetectorIO\DeviceDetector\Detector\DeviceDetector' : '\DeviceDetectorIO\DeviceDetector\Detector\CacheDetector';

        $this->deviceDetector = new $detectorClass(
            $this->createVisitorManager(),
            new Collator()
        );

        if (null !== $this->deviceDetector && $this->deviceDetector instanceof CacheDetector) {
            $this->deviceDetector->setFingerprintGenerator(new GenericGenerator())
                ->setDeviceCache(new GenericDeviceCache($this->cache));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($userAgent)
    {
        $userAgentTokenizedToken = new UserAgentTokenizedToken(
            new UserAgentToken($userAgent),
            new UserAgentTokenizer()
        );

        $this->tokenPool->removeAll();
        $this->tokenPool->add($userAgentTokenizedToken);

        return $this->deviceDetector->detect($this->tokenPool);
    }

    /**
     * @return self
     */
    private function createVisitorManager()
    {
        $visitorManager = new VisitorManager();
        $visitorManager->add(
            $this->createIndexableVisitor(
                __DIR__.'/../../../../resources/rules/php/rules.php'
            ),
            255
        );
        $visitorManager->add(
            $this->createNonIndexableVisitor(
                __DIR__.'/../../../../resources/rules/php/rules.php'
            ),
            254
        );

        $visitorManager->add(new Visitor\BlinkBrowserEngineVisitor(), -255);
        $visitorManager->add(new Visitor\OperaMiniVersionNormalizerVisitor(), -255);
        $visitorManager->add(new Visitor\EndPointVisitor(), -255);

        return $visitorManager;
    }

    private function createNonIndexableVisitor($path)
    {
        $resolver = new Resolver();
        $resolver->add(new RegexEvaluator());
        $resolver->add(new StrposEvalulator());

        $matcher = new NonIndexableMatcher(
            $this->createRepository($path),
            $resolver
        );

        return new Visitor\RulesVisitor($matcher, new PriorityAndCategoryMergingStrategy());
    }

    private function createIndexableVisitor($path)
    {
        $finder = new Finder(
            $this->createRepository($path),
            new TypeAndValueComparer()
        );

        $matcher = new IndexableMatcher(
            $finder,
            new OccurrencesAnalyser(new Incrementation(), new DynamicCapabilitiesProcessor())
        );

        return new Visitor\RulesVisitor($matcher, new PriorityAndCategoryMergingStrategy());
    }

    /**
     * @param string $path
     * @return PHPRepository
     */
    private function createRepository($path)
    {
        if (is_null($this->repository)) {
            $this->repository = new PHPRepository();
            $this->repository->setFilePath($path);
        }

        return $this->repository;
    }
}
