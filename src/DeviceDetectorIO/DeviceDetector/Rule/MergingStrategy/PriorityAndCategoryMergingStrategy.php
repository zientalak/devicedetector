<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;

/**
 * Class PriorityAndCategoryMergingStrategy
 * @package DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy
 */
class PriorityAndCategoryMergingStrategy implements MergingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function merge(\Iterator $rules, CollatorInterface $collator)
    {
        /**
         * @var RuleInterface $rule
         */
        foreach ($this->getRulesGroupedByCategoryWithHigherPriority($rules) as $rule) {
            $collator->merge($rule->getCapabilities());
        }
    }

    /**
     * @param $rules
     * @return array
     */
    protected function getRulesGroupedByCategoryWithHigherPriority($rules)
    {
        $rulesByCategory = array();

        /**
         * @var RuleInterface $rule
         */
        foreach ($rules as $rule) {
            $category = $rule->getCategory();

            if (!isset($rulesByCategory[$category])) {
                $rulesByCategory[$category] = $rule;
                continue;
            }

            if ($rule->getPriority() > $rulesByCategory[$category]->getPriority()) {
                $rulesByCategory[$category] = $rule;
            }
        }

        return $rulesByCategory;
    }
}
