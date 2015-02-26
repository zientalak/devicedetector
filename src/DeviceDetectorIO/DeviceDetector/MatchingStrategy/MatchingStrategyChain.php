<?php

namespace DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class MatchingStrategyChain
 * @package DeviceDetectorIO\DeviceDetector\MatchingStrategy
 */
class MatchingStrategyChain implements MatchingStrategyInterface
{
    /**
     * @var array
     */
    private $chain = array();

    /**
     * {@inheritdoc}
     */
    public function match($rule, TokenInterface $token)
    {
        /** @var MatchingStrategyInterface $strategy */
        foreach ($this->chain as $strategy) {
            $match = $strategy->match($rule, $token);
            if (false !== $match) {
                return $match;
            }
        }

        return false;
    }

    /**
     * @param MatchingStrategyInterface $strategy
     * @return self
     */
    public function addStrategy(MatchingStrategyInterface $strategy)
    {
        $className = get_class($strategy);
        if (!isset($this->chain[$className])) {
            $this->chain[$className] = $strategy;
        }

        return $this;
    }
}
