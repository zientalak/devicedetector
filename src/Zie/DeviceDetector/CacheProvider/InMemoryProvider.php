<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;

/**
 * Class InMemoryProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
class InMemoryProvider extends AbstractProvider
{
    /**
     * @var array
     */
    private $registry = array();

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return isset($this->registry[$this->generateKey($this->prefix, $fingerprint)]);
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize($this->registry[$this->generateKey($this->prefix, $fingerprint)]);
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        $this->registry[$this->generateKey($this->prefix, $device->getFingerprint())] = serialize($device);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        if ($this->hasDevice($device->getFingerprint())) {
            unset($this->registry[$this->generateKey($this->prefix, $device->getFingerprint())]);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->registry = array();

        return true;
    }
}
