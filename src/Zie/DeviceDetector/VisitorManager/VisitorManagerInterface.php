<?php

namespace Zie\DeviceDetector\VisitorManager;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenPoolInterface;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Interface VisitorManagerInterface
 * @package Zie\DeviceDetector\VisitorManager
 */
interface VisitorManagerInterface
{
    /**
     * @param VisitorInterface $visitor
     * @param int $priority
     * @return VisitorManagerInterface
     */
    public function addVisitor(VisitorInterface $visitor, $priority = 0);

    /**
     * @param VisitorInterface $visitor
     * @return boolean
     */
    public function hasVisitor(VisitorInterface $visitor);

    /**
     * @param VisitorInterface $visitor
     * @return VisitorManagerInterface
     */
    public function removeVisitor(VisitorInterface $visitor);

    /**
     * @return \Iterator
     */
    public function getVisitors();

    /**
     * @return VisitorManagerInterface
     */
    public function clear();

    /**
     * @param TokenPoolInterface $tokenPool
     * @param CollectorInterface $context
     * @return VisitorManagerInterface
     */
    public function visit(TokenPoolInterface $tokenPool, CollectorInterface $context);
}
