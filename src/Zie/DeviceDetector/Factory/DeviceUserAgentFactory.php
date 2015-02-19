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
use Zie\DeviceDetector\Visitor\Apple;
use Zie\DeviceDetector\Visitor\Browser;
use Zie\DeviceDetector\Visitor\MobileVisitor;
use Zie\DeviceDetector\Visitor\OS;
use Zie\DeviceDetector\Visitor\Robot;
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

        if (!is_null($this->deviceDetector) && $this->deviceDetector instanceof CacheDetector) {
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

        $this
            ->applyRobots($visitorManager)
            ->applySmartTV($visitorManager)
            ->applyMobile($visitorManager)
            ->applyOS($visitorManager)
            ->applyBrowsers($visitorManager);

        return $visitorManager;
    }

    /**
     * @param VisitorManager $visitorManager
     * @return self
     */
    private function applyRobots(VisitorManager $visitorManager)
    {
        $visitorManager
            ->addVisitor(new RobotVisitor(), 255)
            ->addVisitor(new Robot\AcoonBotVisitor(), 250)
            ->addVisitor(new Robot\AboundexVisitor(), 250)
            ->addVisitor(new Robot\AddThisVisitor(), 250)
            ->addVisitor(new Robot\AhrefsBotVisitor(), 250)
            ->addVisitor(new Robot\AlexaCrawlerVisitor(), 250)
            ->addVisitor(new Robot\Spider360Visitor(), 250);

        return $this;
    }

    /**
     * @param VisitorManager $visitorManager
     * @return self
     */
    private function applySmartTV(VisitorManager $visitorManager)
    {
        $visitorManager
            ->addVisitor(new SmartTVVisitor());

        return $this;
    }

    /**
     * @param VisitorManager $visitorManager
     * @return self
     */
    private function applyMobile(VisitorManager $visitorManager)
    {
        $visitorManager
            ->addVisitor(new MobileVisitor());

        return $this;
    }

    /**
     * @param VisitorManager $visitorManager
     * @return self
     */
    private function applyOS(VisitorManager $visitorManager)
    {
        $visitorManager
            ->addVisitor(new OS\AndroidVisitor())
            ->addVisitor(new OS\LinuxVisitor())
            ->addVisitor(new OS\TizenVisitor())
            ->addVisitor(new OS\WindowsPhoneVisitor())
            ->addVisitor(new OS\WindowsVisitor())
            ->addVisitor(new OS\WindowsCEVisitior())
            ->addVisitor(new OS\WindowsMobileVisitor())
            ->addVisitor(new OS\WindowsRTVisitor())
            ->addVisitor(new OS\SailfishJollaVisitor())
            ->addVisitor(new OS\TizenVisitor())
            ->addVisitor(new OS\AndroidRomsVisitor())
            ->addVisitor(new OS\AmigaOSVisitor())
            ->addVisitor(new Apple\OSXVisitor())
            ->addVisitor(new Apple\IPadVisitor())
            ->addVisitor(new Apple\IPhoneVisitor())
            ->addVisitor(new Apple\IPodTouchVisitor());

        return $this;
    }

    /**
     * @param VisitorManager $visitorManager
     * @return self
     */
    private function applyBrowsers(VisitorManager $visitorManager)
    {
        $visitorManager
            ->addVisitor(new Browser\ChromeVisitor())
            ->addVisitor(new Browser\ChromiumVisitor())
            ->addVisitor(new Browser\FennecVisitor())
            ->addVisitor(new Browser\FirefoxVisitor())
            ->addVisitor(new Browser\IEVisitor())
            ->addVisitor(new Browser\OperaMiniVisitor())
            ->addVisitor(new Browser\OperaVisitor())
            ->addVisitor(new Browser\SafariVisitor())
            ->addVisitor(new Browser\AmigaBrowserVisitor());

        return $this;
    }
}
