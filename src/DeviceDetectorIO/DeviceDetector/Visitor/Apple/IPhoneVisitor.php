<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor\Apple;

/**
 * Class IPhoneVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor\Apple
 */
class IPhoneVisitor extends AppleMobileVisitor
{
    /**
     * {@inheritDoc}
     */
    protected function getDevicePattern()
    {
        return '#iPhone#is';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDeviceVersionsPatterns()
    {
        return array(
            'iPhone1,1' => 'iPhone',
            'iPhone1,2' => 'iPhone 3G',
            'iPhone2,1' => 'iPhone 3GS',
            'iPhone3,1' => 'iPhone 4',
            'iPhone3,2' => 'iPhone 4',
            'iPhone3,3' => 'iPhone 4',
            'iPhone4,1' => 'iPhone 4S',
            'iPhone5,1' => 'iPhone 5',
            'iPhone5,2' => 'iPhone 5',
            'iPhone5,3' => 'iPhone 5C',
            'iPhone5,4' => 'iPhone 5C',
            'iPhone6,1' => 'iPhone 5S',
            'iPhone6,2' => 'iPhone 5S',
            'iPhone7,2' => 'iPhone 6',
            'iPhone7,1' => 'iPhone 6 Plus'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function getBrandName()
    {
        return 'iPhone';
    }
}
