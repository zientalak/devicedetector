<?php

namespace DeviceDetectorIO\DeviceDetector\Device;

/**
 * Interface DeviceInterface.
 */
interface DeviceInterface extends \Serializable
{
    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function getCapability($name);

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasCapability($name);

    /**
     * @return array
     */
    public function getCapabilities();

    /**
     * Return true if any capability was found.
     *
     * @return bool
     */
    public function isValid();
}
