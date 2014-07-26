<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AndroidVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class AndroidVisitor extends AbstractRegexVisitor
{
    /**
     * @var array
     */
    protected $pattern = '#Android (?P<version>[^\s;]+)#is';

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        $context->setCapability(Capabilities::IS_ANDROID, $match);
        if($match){
            $context->setCapability(Capabilities::OS, Capabilities::OS_ANDROID)
                    ->setCapability(Capabilities::OS_VERSION, $matches['version'])
                    ->setCapability(Capabilities::OS_VENDOR, Capabilities::OS_VENDOR_GOOGLE);
        }

        return VisitorInterface::STATE_SEEKING;
    }
} 