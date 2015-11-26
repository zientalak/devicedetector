<?php

namespace DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Device\DeviceInterface;

/**
 * Interface DeviceUserAgentFactoryInterface.
 */
interface DeviceUserAgentFactoryInterface
{
    /**
     * @param string $userAgent
     *
     * @return DeviceInterface
     */
    public function getDevice($userAgent);
}
