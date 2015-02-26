<?php

namespace DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;

class IssetMatchingStrategy implements MatchingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function match($rule, TokenInterface $token)
    {
        if (!$token instanceof UserAgentTokenizedToken) {
            return false;
        }

        $tokens = $token->getData();
        foreach ($rule['patterns'] as $pattern) {

            if ('isset' !== $pattern['strategy']) {
                continue;
            }

            if (isset($tokens[$pattern['value']])) {
                return $rule['capabilities'];
            }
        }

        return false;
    }
}