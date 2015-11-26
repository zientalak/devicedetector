<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;

/**
 * Class DefaultHandler.
 */
class DefaultHandler implements HandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(array $configuration, RuleInterface $rule)
    {
        $rule->setPriority((int) $configuration['priority']);
        $rule->setCategory($configuration['category']);
        $rule->setCapabilities($configuration['capabilities']);

        $this->handleConditions($configuration, $rule);
    }

    /**
     * @param array         $configuration
     * @param RuleInterface $rule
     */
    private function handleConditions(array $configuration, RuleInterface $rule)
    {
        foreach ($configuration['conditions'] as $position => $conditionConfiguration) {
            $condition = new Condition();
            $condition->setType($conditionConfiguration['type']);
            $condition->setValue($conditionConfiguration['value']);
            $condition->setStrategy(
                isset($conditionConfiguration['strategy']) ? $conditionConfiguration['strategy'] : ConditionInterface::STRATEGY_NEXT
            );
            $condition->setPosition($position);
            $condition->setDynamicCapabilities(
                isset($conditionConfiguration['capabilities']) ? $conditionConfiguration['capabilities'] : []
            );

            $rule->addCondition($condition);
        }
    }
}
