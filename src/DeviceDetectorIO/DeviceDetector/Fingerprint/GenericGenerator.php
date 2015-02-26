<?php

namespace DeviceDetectorIO\DeviceDetector\Fingerprint;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;

/**
 * Class GenericGenerator
 * @package DeviceDetectorIO\DeviceDetector\GenericGenerator
 */
class GenericGenerator implements FingerprintGeneratorInterface
{
    const SHA1_ALGORITHM = 'sha1';

    /**
     * @var string
     */
    private $algorithm;

    /**
     * @param string $algorithm
     */
    public function __construct($algorithm = self::SHA1_ALGORITHM)
    {
        if (!in_array($algorithm, hash_algos())) {
            throw new \InvalidArgumentException(sprintf('Unknown algorithm "%s".', $algorithm));
        }

        $this->algorithm = $algorithm;
    }

    /**
     * {@inheritDoc)
     */
    public function getFingerprint(TokenPoolInterface $tokenPool)
    {
        if (!$tokenPool->count()) {
            throw new \LogicException("Generate fingerprint on empty token pool it's not possible.");
        }

        $hashContext = hash_init($this->algorithm);

        /** @var $token TokenInterface */
        foreach ($tokenPool->getTokens() as $token) {
            hash_update($hashContext, serialize($token));
        }

        return hash_final($hashContext);
    }
}
