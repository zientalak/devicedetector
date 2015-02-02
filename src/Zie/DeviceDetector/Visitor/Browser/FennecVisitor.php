<?php

namespace Zie\DeviceDetector\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class FennecVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class FennecVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, array $matches)
    {
        if ($match) {
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
