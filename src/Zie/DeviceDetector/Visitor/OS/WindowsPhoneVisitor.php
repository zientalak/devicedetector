<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsPhoneVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class WindowsPhoneVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $patternWindowsPhone = '#Windows Phone|NativeHost#is';

    /**
     * @var string
     */
    private $specificWindowsPhone7 = '#XBLWP7|ZuneWP7#is';

    /**
     * @var string
     */
    private $patternWindowsPhoneVersion = '#(Windows Phone|Windows Phone OS) (?P<version>[\d\.]+)#is';

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();

        if (preg_match($this->patternWindowsPhone, $userAgent)) {
            $collector->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS_PHONE)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT)
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_WINDOWS);

            $matches = array();
            if (preg_match($this->patternWindowsPhoneVersion, $userAgent, $matches)) {
                $collector->setCapability(Capabilities::OS_VERSION, $matches['version'])
                        ->setCapability(Capabilities::OS_VERSION_FULL, $matches['version']);
            }
        }

        if (preg_match($this->specificWindowsPhone7, $userAgent, $matches)) {
            $collector->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS_PHONE)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT)
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_WINDOWS)
                ->setCapability(Capabilities::OS_VERSION, '7')
                ->setCapability(Capabilities::OS_VERSION_FULL, '7');
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
