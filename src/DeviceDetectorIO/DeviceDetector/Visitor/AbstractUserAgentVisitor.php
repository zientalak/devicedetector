<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;

/**
 * Class AbstractUserAgentVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
abstract class AbstractUserAgentVisitor implements VisitorInterface
{
    /**
     * {@inheritdoc}
     */
    public function accept(TokenInterface $token, CollectorInterface $collector)
    {
        return $token instanceof UserAgentToken;
    }
}
