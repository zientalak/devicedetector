<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class TizenVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class TizenVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches)
    {
        if ($match) {
            $collector->setCapability(Capabilities::OS, Capabilities::OS_TIZEN)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_SAMSUNG)
                ->setCapability(Capabilities::OS_VERSION, $matches['version'])
                ->setCapability(Capabilities::OS_VERSION_FULL, $matches['version'])
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_LINUX);
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPattern()
    {
        return '#Tizen[\s/](?P<version>[^\s-;]+)#is';
    }
}
