<?php

namespace DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface MatchingStrategyInterface
 * @package DeviceDetectorIO\DeviceDetector\MatchingStrategy
 */
interface MatchingStrategyInterface
{
    /**
     * Match using specific matching strategy.
     * @param array $rule
     * @param TokenInterface $token
     * @return boolean|array False if not match, matched elements otherwise.
     */
    public function match(array $rule, TokenInterface $token);
}
