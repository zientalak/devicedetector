<?php

namespace Zie\DeviceDetector\Device;

/**
 * Class Device
 * @package Zie\DeviceDetector\Device
 */
class Device implements DeviceInterface
{
    /**
     * @var array
     */
    private $capabilities = array();

    /**
     * @param array $capabilities
     */
    public function __construct(array $capabilities)
    {
        $this->capabilities = $capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function getCapability($name)
    {
        return isset($this->capabilities[$name]) ? $this->capabilities[$name] : false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCapability($name)
    {
        return isset($this->capabilities[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile()
    {
        return $this->getCapability('isMobile');
    }

    /**
     * {@inheritdoc}
     */
    public function isRobot()
    {
        return $this->getCapability('isRobot');
    }


} 