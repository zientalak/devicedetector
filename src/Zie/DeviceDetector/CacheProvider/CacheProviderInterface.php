<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Interface CacheProviderInterface
 * @package Zie\DeviceDetector\CacheProvider
 */
interface CacheProviderInterface
{
    const LIFETIME_DAY = 86400;
    const PREFIX = '@DeviceDetector@';

    /**
     * @param string $fingerprint
     * @return boolean
     */
    public function hasDevice($fingerprint);

    /**
     * @param $fingerprint
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
     * @param CacheDevice $device
     * @return boolean
     */
    public function removeDevice(CacheDevice $device);

    /**
     * @return boolean
     */
    public function clear();
}
