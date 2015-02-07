<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AbstractMachVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractMachVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        $strpos = strripos($token->getData(), $this->getPattern());

        return (int)$this->doVisit(
            $token,
            $context,
            $strpos !== false,
            $strpos
        );
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $context
     * @param boolean $match
     * @param integer $position
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, $position);

    /**
     * @return string
     */
    abstract protected function getPattern();
}
