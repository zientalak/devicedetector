<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
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
    public function accept(TokenInterface $token, CollectorInterface $context)
    {
        return $token instanceof UserAgentToken;
    }
}
