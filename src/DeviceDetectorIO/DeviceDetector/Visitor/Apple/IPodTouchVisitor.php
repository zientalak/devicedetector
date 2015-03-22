<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor\Apple;

/**
 * Class IPodTouchVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor\Apple
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
