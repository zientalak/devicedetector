<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class FennecVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class FennecVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        if ($match && $context->hasCapability(Capabilities::IS_MOBILE)) {
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_FENNEC)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_MOZILLA)
                ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPattern()
    {
        return '#Fennec\/(?P<version>[^\s]+)#is';
    }
}
