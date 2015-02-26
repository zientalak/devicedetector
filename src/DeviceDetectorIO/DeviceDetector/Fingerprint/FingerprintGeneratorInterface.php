<?php

namespace DeviceDetectorIO\DeviceDetector\Fingerprint;

use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;

/**
 * Interface FingerprintGeneratorInterface
 * @package DeviceDetectorIO\DeviceDetector\GenericGenerator
 */
interface FingerprintGeneratorInterface
{

    /**
     * @param TokenPoolInterface $tokenPool
     * @return string
     */
    public function getFingerprint(TokenPoolInterface $tokenPool);
}
