<?php

namespace Zie\DeviceDetector\Detector;

use Zie\DeviceDetector\CacheProvider\CacheProviderInterface;
use Zie\DeviceDetector\CacheProvider\InMemoryProvider;
use Zie\DeviceDetector\Context\Context;
use Zie\DeviceDetector\Fingerprint\Sha1Generator;
use Zie\DeviceDetector\Token\TokenPool;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\AndroidVisitor;
use Zie\DeviceDetector\Visitor\AppleVisitor;
use Zie\DeviceDetector\Visitor\ChromeVisitor;
use Zie\DeviceDetector\Visitor\FennecVisitor;
use Zie\DeviceDetector\Visitor\FirefoxVisitor;
use Zie\DeviceDetector\Visitor\LinuxVisitor;
use Zie\DeviceDetector\Visitor\MobileVisitor;
use Zie\DeviceDetector\Visitor\MsieVisitor;
use Zie\DeviceDetector\Visitor\OperaMiniVisitor;
use Zie\DeviceDetector\Visitor\OperaVisitor;
use Zie\DeviceDetector\Visitor\RobotVisitor;
use Zie\DeviceDetector\Visitor\SafariVisitor;
use Zie\DeviceDetector\Visitor\SmartTVVisitor;
use Zie\DeviceDetector\Visitor\WindowsPhoneVisitor;
use Zie\DeviceDetector\Visitor\WindowsVisitor;
use Zie\DeviceDetector\VisitorManager\VisitorManager;

/**
 * Class Factory
 * @package Zie\DeviceDetector\Detector
 */
class Factory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createDeviceDetectorFromUserAgent($userAgent)
    {
        $tokenPool = $this->createTokenPool();
        $tokenPool->addToken($this->createUserAgentToken($userAgent));

        return new DeviceDetector(
            $this->createVisitorManager(),
            $tokenPool,
            $this->createContext()
        );
    }

    /**
     * @param $userAgent
     * @param CacheProviderInterface $cacheProvider
     * @return CacheDetector
     */
    public function createCacheDeviceDetectorFromUserAgent(
        $userAgent,
        CacheProviderInterface $cacheProvider = null
    ) {
        $detector = $this->createDeviceDetectorFromUserAgent($userAgent);

        return new CacheDetector(
            $detector,
            $this->resolveCacheProvider($cacheProvider),
            $this->createFingerprintGenerator()
        );
    }


    /**
     * @return VisitorManager
     */
    private function createVisitorManager()
    {
        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor(new RobotVisitor());
        $visitorManager->addVisitor(new SmartTVVisitor());
        $visitorManager->addVisitor(new MobileVisitor());
        $visitorManager->addVisitor(new AndroidVisitor());
        $visitorManager->addVisitor(new AppleVisitor());
        $visitorManager->addVisitor(new WindowsPhoneVisitor());
        $visitorManager->addVisitor(new WindowsVisitor());
        $visitorManager->addVisitor(new LinuxVisitor());

        $visitorManager->addVisitor(new ChromeVisitor());
        $visitorManager->addVisitor(new SafariVisitor());
        $visitorManager->addVisitor(new FennecVisitor());
        $visitorManager->addVisitor(new FirefoxVisitor());
        $visitorManager->addVisitor(new MsieVisitor());
        $visitorManager->addVisitor(new OperaMiniVisitor());
        $visitorManager->addVisitor(new OperaVisitor());

        return $visitorManager;
    }

    /**
     * @return TokenPool
     */
    private function createTokenPool()
    {
        return new TokenPool();
    }

    /**
     * @param string $userAgent
     * @return UserAgentToken
     */
    private function createUserAgentToken($userAgent)
    {
        return new UserAgentToken($userAgent);
    }

    /**
     * @return Context
     */
    private function createContext()
    {
        return new Context();
    }

    /**
     * @return Sha1Generator
     */
    private function createFingerprintGenerator()
    {
        return new Sha1Generator();
    }

    /**
     * @param CacheProviderInterface $cacheProvider
     * @return InMemoryProvider|CacheProviderInterface
     */
    private function resolveCacheProvider(CacheProviderInterface $cacheProvider = null)
    {
        if (is_null($cacheProvider)) {
            $cacheProvider = new InMemoryProvider();
        }

        return $cacheProvider;
    }
}
