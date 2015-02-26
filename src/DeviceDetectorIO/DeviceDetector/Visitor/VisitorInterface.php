<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Exception\VisitorNotAcceptableException;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface VisitorInterface
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
interface VisitorInterface
{
    const STATE_SEEKING = 0;
    const STATE_FOUND = 1;

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @return boolean
     */
    public function accept(TokenInterface $token, CollectorInterface $collector);

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @return integer
     */
    public function visit(TokenInterface $token, CollectorInterface $collector);
}
