<?php

namespace DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;

/**
 * Class RegexMatchingStrategy
 * @package DeviceDetectorIO\DeviceDetector\MatchingStrategy
 */
class RegexMatchingStrategy implements MatchingStrategyInterface
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

            if ('regex' !== $pattern['strategy']) {
                continue;
            }

            $matches = array();
            if (preg_match($pattern['value'], $userAgent, $matches)) {

                if (isset($pattern['matches'])) {
                    foreach ($pattern['matches'] as $matchKey) {
                        if (isset($matches[$matchKey])) {
                            $rule['capabilities'][$matchKey] = $matches[$matchKey];
                        }
                    }
                }

                return $rule['capabilities'];
            }
        }

        return false;
    }
}
