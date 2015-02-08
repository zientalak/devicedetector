<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Interface VisitorInterface
 * @package Zie\DeviceDetector\Visitor
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
