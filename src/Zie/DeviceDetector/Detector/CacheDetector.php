<?php

namespace Zie\DeviceDetector\Detector;

use Zie\DeviceDetector\CacheProvider\CacheProviderInterface;
use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Fingerprint\FingerprintGeneratorInterface;

/**
 * Class CacheDetector
 * @package Zie\DeviceDetector\Detector
 */
final class CacheDetector extends DeviceDetector
{
    /**
     * @var CacheProviderInterface
     */
    private $cacheProvider;

    /**
     * @var FingerprintGeneratorInterface
     */
    private $fingerprintGenerator;

    /**
     * @param FingerprintGeneratorInterface $fingerprintGenerator
     * @return self
     */
    public function setFingerprintGenerator(FingerprintGeneratorInterface $fingerprintGenerator)
    {
        $this->fingerprintGenerator = $fingerprintGenerator;

        return $this;
    }

    /**
     * @param CacheProviderInterface $cacheProvider
     * @return self
     */
    public function setCacheProvider(CacheProviderInterface $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function detect()
    {
        $fingerprint = $this->fingerprintGenerator->getFingerprint($this->tokenPool);

        $device = $this->cacheProvider->getDevice($fingerprint);
        if (false !== $device) {
            return $device;
        }

        $device = new CacheDevice(parent::detect(), $fingerprint);
        $this->cacheProvider->addDevice($device);

        return $device;
    }
}
