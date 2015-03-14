<?php

namespace DeviceDetectorIO\DeviceDetector\CacheProvider;

use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Interface CacheProviderInterface
 * @package DeviceDetectorIO\DeviceDetector\CacheProvider
 */
interface CacheProviderInterface
{
    const LIFETIME_DAY = 86400;
    const PREFIX = 'DeviceDetectorIO\DeviceDetector\CacheProvider\CacheProvider';

    /**
     * @param string $fingerprint
     * @return boolean
     */
    public function hasDevice($fingerprint);

    /**
     * @param string $fingerprint
     * @return CacheDevice|false
     */
    public function getDevice($fingerprint);

    /**
     * @param CacheDevice $device
     * @param integer $lifetime
     * @return boolean
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY);

    /**
     * @param string $fingerprint
     * @return boolean
     */
    public function removeDevice($fingerprint);

    /**
     * @return boolean
     */
    public function clear();
}
