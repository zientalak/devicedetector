<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\UnknownStateException;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\UserAgentToken;

/**
 * Class AbstractUserAgentVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractUserAgentVisitor implements VisitorInterface
{
    /**
     * @var array
     */
    protected $patterns = array();
    /**
     * @var array
     */
    private $knownStates = array(
        VisitorInterface::STATE_SEEKING,
        VisitorInterface::STATE_FOUND,
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        if (!$this->accept($token, $context)) {
            throw new VisitorNotAcceptableException(sprintf(
                'Cannot visit not acceptable visitor. Check whether visitor accept token before visiting.'
            ));
        }

        if (preg_match(sprintf('#%s#', implode('|', $this->patterns)), $token->getData())) {
            $doVisit = (int)$this->doVisit($token, $context);
            if (!isset($this->knownStates[$doVisit])) {
                throw new UnknownStateException('"doVisit" method return unknown state "%s".',
                    $doVisit);
            }

            if (VisitorInterface::STATE_FOUND === $doVisit) {
                return $doVisit;
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    public function accept(TokenInterface $token, ContextInterface $context)
    {
        return $token instanceof UserAgentToken;
    }

    /**
     * @param TokenInterface $token
     * @param ContextInterface $context
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, ContextInterface $context);
} 