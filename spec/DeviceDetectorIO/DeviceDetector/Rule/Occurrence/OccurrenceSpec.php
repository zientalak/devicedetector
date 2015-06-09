<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Occurrence;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OccurrenceSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Occurrence
 */
class OccurrenceSpec extends ObjectBehavior
{
    public function let(RuleInterface $rule, ConditionInterface $condition, NodeInterface $node)
    {
        $this->beConstructedWith($rule, $condition, $node);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrence');
    }

    function it_implements_occurrence_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface');
    }

    function it_return_expected_types()
    {
        $this->getRule()->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Rule\RuleInterface');
        $this->getCondition()->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface');
        $this->getNode()->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface');
    }
}
