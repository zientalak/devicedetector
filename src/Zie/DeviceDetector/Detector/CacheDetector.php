<?php

namespace Zie\DeviceDetector\Detector;

use Zie\DeviceDetector\CacheProvider\CacheProviderInterface;
use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Fingerprint\FingerprintGeneratorInterface;

/**
 * Class CacheDetector
 * @package Zie\DeviceDetector\Detector
 */
final class CacheDetector implements DeviceDetectorInterface
{
    /**
     * @var DeviceDetector
     */
    private $detector;

    /**
     * @var CacheProviderInterface
     */
    private $cacheProvider;

    /**
     * @var FingerprintGeneratorInterface
     */
    private $fingerprintGenerator;

    /**
     * @param DeviceDetector $detector
     * @param CacheProviderInterface $cacheProvider
     * @param FingerprintGeneratorInterface $fingerprintGenerator
     */
    public function __construct(
        DeviceDetector $detector,
        CacheProviderInterface $cacheProvider,
        FingerprintGeneratorInterface $fingerprintGenerator
    ) {
        $this->detector = $detector;
        $this->cacheProvider = $cacheProvider;
        $this->fingerprintGenerator = $fingerprintGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function detect()
    {
        $fingerprint = $this->fingerprintGenerator->getFingerprint($this->detector->getTokenPool());

        if ($this->cacheProvider->hasDevice($fingerprint)) {
            return $this->cacheProvider->getDevice($fingerprint);
        }

        $device = new CacheDevice($this->detector->detect(), $fingerprint);
        $this->cacheProvider->addDevice($device);

        return $device;
    }
}
