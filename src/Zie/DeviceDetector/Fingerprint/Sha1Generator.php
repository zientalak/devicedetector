<?php

namespace Zie\DeviceDetector\Fingerprint;

use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\TokenPoolInterface;

/**
 * Class Sha1Generator
 * @package Zie\DeviceDetector\Sha1Generator
 */
class Sha1Generator implements FingerprintGeneratorInterface
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
