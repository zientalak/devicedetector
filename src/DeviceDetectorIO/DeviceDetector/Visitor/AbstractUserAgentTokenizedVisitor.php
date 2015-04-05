<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;

/**
 * Class AbstractUserAgentTokenizedVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
abstract class AbstractUserAgentTokenizedVisitor implements VisitorInterface
{
    /**
     * {@inheritdoc}
     */
    public function accept(TokenInterface $token, CollatorInterface $collator)
    {
        return $token instanceof UserAgentTokenizedToken;
    }
}
