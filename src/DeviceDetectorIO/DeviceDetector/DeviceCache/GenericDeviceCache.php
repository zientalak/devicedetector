<?php

namespace DeviceDetectorIO\DeviceDetector\DeviceCache;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;

/**
 * Class GenericDeviceCache.
 */
class GenericDeviceCache implements DeviceCacheInterface
{
    const PREFIX = 'DeviceDetectorIO\DeviceDetector\DeviceCache\GenericDeviceCache';

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @param CacheInterface $cache
     * @param string
     */
    public function __construct(CacheInterface $cache, $prefix = self::PREFIX)
    {
        $this->cache = $cache;
        $this->setPrefix($prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function has($fingerprint)
    {
        return $this->cache->has($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function get($fingerprint)
    {
        if (!$this->has($fingerprint)) {
            return false;
        }

        return unserialize($this->cache->get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function add(CacheDevice $device, $lifetime = CacheInterface::LIFETIME_DAY)
    {
        return $this->cache->save(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function remove($fingerprint)
    {
        return $this->cache->delete($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll()
    {
        return $this->cache->deleteAll();
    }

    /**
     * @param string $prefix
     *
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
     *
     * @return string
     */
    protected function generateKey($prefix, $fingerprint)
    {
        return sprintf('%s.%s', $prefix, $fingerprint);
    }
}
