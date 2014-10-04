<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Interface VisitorInterface
 * @package Zie\DeviceDetector\Visitor
 */
interface VisitorInterface
{
    const STATE_SEEKING = 0;
    const STATE_FOUND = 1;

    /**
     * @param TokenInterface $token
     * @param ContextInterface $context
     * @return boolean
     */
    public function accept(TokenInterface $token, ContextInterface $context);

    /**
     * @param TokenInterface $token
     * @param ContextInterface $context
     * @return integer
     * @throws VisitorNotAcceptableException
     */
    public function visit(TokenInterface $token, ContextInterface $context);
}
