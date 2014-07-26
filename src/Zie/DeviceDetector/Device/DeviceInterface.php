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

    /**
     * @return boolean
     */
    public function isAndroid();

    /**
     * @return string
     */
    public function getOS();

    /**
     * @return string
     */
    public function getOSVersion();

    /**
     * @return string
     */
    public function getOSVendor();
} 