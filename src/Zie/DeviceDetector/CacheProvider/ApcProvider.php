<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Class ApcProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
class ApcProvider extends AbstractProvider
{
    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return apc_exists($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize(apc_fetch($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        return (bool) apc_store(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device),
            $lifetime
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        return apc_delete($this->generateKey($this->prefix, $device->getFingerprint()));
    }

    /**
     * @return boolean
     */
    public function clear()
    {
        return apc_clear_cache() && apc_clear_cache('user');
    }
}
