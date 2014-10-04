<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AbstractPatternVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractPatternVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    protected $pattern;

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        $match = (boolean)preg_match($this->pattern, $token->getData(), $matches);
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
     * @param ContextInterface $context
     * @param boolean $match
     * @param array $matches
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches);
}
