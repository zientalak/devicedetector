<?php

namespace Zie\DeviceDetector\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class ChromiumVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class ChromeVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, array $matches)
    {
        if ($match) {
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_CHROME)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_GOOGLE)
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
        return '#chrome\/(?P<version>[^\s]+)#is';
    }
}
