<?php

namespace Zie\DeviceDetector\CacheProvider;

use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Class XcacheProvider
 * @package Zie\DeviceDetector\CacheProvider
 * @codeCoverageIgnore
 * @see http://xcache.lighttpd.net/ticket/228
 */
class XcacheProvider extends AbstractProvider
{
    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return xcache_isset($this->generateKey($this->prefix, $fingerprint));
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            return false;
        }

        return unserialize(xcache_get($this->generateKey($this->prefix, $fingerprint)));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        return xcache_set(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device),
            (int)$lifetime
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        return apc_delete($this->generateKey($this->prefix, $device->getFingerprint()));
    }

    /**
     * @return boolean
     */
    public function clear()
    {
        $this->checkAuthorization();

        xcache_clear_cache(XC_TYPE_VAR);

        return true;
    }

    /**
     * @return void
     *
     * @throws \BadMethodCallException When xcache.admin.enable_auth is On.
     */
    protected function checkAuthorization()
    {
        if (ini_get('xcache.admin.enable_auth')) {
            throw new \BadMethodCallException(
                'xcache.admin.enable_auth should be set to Off if you want use XcacheProvider.'
            );
        }
    }
}
