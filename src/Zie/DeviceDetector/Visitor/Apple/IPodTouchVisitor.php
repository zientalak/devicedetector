<?php

namespace Zie\DeviceDetector\Visitor\Apple;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IPodTouchVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class IPodTouchVisitor extends AppleMobileVisitor
{
    /**
     * @return string
     */
    protected function getDevicePattern()
    {
        return '#iPod#is';
    }

    /**
     * @return array
     */
    protected function getDeviceVersionsPatterns()
    {
        return array(
            'iPod1,1' => 'iPod touch',
            'iPod2,1' => 'iPod touch 2G',
            'iPod3,1' => 'iPod touch 3G',
            'iPod4,1' => 'iPod touch 4G',
            'iPod5,1' => 'iPod touch 5G'
        );
    }

    /**
     * @return string
     */
    protected function getBrandName()
    {
        return 'iPod';
    }
}
