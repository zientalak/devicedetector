<?php

namespace Zie\DeviceDetector\Detector;

use Zie\DeviceDetector\CacheProvider\CacheProviderInterface;

/**
 * Interface FactoryInterface
 * @package Zie\DeviceDetector\Device
 */
interface FactoryInterface
{
    /**
     * @param string $userAgent
     * @return DeviceDetector
     */
    public function createDeviceDetectorFromUserAgent($userAgent);
}
