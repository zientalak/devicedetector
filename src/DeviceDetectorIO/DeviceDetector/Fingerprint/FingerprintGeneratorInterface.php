<?php

namespace DeviceDetectorIO\DeviceDetector\Fingerprint;

use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;

/**
 * Interface FingerprintGeneratorInterface.
 */
interface FingerprintGeneratorInterface
{
    /**
     * @param TokenPoolInterface $tokenPool
     *
     * @return string
     */
    public function generate(TokenPoolInterface $tokenPool);
}
