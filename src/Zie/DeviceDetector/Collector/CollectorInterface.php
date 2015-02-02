<?php

namespace Zie\DeviceDetector\Collector;

/**
 * Interface ContextInterface
 * @package Zie\DeviceDetector\Collector
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
     * @return CollectorInterface
     */
    public function setCapability($name, $value);

    /**
     * @return array
     */
    public function getCapabilities();

    /**
     * @param array $capabilities
     * @return CollectorInterface
     */
    public function setCapabilities(array $capabilities);

    /**
     * @return CollectorInterface
     */
    public function clear();

    /**
     * @param string $name
     * @return CollectorInterface
     */
    public function removeCapability($name);
}
