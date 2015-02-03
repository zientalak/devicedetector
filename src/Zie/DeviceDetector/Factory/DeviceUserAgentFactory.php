<?php

namespace Zie\DeviceDetector\Factory;

use Zie\DeviceDetector\CacheProvider\CacheProviderInterface;
use Zie\DeviceDetector\Collector\Collector;
use Zie\DeviceDetector\Detector\CacheDetector;
use Zie\DeviceDetector\Detector\DeviceDetectorInterface;
use Zie\DeviceDetector\Fingerprint\GenericGenerator;
use Zie\DeviceDetector\Token\TokenPool;
use Zie\DeviceDetector\Token\TokenPoolInterface;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\ChromeVisitor;
use Zie\DeviceDetector\Visitor\Browser\ChromiumVisitor;
use Zie\DeviceDetector\Visitor\Browser\FennecVisitor;
use Zie\DeviceDetector\Visitor\Browser\FirefoxVisitor;
use Zie\DeviceDetector\Visitor\Browser\IEVisitor;
use Zie\DeviceDetector\Visitor\Browser\OperaMiniVisitor;
use Zie\DeviceDetector\Visitor\Browser\OperaVisitor;
use Zie\DeviceDetector\Visitor\Browser\SafariVisitor;
use Zie\DeviceDetector\Visitor\MobileVisitor;
use Zie\DeviceDetector\Visitor\OS\AndroidVisitor;
use Zie\DeviceDetector\Visitor\OS\LinuxVisitor;
use Zie\DeviceDetector\Visitor\OS\TizenVisitor;
use Zie\DeviceDetector\Visitor\OS\WindowsPhoneVisitor;
use Zie\DeviceDetector\Visitor\OS\WindowsVisitor;
use Zie\DeviceDetector\Visitor\RobotVisitor;
use Zie\DeviceDetector\Visitor\SmartTVVisitor;
use Zie\DeviceDetector\VisitorManager\VisitorManager;

/**
 * Class DeviceUserAgentFactory
 * @package Zie\DeviceDetector\Factory
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
     * @param CacheProviderInterface $cacheProvider
     */
    public function __construct(CacheProviderInterface $cacheProvider = null)
    {
        $this->tokenPool = new TokenPool();
        $detectorClass = is_null($cacheProvider)
            ? '\Zie\DeviceDetector\Detector\DeviceDetector' : '\Zie\DeviceDetector\Detector\CacheDetector';

        $this->deviceDetector = new $detectorClass(
            $this->createVisitorManager(),
            $this->tokenPool,
            new Collector()
        );

        if ($this->deviceDetector instanceof CacheDetector) {
            $this->deviceDetector->setFingerprintGenerator(new GenericGenerator())
                ->setCacheProvider($cacheProvider);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($userAgent)
    {
        $this->tokenPool->clear();
        $this->tokenPool->addToken(new UserAgentToken($userAgent));

        return $this->deviceDetector->detect();
    }

    /**
     * @return self
     */
    private function createVisitorManager()
    {
        $visitorManager = new VisitorManager();

        $visitorManager->addVisitor(new RobotVisitor(), 1)
            ->addVisitor(new SmartTVVisitor())
            ->addVisitor(new MobileVisitor())
            ->addVisitor(new AndroidVisitor())
            ->addVisitor(new LinuxVisitor())
            ->addVisitor(new TizenVisitor())
            ->addVisitor(new WindowsPhoneVisitor())
            ->addVisitor(new WindowsVisitor())
            ->addVisitor(new ChromeVisitor())
            ->addVisitor(new ChromiumVisitor())
            ->addVisitor(new FennecVisitor())
            ->addVisitor(new FirefoxVisitor())
            ->addVisitor(new IEVisitor())
            ->addVisitor(new OperaMiniVisitor())
            ->addVisitor(new OperaVisitor())
            ->addVisitor(new SafariVisitor());

        return $visitorManager;
    }
}
