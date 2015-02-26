<?php

namespace DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;

/**
 * Class StriposMatchingStrategy
 * @package DeviceDetectorIO\DeviceDetector\MatchingStrategy
 */
class StriposMatchingStrategy implements MatchingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function match($rule, TokenInterface $token)
    {
        if (!$token instanceof UserAgentToken) {
            return false;
        }

        $userAgent = $token->getData();
        foreach ($rule['patterns'] as $pattern) {

            if ('stripos' !== $pattern['strategy']) {
                continue;
            }

            if (false !== stripos($userAgent, $pattern['value'])) {
                return $rule['capabilities'];
            }
        }

        return false;
    }
}
