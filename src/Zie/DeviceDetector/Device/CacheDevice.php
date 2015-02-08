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
    public function isValid()
    {
        return $this->device->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(
            array(
                'fingerprint' => $this->fingerprint,
                'device' => $this->device
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $unserialized = unserialize($serialized);

        $this->fingerprint = $unserialized['fingerprint'];
        $this->device = $unserialized['device'];
    }

    /**
     * @param string $name
     * @param array $arguments
     */
    public function __call($name, array $arguments)
    {
        return $this->device->__call($name, $arguments);
    }
}
