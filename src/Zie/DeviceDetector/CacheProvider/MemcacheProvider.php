<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Class MemcacheProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
class MemcacheProvider extends AbstractProvider
{
    /**
     * @var \Memcache
     */
    private $memcache;

    /**
     * @param \Memcache $memcache
     */
    public function __construct(\Memcache $memcache)
    {
        $this->setMemcache($memcache);
    }

    /**
     * @codeCoverageIgnore
     * @param \Memcache $memcache
     * @return self
     */
    public function setMemcache(\Memcache $memcache)
    {
        $this->memcache = $memcache;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return (bool)$this->memcache->get($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize($this->memcache->get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        return $this->memcache->set(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device),
            0,
            $lifetime
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        return $this->memcache->delete($this->generateKey($this->prefix, $device->getFingerprint()));
    }

    /**
     * @return boolean
     */
    public function clear()
    {
        return $this->memcache->flush();
    }
}
