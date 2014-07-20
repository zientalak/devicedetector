<?php

namespace Zie\DeviceDetector\Device;

/**
 * Interface DeviceInterface
 * @package Zie\DeviceDetector\Device
 */
interface DeviceInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function getCapability($name);

    /**
     * @param $name
     * @return boolean
     */
    public function hasCapability($name);

    /**
     * @return array
     */
    public function getCapabilities();

    /**
     * @return boolean
     */
    public function isMobile();

    /**
     * @return boolean
     */
    public function isRobot();
} 