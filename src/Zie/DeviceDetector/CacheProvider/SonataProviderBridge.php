<?php

namespace Zie\DeviceDetector\CacheProvider;

use Sonata\Cache\CacheAdapterInterface;
use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Exception\CachedDeviceNotFoundException;

/**
 * Class SonataProviderBridge
 * @package Zie\DeviceDetector\CacheProvider
 */
class SonataProviderBridge extends AbstractProvider
{
    /**
     * @var CacheAdapterInterface
     */
    private $cacheAdapter;

    /**
     * @param CacheAdapterInterface $cacheAdapter
     */
    public function __construct(CacheAdapterInterface $cacheAdapter)
    {
        $this->cacheAdapter = $cacheAdapter;
    }

    /**
     * {@inheritdoc}
     */
    public function getDevice($fingerprint)
    {
        if (!$this->hasDevice($fingerprint)) {
            throw new CachedDeviceNotFoundException(sprintf('Device with fingerprint "%s" not found.', $fingerprint));
        }

        return unserialize(
            $this->cacheAdapter
                ->get(array($this->generateKey($this->prefix, $fingerprint)))
                ->getData()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function hasDevice($fingerprint)
    {
        return $this->cacheAdapter->has(array(
            $this->generateKey($this->prefix, $fingerprint)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function addDevice(CacheDevice $device, $lifetime = self::LIFETIME_DAY)
    {
        $this->cacheAdapter->set(
            $this->generateKey($this->prefix, $device->getFingerprint()),
            serialize($device),
            $lifetime
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeDevice(CacheDevice $device)
    {
        $this->cacheAdapter->flush($this->generateKey($this->prefix, $device->getFingerprint()));

        return $this;
    }
}
