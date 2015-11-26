<?php

namespace DeviceDetectorIO\DeviceDetector\DeviceCache;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;

/**
 * Interface DeviceCacheInterface.
 */
interface DeviceCacheInterface
{
    /**
     * @param string $fingerprint
     *
     * @return bool
     */
    public function has($fingerprint);

    /**
     * @param string $fingerprint
     *
     * @return CacheDevice|false
     */
    public function get($fingerprint);

    /**
     * @param CacheDevice $device
     * @param int         $lifetime
     *
     * @return bool
     */
    public function add(CacheDevice $device, $lifetime = CacheInterface::LIFETIME_DAY);

    /**
     * @param string $fingerprint
     *
     * @return bool
     */
    public function remove($fingerprint);

    /**
     * @return bool
     */
    public function removeAll();
}
