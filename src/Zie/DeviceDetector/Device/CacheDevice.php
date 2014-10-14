<?php

namespace Zie\DeviceDetector\Device;

/**
 * Class CacheDevice
 * @package Zie\DeviceDetector\Device
 */
final class CacheDevice implements DeviceInterface
{
    /**
     * @var Device
     */
    private $device;

    /**
     * @var string
     */
    private $fingerprint;

    /**
     * @param Device $device
     * @param string $fingerprint
     */
    public function __construct(Device $device, $fingerprint)
    {
        $this->device = $device;
        $this->fingerprint = $fingerprint;
    }

    /**
     * @return string
     */
    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    /**
     * {@inheritdoc}
     */
    public function getCapability($name)
    {
        return $this->device->getCapability($name);
    }

    /**
     * {@inheritdoc}
     */
    public function hasCapability($name)
    {
        return $this->device->hasCapability($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getCapabilities()
    {
        return $this->device->getCapabilities();
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile()
    {
        return $this->device->isMobile();
    }

    /**
     * {@inheritdoc}
     */
    public function isRobot()
    {
        return $this->device->isRobot();
    }

    /**
     * {@inheritdoc}
     */
    public function isAndroid()
    {
        return $this->device->isAndroid();
    }

    /**
     * {@inheritdoc}
     */
    public function isOSX()
    {
        return $this->device->isOSX();
    }

    /**
     * {@inheritdoc}
     */
    public function isIOS()
    {
        return $this->device->isOSX();
    }

    /**
     * {@inheritdoc}
     */
    public function isWindows()
    {
        return $this->device->isWindows();
    }

    /**
     * {@inheritdoc}
     */
    public function getOS()
    {
        return $this->device->getOS();
    }

    /**
     * {@inheritdoc}
     */
    public function getOSVersion()
    {
        return $this->device->getOSVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function getOSVersionFull()
    {
        return $this->device->getOSVersionFull();
    }

    /**
     * {@inheritdoc}
     */
    public function getOSVendor()
    {
        return $this->device->getOSVendor();
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowser()
    {
        return $this->device->getBrowser();
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowserVersion()
    {
        return $this->device->getBrowserVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function getBrowserVersionFull()
    {
        return $this->device->getBrowserVersionFull();
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return $this->device->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return $this->device->serialize();
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->device->unserialize($serialized);
    }
}
