<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractMachVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsCEVisitior
 * @package Zie\DeviceDetector\Visitor
 */
class WindowsCEVisitior extends AbstractMachVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, $strpos)
    {
        if ($match) {
            $collector->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS_CE)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT)
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_WINDOWS);
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPattern()
    {
        return 'Windows CE';
    }
}
