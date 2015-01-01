<?php

namespace Zie\DeviceDetector\Device;

/**
 * Interface DeviceInterface
 * @package Zie\DeviceDetector\Device
 */
interface DeviceInterface extends \Serializable
{
    /**
     * @param $name
     * @return mixed|null
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
     * @return boolean
     */
    public function isOSX();

    /**
     * @return boolean
     */
    public function isIOS();

    /**
     * @return boolean
     */
    public function isWindows();

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
    public function getOSVersionFull();

    /**
     * @return string
     */
    public function getOSVendor();

    /**
     * @return boolean
     */
    public function getBrowser();

    /**
     * @return string
     */
    public function getBrowserVersion();

    /**
     * @return string
     */
    public function getBrowserVersionFull();

    /**
     * Return true if any capability was found.
     *
     * @return boolean
     */
    public function isValid();
}
