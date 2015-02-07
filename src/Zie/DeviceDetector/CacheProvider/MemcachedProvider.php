<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Class MemcachedProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
class MemcachedProvider extends AbstractProvider
{
    /**
     * @var \Memcached
     */
    private $memcached;

    /**
     * @param \Memcached $memcached
     */
    public function __construct(\Memcached $memcached)
    {
        $this->setMemcached($memcached);
    }

    /**
     * @codeCoverageIgnore
     * @param \Memcached $memcached
     * @return self
     */
    public function setMemcached(\Memcached $memcached)
    {
        $this->memcached = $memcached;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return false !== $this->memcached->get($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize($this->memcached->get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        return $this->memcached->set(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device),
            (int)$lifetime
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        return $this->memcached->delete($this->generateKey($this->prefix, $device->getFingerprint()));
    }

    /**
     * @return boolean
     */
    public function clear()
    {
        return $this->memcached->flush();
    }
}
