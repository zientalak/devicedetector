<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class SailfishJollaVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class SailfishJollaVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches)
    {
        if ($match) {
            $collector->setCapability(Capabilities::OS, Capabilities::OS_SAILFISH)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_JOLLA)
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_LINUX);
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPattern()
    {
        return '#Sailfish|Jolla#is';
    }
}
