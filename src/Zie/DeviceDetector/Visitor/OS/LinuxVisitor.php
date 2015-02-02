<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class LinuxVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class LinuxVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        $userAgent = $token->getData();
        $x11 = stripos($userAgent, 'x11');
        $linux = stripos($userAgent, 'linux');

        if ($x11 || $linux) {
            $context->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_LINUX);
            if (!$context->hasCapability(Capabilities::OS)) {
                $context->setCapability(Capabilities::OS, Capabilities::OS_FAMILY_LINUX);
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
