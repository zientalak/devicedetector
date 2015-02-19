<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

class AmigaOSVisitor extends AbstractPatternVisitor
{
    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @param boolean $match
     * @param array $matches
     * @return integer
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches)
    {
        if ($match) {
            $collector->setCapability(Capabilities::OS, Capabilities::OS_AMIGA);

            if (isset($matches['version'])) {
                $collector->setCapability(Capabilities::OS_VERSION, $matches['version'])
                    ->setCapability(Capabilities::OS_VERSION_FULL, $matches['version']);
            }

            return VisitorInterface::STATE_SEEKING;
        }
    }

    /**
     * @return string
     */
    protected function getPattern()
    {
        return '#amigaos (?P<version>[\d+\.]+)|amiga#is';
    }
}
