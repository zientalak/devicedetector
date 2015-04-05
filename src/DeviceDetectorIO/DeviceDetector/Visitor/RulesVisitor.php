<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Matcher\MatcherInterface;
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
     * @param MatcherInterface $matcher
     */
    public function __construct(MatcherInterface $matcher)
    {
        $this->matcher = $matcher;
    }

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollatorInterface $collator)
    {
        $rules = $this->matcher->match($token);

        /** @var RuleInterface $rule */
        foreach ($rules as $rule) {
            $collator->merge($rule->getCapabilities());
        }

        return self::STATE_SEEKING;
    }
}
