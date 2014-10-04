<?php

namespace Zie\DeviceDetector\Fingerprint;

use Zie\DeviceDetector\Token\TokenPoolInterface;

/**
 * Interface FingerprintGeneratorInterface
 * @package Zie\DeviceDetector\FingerprintGenerator
 */
interface FingerprintGeneratorInterface
{

    /**
     * @param TokenPoolInterface $tokenPool
     * @return string|boolean
     */
    public function getFingerprint(TokenPoolInterface $tokenPool);
}
