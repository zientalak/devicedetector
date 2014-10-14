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
     * @return CacheDevice
     * @throws CachedDeviceNotFoundException
     */
    public function getDevice($fingerprint);

    /**
     * @param CacheDevice $device
     * @param integer $lifetime
     * @return CacheProviderInterface
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY);

    /**
     * @param CacheDevice $device
     * @return CacheProviderInterface
     */
    public function removeDevice(CacheDevice $device);

    /**
     * @param string $prefix
     * @return CacheProviderInterface
     */
    public function setPrefix($prefix);
}

