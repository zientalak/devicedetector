<?php

namespace Zie\DeviceDetector\Visitor\Apple;

/**
 * Class IPadVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class IPadVisitor extends AppleMobileVisitor
{
    /**
     * {@inheritDoc}
     */
    protected function getDevicePattern()
    {
        return '#iPad#is';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDeviceVersionsPatterns()
    {
        return array(
            'iPad1,1' => 'iPad',
            'iPad2,1' => 'iPad 2',
            'iPad2,2' => 'iPad 2',
            'iPad2,3' => 'iPad 2',
            'iPad2,4' => 'iPad 2',
            'iPad3,1' => 'iPad 3',
            'iPad3,2' => 'iPad 3',
            'iPad3,3' => 'iPad 3',
            'iPad3,4' => 'iPad 4',
            'iPad3,5' => 'iPad 4',
            'iPad3,6' => 'iPad 4',
            'iPad4,1' => 'iPad Air',
            'iPad4,2' => 'iPad Air',
            'iPad4,3' => 'iPad Air',
            'iPad5,3' => 'iPad Air 2',
            'iPad5,4' => 'iPad Air 2',
            'iPad2,5' => 'iPad mini 1G',
            'iPad2,6' => 'iPad mini 1G',
            'iPad2,7' => 'iPad mini 1G',
            'iPad4,4' => 'iPad mini 2',
            'iPad4,5' => 'iPad mini 2',
            'iPad4,6' => 'iPad mini 2',
            'iPad4,7' => 'iPad mini 3',
            'iPad4,8' => 'iPad mini 3',
            'iPad4,9' => 'iPad mini 3'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function getBrandName()
    {
        return 'iPad';
    }
}
