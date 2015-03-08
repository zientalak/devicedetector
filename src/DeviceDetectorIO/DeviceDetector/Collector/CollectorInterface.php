<?php

namespace DeviceDetectorIO\DeviceDetector\Collector;

/**
 * Interface ContextInterface
 * @package DeviceDetectorIO\DeviceDetector\Collector
 */
interface CollectorInterface
{
    /**
     * @param string $name
     * @return mixed|null
     */
    public function getCapability($name);

    /**
     * @param string $name
     * @return boolean
     */
    public function hasCapability($name);

    /**
     * @param string $name
     * @param $value
     * @return self
     */
    public function addCapability($name, $value);

    /**
     * @return array
     */
    public function getCapabilities();

    /**
     * @param array $capabilities
     * @param boolean $merge
     * @return self
     */
    public function setCapabilities(array $capabilities, $merge = false);

    /**
     * @param array $capabilities
     * @return self
     */
    public function mergeCapabilities(array $capabilities);

    /**
     * @return self
     */
    public function clear();

    /**
     * @param string $name
     * @return self
     */
    public function removeCapability($name);
}
