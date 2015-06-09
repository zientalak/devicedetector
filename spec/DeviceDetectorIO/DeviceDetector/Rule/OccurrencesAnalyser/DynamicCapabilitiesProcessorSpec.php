<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DynamicCapabilitiesProcessorSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser
 */
class DynamicCapabilitiesProcessorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\DynamicCapabilitiesProcessor');
    }

    function it_implements_dynamic_capabilities_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\DynamicCapabilitiesProcessorInterface');
    }

    function it_process_dynamic_capabilities(OccurrenceInterface $occurrence, ConditionInterface $condition, NodeInterface $node, RuleInterface $rule)
    {
        $occurrence->getCondition()
            ->shouldBeCalled()
            ->willReturn($condition);

        $occurrence->getNode()
            ->shouldBeCalled()
            ->willReturn($node);

        $occurrence->getRule()
            ->shouldBeCalled()
            ->willReturn($rule);

        $node->getValue()
            ->shouldBeCalled()
            ->willReturn('12.09b');

        $dynamicCapabilities = array('browser_version');
        $condition->getDynamicCapabilities()
            ->shouldBeCalled()
            ->willReturn($dynamicCapabilities);

        $capabilities = array('browser' => 'Chrome');
        $rule->getCapabilities()
            ->shouldBeCalled()
            ->willReturn($capabilities);

        $rule->setCapabilities(Argument::exact(array('browser' => 'Chrome', 'browser_version' => '12.09b')))
            ->shouldBeCalled()
            ->willReturn($rule);

        $this->process($occurrence);
    }
}
