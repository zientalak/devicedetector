<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Occurrence;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrence;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Rule;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\Node;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OccurrencesSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Occurrence
 */
class OccurrencesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrences');
    }

    function it_implements_occurrences_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrencesInterface');
    }

    function it_add_and_clear_occurrences(OccurrenceInterface $occurence, RuleInterface $rule)
    {
        $occurence->getRule()
            ->shouldBeCalled()
            ->willReturn($rule);

        $this->add($occurence)->shouldReturn($this);
        $this->clear()->shouldReturn($this);
    }

    function it_return_first_occurrences()
    {
        $condition = new Condition();
        $condition->setPosition(0);
        $occurence1 = new Occurrence(new Rule(), $condition, new Node('', NodeInterface::TYPE_SPACE, 1));

        $condition = new Condition();
        $condition->setPosition(1);
        $occurence2 = new Occurrence(new Rule(), $condition, new Node('', NodeInterface::TYPE_SPACE, 1));

        $this->add($occurence1);
        $this->add($occurence2);

        $firstOccurrences = $this->getFirstOccurrences();
        $firstOccurrences->shouldBeAnInstanceOf('\Iterator');
        $firstOccurrences->shouldHaveCount(1);
        $firstOccurrences->shouldHaveKey($occurence1);
    }

    function it_return_next_position()
    {
        $rule = new Rule();
        $condition = new Condition();
        $condition->setPosition(0);
        $occurence1 = new Occurrence($rule, $condition, new Node('', NodeInterface::TYPE_SPACE, 1));

        $condition = new Condition();
        $condition->setPosition(1);
        $occurence2 = new Occurrence($rule, $condition, new Node('', NodeInterface::TYPE_SPACE, 2));

        $this->add($occurence1);
        $this->add($occurence2);

        $this->getNext($occurence1)->shouldBeEqualTo($occurence2);
        $this->getNext($occurence2)->shouldReturn(false);
    }
}
