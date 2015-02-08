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
     * Return true if any capability was found.
     *
     * @return boolean
     */
    public function isValid();
}
