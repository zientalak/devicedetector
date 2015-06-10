<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy;

use DeviceDetectorIO\DeviceDetector\Capability\Collator;
use DeviceDetectorIO\DeviceDetector\Rule\Rule;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PriorityAndCategoryMergingStrategySpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy
 */
class PriorityAndCategoryMergingStrategySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(
            'DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\PriorityAndCategoryMergingStrategy'
        );
    }

    function it_implements_merging_strategy_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\MergingStrategyInterface');
    }

    function it_merge_rule_by_category_with_higher_priority(Collator $collator)
    {
        $rule1 = $this->createRule(
            'browser',
            1,
            array('browser_name' => 'Firefox')
        );

        $rule2 = $this->createRule(
            'browser',
            255,
            array('browser_name' => 'Fennec')
        );

        $rule3 = $this->createRule(
            'os',
            1,
            array('os_name' => 'Windows 7')
        );

        $rules = new \ArrayIterator(
            array(
                $rule1,
                $rule2,
                $rule3
            )
        );

        $collator->merge(
            array('browser_name' => 'Fennec')
        )->shouldBeCalled();

        $collator->merge(
            array('os_name' => 'Windows 7')
        )->shouldBeCalled();

        $this->merge($rules, $collator);
    }

    /**
     * @param $category
     * @param $priority
     * @param $capabilities
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
