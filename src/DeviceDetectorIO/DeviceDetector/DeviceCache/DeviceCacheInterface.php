<?php

namespace DeviceDetectorIO\DeviceDetector\DeviceCache;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;

/**
 * Interface DeviceCacheInterface
 * @package DeviceDetectorIO\DeviceDetector\DeviceCache
 */
interface DeviceCacheInterface
{
    /**
     * @param string $fingerprint
     * @return boolean
     */
    public function has($fingerprint);

    /**
     * @param string $fingerprint
     * @return CacheDevice|false
     */
    public function get($fingerprint);

    /**
     * @param CacheDevice $device
     * @param integer $lifetime
     * @return boolean
     */
    public function add(CacheDevice $device, $lifetime = CacheInterface::LIFETIME_DAY);

    /**
     * @param string $fingerprint
     * @return boolean
     */
    public function remove($fingerprint);

    /**
     * @return boolean
     */
    public function removeAll();
}
