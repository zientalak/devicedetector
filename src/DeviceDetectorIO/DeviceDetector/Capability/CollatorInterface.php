<?php

namespace DeviceDetectorIO\DeviceDetector\Capability;

/**
 * Interface CollatorInterface.
 */
interface CollatorInterface
{
    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function get($name);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name);

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return bool
     */
    public function set($name, $value);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @param array $capabilities
     *
     * @return bool
     */
    public function setAll(array $capabilities);

    /**
     * @param array $capabilities
     *
     * @return bool
     */
    public function merge(array $capabilities);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function remove($name);

    /**
     * @return bool
     */
    public function removeAll();
}
