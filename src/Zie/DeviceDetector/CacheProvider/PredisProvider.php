<?php

namespace Zie\DeviceDetector\CacheProvider;

use Predis\Redis;
use Zie\DeviceDetector\Device\CacheDevice;

/**
 * Class PredisProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
class PredisProvider extends AbstractProvider
{
    /**
     * @var Redis
     */
    private $predis;

    /**
     * @param Redis $predis
     */
    public function __construct(Redis $predis)
    {
        $this->setPredis($predis);
    }

    /**
     * @codeCoverageIgnore
     * @param Redis $predis
     * @return self
     */
    public function setPredis(Redis $predis)
    {
        $this->predis = $predis;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return $this->predis->exists($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize($this->predis->get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        $id = $this->generateKey($this->prefix, $device->getFingerprint());
        $data = serialize($device);

        $response = $this->predis->setex($id, (int)$lifetime, $data);

        return $response === true || $response == 'OK';
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        return $this->predis->del($this->generateKey($this->prefix, $device->getFingerprint())) > 0;
    }

    /**
     * @return boolean
     */
    public function clear()
    {
        $response = $this->predis->flushdb();

        return $response === true || $response == 'OK';
    }
}
