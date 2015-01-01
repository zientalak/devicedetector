<?php

namespace Zie\DeviceDetector\VisitorManager;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\UnknownStateException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\TokenPoolInterface;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class VisitorManager
 * @package Zie\DeviceDetector\VisitorManager
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
     * @var array
     */
    private $knownStates = array(
        VisitorInterface::STATE_FOUND,
        VisitorInterface::STATE_SEEKING
    );

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clear();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->visitors = $this->priority = array();
    }

    /**
     * {@inheritdoc}
     */
    public function addVisitor(VisitorInterface $visitor, $priority = 0)
    {
        $splHashObject = spl_object_hash($visitor);
        if (isset($this->visitors[$splHashObject])) {
            return $this;
        }

        $priority = (int)$priority;
        if (!isset($this->priority[$priority])) {
            $this->priority[$priority] = array();
        }

        $this->priority[$priority][] = $visitor;
        $this->visitors[$splHashObject] = $visitor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasVisitor(VisitorInterface $visitor)
    {
        return isset($this->visitors[spl_object_hash($visitor)]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeVisitor(VisitorInterface $visitor)
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

        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function visit(TokenPoolInterface $tokenPool, ContextInterface $context)
    {
        $tokens = $tokenPool->getTokens();

        /** @var $visitor VisitorInterface */
        foreach ($this->getVisitors() as $visitor) {
            /** @var $token TokenInterface */
            foreach ($tokens as $token) {
                if ($visitor->accept($token, $context)) {
                    $visitResult = $visitor->visit($token, $context);
                    if (!in_array($visitResult, $this->knownStates)) {
                        throw new UnknownStateException(
                            sprintf(
                                'Cannot visit not acceptable visitor. Check whether visitor accept token before visiting.'
                            )
                        );
                    }
                    if (VisitorInterface::STATE_FOUND === $visitResult) {
                        return $this;
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

        return $visitors;
    }
}
