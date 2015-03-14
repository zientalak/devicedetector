<?php

namespace DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;

/**
 * Class StringMatchingStrategy
 * @package DeviceDetectorIO\DeviceDetector\MatchingStrategy
 */
class StringMatchingStrategy implements MatchingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function match(array $rule, TokenInterface $token)
    {
        if (!$token instanceof UserAgentTokenizedToken) {
            return false;
        }

        $tokens = $token->getData();
        $userAgent = (string)$token;
        foreach ($rule['patterns'] as $pattern) {

            if ('string' !== $pattern['strategy']) {
                continue;
            }

            if (isset($tokens[$pattern['value']])) {
                return $rule['capabilities'];
            }

            if (false !== stripos($userAgent, $pattern['value'])) {
                return $rule['capabilities'];
            }
        }

        return false;
    }
}
