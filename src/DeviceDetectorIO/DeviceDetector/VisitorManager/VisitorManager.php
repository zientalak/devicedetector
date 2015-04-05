<?php

namespace DeviceDetectorIO\DeviceDetector\VisitorManager;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class VisitorManager
 * @package DeviceDetectorIO\DeviceDetector\VisitorManager
 */
class VisitorManager implements VisitorManagerInterface
{
    /**
     * @var array
     */
    private $visitors;
    /**
     * @var array
     */
    private $priority;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->removeAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->getVisitors();
    }

    /**
     * {@inheritdoc}
     */
    public function add(VisitorInterface $visitor, $priority = 0)
    {
        $splHashObject = spl_object_hash($visitor);
        if (isset($this->visitors[$splHashObject])) {
            return false;
        }

        $priority = (int)$priority;
        if (!isset($this->priority[$priority])) {
            $this->priority[$priority] = array();
        }

        $this->priority[$priority][] = $visitor;
        $this->visitors[$splHashObject] = $visitor;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function has(VisitorInterface $visitor)
    {
        return isset($this->visitors[spl_object_hash($visitor)]);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(VisitorInterface $visitor)
    {
        $splHashObject = spl_object_hash($visitor);
        if (isset($this->visitors[$splHashObject])) {
            unset($this->visitors[$splHashObject]);
            foreach ($this->priority as &$priorityVisitors) {
                $key = array_search($visitor, $priorityVisitors, true);
                if (false !== $key) {
                    unset($priorityVisitors[$key]);
                    break;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll()
    {
        $this->visitors = $this->priority = array();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function visit(TokenPoolInterface $pool, CollatorInterface $collector)
    {
        /** @var $visitor VisitorInterface */
        foreach ($this as $visitor) {
            /** @var $token TokenInterface */
            foreach ($pool as $token) {
                if ($visitor->accept($token, $collector)) {
                    if (VisitorInterface::STATE_FOUND === $visitor->visit($token, $collector)) {
                        break;
                    }
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVisitors()
    {
        ksort($this->priority);
        $visitors = array();
        foreach ($this->priority as $priorityVisitors) {
            $visitors = array_merge($priorityVisitors, $visitors);
        }
        return new \ArrayIterator($visitors);
    }
}
