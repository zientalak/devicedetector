<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\UserAgentToken;

/**
 * Class AbstractUserAgentVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractUserAgentVisitor implements VisitorInterface
{
    /**
     * {@inheritdoc}
     */
    public function accept(TokenInterface $token, ContextInterface $context)
    {
        return $token instanceof UserAgentToken;
    }
}
