<?php

namespace DeviceDetectorIO\DeviceDetector\VisitorManager;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;

/**
 * Interface VisitorManagerInterface
 * @package DeviceDetectorIO\DeviceDetector\VisitorManager
 */
interface VisitorManagerInterface
{
    /**
     * @param VisitorInterface $visitor
     * @param int $priority
     * @return self
     */
    public function addVisitor(VisitorInterface $visitor, $priority = 0);

    /**
     * @param VisitorInterface $visitor
     * @return boolean
     */
    public function hasVisitor(VisitorInterface $visitor);

    /**
     * @param VisitorInterface $visitor
     * @return self
     */
    public function removeVisitor(VisitorInterface $visitor);

    /**
     * @return \Traversable|array
     */
    public function getVisitors();

    /**
     * @return VisitorManagerInterface
     */
    public function clear();

    /**
     * @param TokenPoolInterface $tokenPool
     * @param CollectorInterface $context
     * @return self
     */
    public function visit(TokenPoolInterface $tokenPool, CollectorInterface $context);
}
