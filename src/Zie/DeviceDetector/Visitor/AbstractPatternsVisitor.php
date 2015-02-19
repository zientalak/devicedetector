<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AbstractPatternsVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractPatternsVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        foreach ($this->getPatterns() as $pattern) {
            $matches = array();
            $match = (boolean)preg_match($pattern, $token->getData(), $matches);
            if (false !== $match) {
                return (int)$this->doVisit(
                    $token,
                    $collector,
                    $matches
                );
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @param array $matches
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $collector, array $matches);

    /**
     * @return array
     */
    abstract protected function getPatterns();
}