<?php

namespace DeviceDetectorIO\DeviceDetector\Capability;

/**
 * Interface CollatorInterface
 * @package DeviceDetectorIO\DeviceDetector\Capability
 */
interface CollatorInterface
{
    /**
     * @param string $name
     * @return mixed|null
     */
    public function get($name);

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name);

    /**
     * @param string $name
     * @param mixed $value
     * @return boolean
     */
    public function set($name, $value);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @param array $capabilities
     * @return boolean
     */
    public function setAll(array $capabilities);

    /**
     * @param array $capabilities
     * @return boolean
     */
    public function merge(array $capabilities);

    /**
     * @param string $name
     * @return boolean
     */
    public function remove($name);

    /**
     * @return boolean
     */
    public function removeAll();
}
