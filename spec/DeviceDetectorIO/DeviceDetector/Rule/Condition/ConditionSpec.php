<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Condition;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ConditionSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Condition
 */
class ConditionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition');
    }

    function it_implements_condition_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface');
    }

    function it_is_accessible_value_object()
    {
        $this->setType(ConditionInterface::TYPE_TEXT)->shouldReturn($this);
        $this->getType()->shouldReturn(ConditionInterface::TYPE_TEXT);
        $this->isType(ConditionInterface::TYPE_TEXT)->shouldReturn(true);
        $this->setValue('Condition Value')->shouldReturn($this);
        $this->getValue()->shouldReturn('Condition Value');
        $this->setStrategy(ConditionInterface::STRATEGY_NEXT)->shouldReturn($this);
        $this->getStrategy()->shouldReturn(ConditionInterface::STRATEGY_NEXT);
        $this->isStrategy(ConditionInterface::STRATEGY_NEXT)->shouldReturn(true);
        $this->setPosition(1)->shouldReturn($this);
        $this->getPosition()->shouldReturn(1);
        $this->setDynamicCapabilities(array('is_bot' => true))->shouldReturn($this);
        $this->getDynamicCapabilities()->shouldReturn(array('is_bot' => true));
    }

    function it_is_serializable()
    {
        $this->setType(ConditionInterface::TYPE_TEXT);
        $this->setValue('Serialized Value');
        $this->setStrategy(ConditionInterface::STRATEGY_NEXT);
        $this->setPosition(1);
        $this->setDynamicCapabilities(array('is_bot' => true));

        $this->serialize()->shouldReturn(
            serialize(
                array(
                    'type' => ConditionInterface::TYPE_TEXT,
                    'value' => 'Serialized Value',
                    'strategy' => ConditionInterface::STRATEGY_NEXT,
                    'position' => 1,
                    'dynamicCapabilities' => array('is_bot' => true)
                )
            )
        );

        $data = array(
            'type' => ConditionInterface::TYPE_REGEX,
            'value' => '[a-zA-Z]+',
            'strategy' => ConditionInterface::STRATEGY_LINE,
            'position' => 10,
            'dynamicCapabilities' => array('is_bot' => false)
        );

        $this->unserialize(serialize($data));

        $this->getValue()->shouldReturn($data['value']);
        $this->getType()->shouldReturn($data['type']);
        $this->getPosition()->shouldReturn($data['position']);
        $this->getStrategy()->shouldReturn($data['strategy']);
        $this->getDynamicCapabilities()->shouldReturn($data['dynamicCapabilities']);
        $this->isType($data['type'])->shouldReturn(true);
        $this->isStrategy($data['strategy'])->shouldReturn(true);
    }
}
