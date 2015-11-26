<?php

namespace DeviceDetectorIO\DeviceDetector\Device;

/**
 * Class CacheDevice.
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
            [
                'fingerprint' => $this->fingerprint,
                'device' => $this->device,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->fingerprint = $data['fingerprint'];
        $this->device = $data['device'];
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        return $this->device->__call($name, $arguments);
    }
}
