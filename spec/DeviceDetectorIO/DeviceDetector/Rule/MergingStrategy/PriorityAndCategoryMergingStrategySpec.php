<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy;

use DeviceDetectorIO\DeviceDetector\Capability\Collator;
use DeviceDetectorIO\DeviceDetector\Rule\Rule;
use PhpSpec\ObjectBehavior;

/**
 * Class PriorityAndCategoryMergingStrategySpec.
 */
class PriorityAndCategoryMergingStrategySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(
            'DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\PriorityAndCategoryMergingStrategy'
        );
    }

    public function it_implements_merging_strategy_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\MergingStrategyInterface');
    }

    public function it_merge_rule_by_category_with_higher_priority(Collator $collator)
    {
        $rule1 = $this->createRule(
            'browser',
            1,
            ['browser_name' => 'Firefox']
        );

        $rule2 = $this->createRule(
            'browser',
            255,
            ['browser_name' => 'Fennec']
        );

        $rule3 = $this->createRule(
            'os',
            1,
            ['os_name' => 'Windows 7']
        );

        $rules = new \ArrayIterator(
            [
                $rule1,
                $rule2,
                $rule3,
            ]
        );

        $collator->merge(
            ['browser_name' => 'Fennec']
        )->shouldBeCalled();

        $collator->merge(
            ['os_name' => 'Windows 7']
        )->shouldBeCalled();

        $this->merge($rules, $collator);
    }

    /**
     * @param $category
     * @param $priority
     * @param $capabilities
     *
     * @return Rule
     */
    private function createRule($category, $priority, $capabilities)
    {
        $rule = new Rule();
        $rule->setCategory($category);
        $rule->setPriority($priority);
        $rule->setCapabilities($capabilities);

        return $rule;
    }
}
