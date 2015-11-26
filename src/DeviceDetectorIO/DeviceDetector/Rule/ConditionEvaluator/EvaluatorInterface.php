<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface EvaluatorInterface.
 */
interface EvaluatorInterface
{
    /**
     * @param TokenInterface     $token
     * @param ConditionInterface $condition
     * @param RuleInterface      $rule
     *
     * @return bool
     */
    public function evaluate(TokenInterface $token, ConditionInterface $condition, RuleInterface $rule);

    /**
     * @return string
     */
    public function getName();
}
