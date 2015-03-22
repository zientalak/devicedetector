<?php

namespace DeviceDetectorIO\DeviceDetector\CacheProvider;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;

/**
 * Class GenericProvider
 * @package DeviceDetectorIO\DeviceDetector\CacheProvider
 */
class GenericProvider implements CacheProviderInterface
{
    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var string
     */
    protected $prefix = self::PREFIX;

    /**
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return $this->cache->has($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize($this->cache->get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = CacheInterface::LIFETIME_DAY)
    {
        return $this->cache->save(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice($fingerprint)
    {
        return $this->cache->delete($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        return $this->cache->deleteAll();
    }

    /**
     * @param string $prefix
     * @return self
     */
    public function setPrefix($prefix = self::PREFIX)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @param string $prefix
     * @param string $fingerprint
     * @return string
     */
    protected function generateKey($prefix, $fingerprint)
    {
        return sprintf('%s.%s', $prefix, $fingerprint);
    }
}
