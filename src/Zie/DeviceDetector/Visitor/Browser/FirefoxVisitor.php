<?php

namespace Zie\DeviceDetector\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class FirefoxVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class FirefoxVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches)
    {
        if ($match) {
            $collector->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_FIREFOX)
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
        return '#Firefox\/(?P<version>[^\s]+)#is';
    }
}
