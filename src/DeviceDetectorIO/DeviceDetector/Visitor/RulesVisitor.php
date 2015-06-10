<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Matcher\MatcherInterface;
use DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\MergingStrategyInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class RulesVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class RulesVisitor extends AbstractUserAgentTokenizedVisitor
{
    /**
     * @var MatcherInterface
     */
    private $matcher;

    /**
     * @var MergingStrategyInterface
     */
    private $mergingStrategy;

    /**
     * @param MatcherInterface $matcher
     * @param MergingStrategyInterface $mergingStrategy
     */
    public function __construct(MatcherInterface $matcher, MergingStrategyInterface $mergingStrategy)
    {
        $this->matcher = $matcher;
        $this->mergingStrategy = $mergingStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollatorInterface $collator)
    {
        $this->mergingStrategy->merge(
            $this->matcher->match($token),
            $collator
        );

        return self::STATE_SEEKING;
    }
}
