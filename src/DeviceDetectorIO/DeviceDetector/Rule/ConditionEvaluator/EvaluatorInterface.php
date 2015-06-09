<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface EvaluatorInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator
 */
interface EvaluatorInterface
{
    /**
     * @param TokenInterface $token
     * @param ConditionInterface $condition
     * @param RuleInterface $rule
     * @return boolean
     */
    public function evaluate(TokenInterface $token, ConditionInterface $condition, RuleInterface $rule);

    /**
     * @return string
     */
    public function getName();
}
