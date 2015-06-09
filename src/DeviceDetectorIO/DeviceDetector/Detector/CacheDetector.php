<?php

namespace DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\DeviceCache\DeviceCacheInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Fingerprint\FingerprintGeneratorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;

/**
 * Class CacheDetector
 * @package DeviceDetectorIO\DeviceDetector\Detector
 */
final class CacheDetector extends DeviceDetector
{
    /**
     * @var DeviceCacheInterface
     */
    private $deviceCache;

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
     * @param DeviceCacheInterface $deviceCache
     * @return self
     */
    public function setDeviceCache(DeviceCacheInterface $deviceCache)
    {
        $this->deviceCache = $deviceCache;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function detect(TokenPoolInterface $tokenPool)
    {
        $fingerprint = $this->fingerprintGenerator->generate($tokenPool);

        $device = $this->deviceCache->get($fingerprint);
        if (false !== $device) {
            return $device;
        }

        $device = new CacheDevice(parent::detect($tokenPool), $fingerprint);
        $this->deviceCache->add($device);

        return $device;
    }
}
