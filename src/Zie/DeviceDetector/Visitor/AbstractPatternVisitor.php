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
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        $match = (boolean)preg_match($this->getPattern(), $token->getData(), $matches);
        $doVisit = (int)$this->doVisit(
            $token,
            $context,
            $match,
            $matches
        );

        if (VisitorInterface::STATE_FOUND === $doVisit) {
            return $doVisit;
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $context
     * @param boolean $match
     * @param array $matches
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, array $matches);

    /**
     * @return string
     */
    abstract protected function getPattern();
}
