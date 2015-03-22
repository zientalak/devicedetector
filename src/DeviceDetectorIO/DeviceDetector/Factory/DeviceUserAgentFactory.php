<?php

namespace DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\CacheProvider\GenericProvider;
use DeviceDetectorIO\DeviceDetector\Collector\Collector;
use DeviceDetectorIO\DeviceDetector\Detector\CacheDetector;
use DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface;
use DeviceDetectorIO\DeviceDetector\Fingerprint\GenericGenerator;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyChain;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\RegexMatchingStrategy;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\StringMatchingStrategy;
use DeviceDetectorIO\DeviceDetector\Rule\CacheRepository;
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
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache = null)
    {
        $this->cache = $cache;
        $this->tokenPool = new TokenPool();
        $detectorClass = null === $this->cache
            ? '\DeviceDetectorIO\DeviceDetector\Detector\DeviceDetector' : '\DeviceDetectorIO\DeviceDetector\Detector\CacheDetector';

        $this->deviceDetector = new $detectorClass(
            $this->createVisitorManager(),
            $this->tokenPool,
            new Collector()
        );

        if (null !== $this->deviceDetector && $this->deviceDetector instanceof CacheDetector) {
            $this->deviceDetector->setFingerprintGenerator(new GenericGenerator())
                ->setCacheProvider(new GenericProvider($this->cache));
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
        $this->tokenPool->addToken($userAgentTokenizedToken);
        $this->tokenPool->addToken($userAgentToken);

        return $this->deviceDetector->detect();
    }

    /**
     * @return self
     */
    private function createVisitorManager()
    {
        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor(
            $this->createRepositoryVisitor(
                __DIR__ . '/../../../../resources/rules/json/basic.json'
            ),
            250
        );
        $visitorManager->addVisitor(new Visitor\Apple\OSXVisitor());
        $visitorManager->addVisitor(new Visitor\Apple\IPadVisitor());
        $visitorManager->addVisitor(new Visitor\Apple\IPhoneVisitor());
        $visitorManager->addVisitor(new Visitor\Apple\IPodTouchVisitor());
        $visitorManager->addVisitor(new Visitor\OS\AndroidReleaseVisitor(), 1);
        $visitorManager->addVisitor(
            $this->createRepositoryVisitor(
                __DIR__ . '/../../../../resources/rules/json/brands.json'
            ),
            -254
        );
        $visitorManager->addVisitor(new Visitor\EndPointVisitor(), -255);

        return $visitorManager;
    }

    /**
     * @param string $path
     * @return JsonRepository
     */
    private function createRepository($path)
    {
        $repository = new JsonRepository();
        $repository->setFilePath($path);

        if (null !== $this->cache) {
            $cacheRepository = new CacheRepository($repository, $this->cache);
            $cacheRepository->setCacheKey('BasicRules');

            return $cacheRepository;
        }

        return $repository;
    }

    /**
     * @return MatchingStrategyChain
     */
    private function createMatchingStrategy()
    {
        $strategyChain = new MatchingStrategyChain();
        $strategyChain->addStrategy(new RegexMatchingStrategy());
        $strategyChain->addStrategy(new StringMatchingStrategy());

        return $strategyChain;
    }

    private function createRepositoryVisitor($path)
    {
        return new Visitor\RepositoryVisitor(
            $this->createRepository($path),
            $this->createMatchingStrategy()
        );
    }
}
