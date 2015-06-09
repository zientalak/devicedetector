<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Incrementation;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class IncrementationSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Incrementation
 */
class IncrementationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Incrementation\Incrementation');
    }

    function it_implements_incrementation_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Incrementation\IncrementationInterface');
    }

    function it_increment_next_strategy(
        OccurrenceInterface $current,
        ConditionInterface $currentCondition,
        NodeInterface $currentNode,
        OccurrenceInterface $previous,
        NodeInterface $previousNode
    ) {
        $current->getCondition()
            ->shouldBeCalled()
            ->willReturn($currentCondition);

        $current->getNode()
            ->shouldBeCalled()
            ->willReturn($currentNode);

        $previous->getNode()
            ->shouldBeCalled()
            ->willReturn($previousNode);

        $currentCondition->isStrategy(Argument::exact(ConditionInterface::STRATEGY_NEXT))
            ->shouldBeCalled()
            ->willReturn(true);

        $currentNode->getPosition()
            ->shouldBeCalled()
            ->willReturn(3);

        $previousNode->getPosition()
            ->shouldBeCalled()
            ->willReturn(1);

        $this->oughtToBeIncrement($current, $previous)->shouldReturn(false);
    }

    function it_increment_line_strategy(
        OccurrenceInterface $current,
        ConditionInterface $currentCondition,
        NodeInterface $currentNode,
        OccurrenceInterface $previous,
        NodeInterface $previousNode
    ) {
        $current->getCondition()
            ->shouldBeCalled()
            ->willReturn($currentCondition);

        $current->getNode()
            ->shouldBeCalled()
            ->willReturn($currentNode);

        $previous->getNode()
            ->shouldBeCalled()
            ->willReturn($previousNode);

        $currentCondition->isStrategy(Argument::exact(ConditionInterface::STRATEGY_NEXT))
            ->shouldBeCalled()
            ->willReturn(false);

        $currentNode->getPosition()
            ->shouldBeCalled()
            ->willReturn(3);

        $previousNode->getPosition()
            ->shouldBeCalled()
            ->willReturn(1);

        $this->oughtToBeIncrement($current, $previous)->shouldReturn(true);
    }
}
