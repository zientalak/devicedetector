<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AbstractPatternVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractPatternVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $matches = array();
        $match = (boolean)preg_match($this->getPattern(), $token->getData(), $matches);

        return (int)$this->doVisit(
            $token,
            $collector,
            $match,
            $matches
        );
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @param boolean $match
     * @param array $matches
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches);

    /**
     * @return string
     */
    abstract protected function getPattern();
}
