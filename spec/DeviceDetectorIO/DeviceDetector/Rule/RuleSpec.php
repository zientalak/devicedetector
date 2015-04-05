<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RuleSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule
 */
class RuleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Rule');
    }

    function it_implements_occurrence_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\RuleInterface');
    }

    function it_add_condition(ConditionInterface $condition)
    {
        $this->addCondition($condition)->shouldReturn(true);
        $this->addCondition($condition)->shouldReturn(false);
    }

    function it_has_condition(ConditionInterface $condition)
    {
        $this->hasCondition($condition)->shouldReturn(false);
        $this->addCondition($condition);
        $this->hasCondition($condition)->shouldReturn(true);
    }

    function it_remove_condition(ConditionInterface $condition)
    {
        $this->removeCondition($condition)->shouldReturn(false);
        $this->addCondition($condition);
        $this->removeCondition($condition)->shouldReturn(true);
    }

    function it_remove_all_conditions(ConditionInterface $condition)
    {
        $this->addCondition($condition);
        $this->hasCondition($condition)->shouldReturn(true);
        $this->removeConditions()->shouldReturn(true);
        $this->hasCondition($condition)->shouldReturn(false);
    }

    function it_set_priority()
    {
        $this->setPriority(2)->shouldReturn($this);
        $this->getPriority()->shouldReturn(2);
    }

    function it_set_capabilities()
    {
        $this->setCapabilities(array('is_bot' => true))->shouldReturn($this);
        $this->getCapabilities()->shouldReturn(array('is_bot' => true));
    }

    function it_set_category()
    {
        $this->setCategory('browser')->shouldReturn($this);
        $this->getCategory()->shouldReturn('browser');
    }
}
