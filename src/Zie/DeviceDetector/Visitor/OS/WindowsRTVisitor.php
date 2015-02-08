<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsRTVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class WindowsRTVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var array
     */
    private $patterns = array(
        '#Windows NT 6.2; ARM;#is' => '8',
        '#Windows NT 6.3; ARM;#is' => '8.1'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();
        foreach ($this->patterns as $pattern => $version) {
            if (preg_match($pattern, $userAgent)) {
                $collector->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS_RT)
                    ->setCapability(Capabilities::OS_VERSION, $version)
                    ->setCapability(Capabilities::OS_VERSION_FULL, $version)
                    ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT)
                    ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_WINDOWS);
                break;
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
