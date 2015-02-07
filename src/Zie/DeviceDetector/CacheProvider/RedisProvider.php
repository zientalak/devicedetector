<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;

/**
 * Class RedisProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
class RedisProvider extends AbstractProvider
{
    /**
     * @var \Redis
     */
    private $redis;

    /**
     * @param \Redis $predis
     */
    public function __construct(\Redis $predis)
    {
        $this->setRedis($predis);
    }

    /**
     * @codeCoverageIgnore
     * @param \Redis $redis
     * @return self
     */
    public function setRedis(\Redis $redis)
    {
        $redis->setOption(\Redis::OPT_SERIALIZER, $this->getSerializerValue());
        $this->redis = $redis;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return $this->redis->exists($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize($this->redis->get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        $id = $this->generateKey($this->prefix, $device->getFingerprint());
        $data = serialize($device);

        return $this->redis->setex($id, (int)$lifetime, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        return $this->redis->delete($this->generateKey($this->prefix, $device->getFingerprint())) > 0;
    }

    /**
     * @return boolean
     */
    public function clear()
    {
        return $this->redis->flushDB();
    }

    /**
     * @codeCoverageIgnore
     * @return integer One of the \Redis::SERIALIZER_* constants
     */
    protected function getSerializerValue()
    {
        if (defined('HHVM_VERSION')) {
            return \Redis::SERIALIZER_PHP;
        }
        return defined('Redis::SERIALIZER_IGBINARY') ? \Redis::SERIALIZER_IGBINARY : \Redis::SERIALIZER_PHP;
    }
}
