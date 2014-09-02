<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class LinuxVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class LinuxVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
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