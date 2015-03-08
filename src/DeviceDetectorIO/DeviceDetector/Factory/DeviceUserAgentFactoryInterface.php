<?php

namespace DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Device\DeviceInterface;

/**
 * Interface DeviceUserAgentFactoryInterface
 * @package DeviceDetectorIO\DeviceDetector\Factory
 */
interface DeviceUserAgentFactoryInterface
{
    /**
     * @param string $userAgent
     * @return DeviceInterface
     */
    public function getDevice($userAgent);
}