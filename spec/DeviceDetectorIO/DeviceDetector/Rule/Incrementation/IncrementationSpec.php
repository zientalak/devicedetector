<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Incrementation;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class IncrementationSpec.
 */
class IncrementationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Incrementation\Incrementation');
    }

    public function it_implements_incrementation_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Incrementation\IncrementationInterface');
    }

    public function it_increment_next_strategy(
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

    public function it_increment_line_strategy(
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
