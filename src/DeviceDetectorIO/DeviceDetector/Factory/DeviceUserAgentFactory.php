<?php

namespace DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\CacheProvider\GenericProvider;
use DeviceDetectorIO\DeviceDetector\Collector\Collector;
use DeviceDetectorIO\DeviceDetector\Detector\CacheDetector;
use DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface;
use DeviceDetectorIO\DeviceDetector\Fingerprint\GenericGenerator;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\IssetMatchingStrategy;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyChain;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\RegexMatchingStrategy;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\StriposMatchingStrategy;
use DeviceDetectorIO\DeviceDetector\Rule\JsonRepository;
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
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache = null)
    {
        $this->tokenPool = new TokenPool();
        $detectorClass = null === $cache
            ? '\DeviceDetectorIO\DeviceDetector\Detector\DeviceDetector' : '\DeviceDetectorIO\DeviceDetector\Detector\CacheDetector';

        $this->deviceDetector = new $detectorClass(
            $this->createVisitorManager(),
            $this->tokenPool,
            new Collector()
        );

        if (null !== $this->deviceDetector && $this->deviceDetector instanceof CacheDetector) {
            $this->deviceDetector->setFingerprintGenerator(new GenericGenerator())
                ->setCacheProvider(new GenericProvider($cache));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($userAgent)
    {
        $userAgentToken = new UserAgentToken($userAgent);
        $userAgentTokenizedToken = new UserAgentTokenizedToken(
            $userAgentToken,
            new UserAgentTokenizer()
        );

        $this->tokenPool->clear();
        $this->tokenPool->addToken($userAgentToken);
        $this->tokenPool->addToken($userAgentTokenizedToken);

        return $this->deviceDetector->detect();
    }

    /**
     * @return self
     */
    private function createVisitorManager()
    {
        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($this->createRepositoryVisitor(), 1);

        return $visitorManager;
    }

    /**
     * @return JsonRepository
     */
    private function createRepository()
    {
        $repository = new JsonRepository();
        $repository->setFilePath(__DIR__ . '/../../../../resources/rules/json/basic.json');

        return $repository;
    }

    /**
     * @return MatchingStrategyChain
     */
    private function createMatchingStrategy()
    {
        $strategyChain = new MatchingStrategyChain();
        $strategyChain->addStrategy(new RegexMatchingStrategy());
        $strategyChain->addStrategy(new StriposMatchingStrategy());
        $strategyChain->addStrategy(new IssetMatchingStrategy());

        return $strategyChain;
    }

    private function createRepositoryVisitor()
    {
        return new Visitor\RepositoryVisitor(
            $this->createRepository(),
            $this->createMatchingStrategy()
        );
    }
}
