<?php

namespace Zie\DeviceDetector\Factory;

use Zie\DeviceDetector\Device\DeviceInterface;

/**
 * Interface DeviceUserAgentFactoryInterface
 * @package Zie\DeviceDetector\Factory
 */
interface DeviceUserAgentFactoryInterface
{
    /**
     * @param string $userAgent
     * @return DeviceInterface
     */
    public function getDevice($userAgent);
}