<?php

namespace Zie\DeviceDetector\Device;

use Zie\DeviceDetector\Capabilities;

/**
 * Class Device
 * @package Zie\DeviceDetector\Device
 */
class Device implements DeviceInterface
{
    /**
     * @var array
     */
    protected $capabilities = array();

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
    public function getCapability($name)
    {
        return isset($this->capabilities[$name]) ? $this->capabilities[$name] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile()
    {
        return $this->getCapability(Capabilities::IS_MOBILE);
    }

    /**
     * {@inheritdoc}
     */
    public function isRobot()
    {
        return $this->getCapability(Capabilities::IS_ROBOT);
    }

    /**
     * {@inheritdoc}
     */
    public function isOSX()
    {
        return Capabilities::OS_OSX === $this->getCapability(Capabilities::OS);
    }

    /**
     * @return boolean
     */
    public function isIOS()
    {
        return Capabilities::OS_IOS === $this->getCapability(Capabilities::OS);
    }

    /**
     * {@inheritdoc}
     */
    public function isAndroid()
    {
        return Capabilities::OS_ANDROID === $this->getCapability(Capabilities::OS);
    }

    /**
     * {@inheritdoc}
     */
    public function getOS()
    {
        return $this->getCapability(Capabilities::OS);
    }

    /**
     * {@inheritdoc}
     */
    public function getOSVersion()
    {
        return $this->getCapability(Capabilities::OS_VERSION);
    }

    /**
     * {@inheritdoc}
     */
    public function getOSVendor()
    {
        return $this->getCapability(Capabilities::OS_VENDOR);
    }

    /**
     * {@inheritdoc}
     */
    public function isWindows()
    {
        return Capabilities::OS_WINDOWS === $this->getCapability(Capabilities::OS)
            || Capabilities::OS_WINDOWS_PHONE === $this->getCapability(Capabilities::OS);
    }

    /**
     * {@inheritdoc}
     */
    public function getOSVersionFull()
    {
        return $this->getCapability(Capabilities::OS_VERSION_FULL);
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowser()
    {
        return $this->getCapability(Capabilities::BROWSER);
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowserVersion()
    {
        return $this->getCapability(Capabilities::BROWSER_VERSION);
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowserVersionFull()
    {
        return $this->getCapability(Capabilities::BROWSER_VERSION_FULL);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return count($this->capabilities) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->capabilities);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->capabilities = unserialize($serialized);
    }
}

