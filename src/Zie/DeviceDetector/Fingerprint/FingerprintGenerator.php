<?php

namespace Zie\DeviceDetector\Fingerprint;

use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\TokenPoolInterface;

/**
 * Class FingerprintGenerator
 * @package Zie\DeviceDetector\FingerprintGenerator
 */
class FingerprintGenerator implements FingerprintGeneratorInterface
{
    /**
     * {@inheritDoc)
     */
    public function getFingerprint(TokenPoolInterface $tokenPool)
    {
        if (!$tokenPool->count()) {
            return false;
        }

        $serializedTokens = '';
        /** @var $token TokenInterface */
        foreach ($tokenPool->getTokens() as $token) {
            $serializedTokens .= serialize($token);
        }

        return sha1($serializedTokens);
    }
}
