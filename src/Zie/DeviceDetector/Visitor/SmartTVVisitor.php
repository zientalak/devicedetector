<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class SmartTVVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class SmartTVVisitor extends AbstractDictionaryVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        $context->setCapability(Capabilities::IS_SMART_TV, $match);
        $context->setCapability(Capabilities::IS_MOBILE, !$match);
        $context->setCapability(Capabilities::IS_DESKTOP, !$match);

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPatterns()
    {
        return array(
            'googletv',
            'boxee',
            'sonydtv',
            'appletv',
            'philipstv',
            'smarttv',
            'smart-tv',
            'dlna',
            'netcast.tv',
            'ce-html',
            'inettvbrowser',
            'opera tv',
            'viera',
            'konfabulator',
            'sony bravia',
            'hbbtv'
        );
    }
}
