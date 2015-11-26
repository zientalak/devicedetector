<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class RegexEvaluator.
 */
class RegexEvaluator implements EvaluatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function evaluate(TokenInterface $token, ConditionInterface $condition, RuleInterface $rule)
    {
        $matches = [];

        if (preg_match($condition->getValue(), (string) $token, $matches)) {
            $dynamicCapabilitiesToMerge = [];
            $dynamicCapabilities = $condition->getDynamicCapabilities();

            if (!empty($dynamicCapabilities)) {
                foreach ($dynamicCapabilities as $matchKey) {
                    if (isset($matches[$matchKey])) {
                        $dynamicCapabilitiesToMerge[$matchKey] = $matches[$matchKey];
                    }
                }
            }

            $rule->setCapabilities(
                array_merge(
                    $dynamicCapabilitiesToMerge,
                    $rule->getCapabilities()
                )
            );

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return ConditionInterface::TYPE_REGEX;
    }
}
