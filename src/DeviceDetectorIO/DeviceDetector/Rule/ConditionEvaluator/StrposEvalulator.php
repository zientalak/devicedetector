<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class StrposEvalulator.
 */
class StrposEvalulator implements EvaluatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function evaluate(TokenInterface $token, ConditionInterface $condition, RuleInterface $rule)
    {
        return false !== strpos((string) $token, $condition->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return ConditionInterface::TYPE_STRPOS;
    }
}
