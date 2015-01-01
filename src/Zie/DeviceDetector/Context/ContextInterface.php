<?php

namespace Zie\DeviceDetector\Context;

/**
 * Interface ContextInterface
 * @package Zie\DeviceDetector\Context
 */
interface ContextInterface
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
     * @return ContextInterface
     */
    public function setCapability($name, $value);

    /**
     * @return array
     */
    public function getCapabilities();

    /**
     * @param array $capabilities
     * @return ContextInterface
     */
    public function setCapabilities(array $capabilities);

    /**
     * @return ContextInterface
     */
    public function clear();

    /**
     * @param string $name
     * @return ContextInterface
     */
    public function removeCapability($name);
}
