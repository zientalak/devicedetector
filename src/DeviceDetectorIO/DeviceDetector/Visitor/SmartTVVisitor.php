<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class SmartTVVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class SmartTVVisitor extends AbstractDictionaryVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $position)
    {
        $collector->addCapability(Capabilities::IS_SMART_TV, true);

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
