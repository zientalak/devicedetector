<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Comparer;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TypeAndValueComparerSpec.
 */
class TypeAndValueComparerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Comparer\TypeAndValueComparer');
    }

    public function it_implements_comparer_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Comparer\ComparerInterface');
    }

    public function it_return_true_whether_space_type(NodeInterface $node, ConditionInterface $condition)
    {
        $node->isType(Argument::exact(NodeInterface::TYPE_SPACE))
            ->willReturn(true)
            ->shouldBeCalledTimes(1);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_SPACE))
            ->willReturn(true)
            ->shouldBeCalledTimes(1);

        $this->areEquals($node, $condition)->shouldReturn(true);
    }

    public function it_return_true_if_condition_is_placeholder(NodeInterface $node, ConditionInterface $condition)
    {
        $condition->isType(Argument::exact(ConditionInterface::TYPE_PLACEHOLDER))
            ->willReturn(true)
            ->shouldBeCalledTimes(1);

        $this->areEquals($node, $condition)->shouldReturn(true);
    }

    public function it_return_false_if_text_types_not_correspond(NodeInterface $node, ConditionInterface $condition)
    {
        $node->isType(Argument::exact(NodeInterface::TYPE_SPACE))
            ->willReturn(false);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_SPACE))
            ->willReturn(false);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_PLACEHOLDER))
            ->willReturn(false);

        $node->isType(Argument::exact(NodeInterface::TYPE_TEXT))
            ->willReturn(true)
            ->shouldBeCalledTimes(1);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_TEXT))
            ->willReturn(false)
            ->shouldBeCalledTimes(1);

        $this->areEquals($node, $condition)->shouldReturn(false);
    }

    public function it_return_true_if_text_types_not_correspond(NodeInterface $node, ConditionInterface $condition)
    {
        $node->isType(Argument::exact(NodeInterface::TYPE_SPACE))
            ->willReturn(false);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_SPACE))
            ->willReturn(false);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_PLACEHOLDER))
            ->willReturn(false);

        $node->isType(Argument::exact(NodeInterface::TYPE_TEXT))
            ->willReturn(true)
            ->shouldBeCalledTimes(1);

        $condition->isType(Argument::exact(ConditionInterface::TYPE_TEXT))
            ->willReturn(true)
            ->shouldBeCalledTimes(1);

        $node->getValue()
            ->willReturn('value')
            ->shouldBeCalledTimes(1);

        $condition->getValue()
            ->willReturn('value')
            ->shouldBeCalledTimes(1);

        $this->areEquals($node, $condition)->shouldReturn(true);
    }
}
