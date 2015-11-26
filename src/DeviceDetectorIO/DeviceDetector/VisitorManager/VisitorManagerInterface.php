<?php

namespace DeviceDetectorIO\DeviceDetector\VisitorManager;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;

/**
 * Interface VisitorManagerInterface.
 */
interface VisitorManagerInterface extends \IteratorAggregate
{
    /**
     * @param VisitorInterface $visitor
     * @param int              $priority
     *
     * @return bool
     */
    public function add(VisitorInterface $visitor, $priority = 0);

    /**
     * @param VisitorInterface $visitor
     *
     * @return bool
     */
    public function has(VisitorInterface $visitor);

    /**
     * @param VisitorInterface $visitor
     *
     * @return bool
     */
    public function remove(VisitorInterface $visitor);

    /**
     * @return bool
     */
    public function removeAll();

    /**
     * @param TokenPoolInterface $pool
     * @param CollatorInterface  $collector
     *
     * @return self
     */
    public function visit(TokenPoolInterface $pool, CollatorInterface $collector);

    /**
     * @return \Iterator
     */
    public function getVisitors();
}
