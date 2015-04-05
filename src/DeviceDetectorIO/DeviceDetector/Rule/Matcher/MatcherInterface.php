<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Matcher;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface MatcherInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Matcher
 */
interface MatcherInterface
{
    /**
     * @param TokenInterface $token
     * @return \Iterator
     */
    public function match(TokenInterface $token);
}
