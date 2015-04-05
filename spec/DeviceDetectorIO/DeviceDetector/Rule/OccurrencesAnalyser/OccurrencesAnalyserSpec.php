<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Incrementation\IncrementationInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrencesInterface;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\DynamicCapabilitiesProcessorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class OccurrencesAnalyserSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser
 */
class OccurrencesAnalyserSpec extends ObjectBehavior
{
    public function let(
        IncrementationInterface $incrementation,
        DynamicCapabilitiesProcessorInterface $dynamicCapabilitiesProcessor
    ) {
        $this->beConstructedWith($incrementation, $dynamicCapabilitiesProcessor);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\OccurrencesAnalyser');
    }

    function it_implements_analyser_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\OccurrencesAnalyserInterface');
    }

    function it_return_positive_analyse_occurrences(
        IncrementationInterface $incrementation,
        DynamicCapabilitiesProcessorInterface $dynamicCapabilitiesProcessor,
        OccurrencesInterface $occurences,
        OccurrenceInterface $occurence1,
        OccurrenceInterface $occurence2,
        RuleInterface $rule
    ) {
        $this->beConstructedWith($incrementation, $dynamicCapabilitiesProcessor);

        $rule->getConditions()
            ->shouldBeCalled()
            ->willReturn(array(1, 2));

        $occurence1->getRule()
            ->shouldBeCalled()
            ->willReturn($rule);

        $occurence2->getRule()
            ->shouldBeCalled()
            ->willReturn($rule);

        $dynamicCapabilitiesProcessor
            ->process(Argument::exact($occurence1->getWrappedObject()))
            ->shouldBeCalled();

        $dynamicCapabilitiesProcessor
            ->process(Argument::exact($occurence2->getWrappedObject()))
            ->shouldBeCalled();

        $occurencesIterator = array(
            $occurence1,
            $occurence2
        );

        $occurences->getFirstOccurrences()
            ->shouldBeCalled()
            ->willReturn($occurencesIterator);

        $occurences->getNext(Argument::exact($occurence1->getWrappedObject()))
            ->shouldBeCalled()
            ->willReturn($occurence2);

        $occurences->getNext(Argument::exact($occurence2->getWrappedObject()))
            ->shouldBeCalled()
            ->willReturn(false);

        $incrementation->oughtToBeIncrement($occurence2->getWrappedObject(), $occurence1->getWrappedObject())
            ->shouldBeCalled()
            ->willReturn(true);

        $results = $this->analyse($occurences);
        $results->shouldBeAnInstanceOf('\Iterator');
        $results->shouldHaveCount(1);
        $results->shouldHaveKey($rule);
    }

    function it_return_negative_analyse_occurrences(
        IncrementationInterface $incrementation,
        DynamicCapabilitiesProcessorInterface $dynamicCapabilitiesProcessor,
        OccurrencesInterface $occurences,
        OccurrenceInterface $occurence1,
        OccurrenceInterface $occurence2,
        RuleInterface $rule
    ) {
        $this->beConstructedWith($incrementation, $dynamicCapabilitiesProcessor);

        $rule->getConditions()
            ->shouldBeCalled()
            ->willReturn(array(1, 2, 3));

        $occurence1->getRule()
            ->shouldBeCalled()
            ->willReturn($rule);

        $occurence2->getRule()
            ->shouldBeCalled()
            ->willReturn($rule);

        $dynamicCapabilitiesProcessor
            ->process(Argument::exact($occurence1->getWrappedObject()))
            ->shouldBeCalled();

        $dynamicCapabilitiesProcessor
            ->process(Argument::exact($occurence2->getWrappedObject()))
            ->shouldBeCalled();

        $occurencesIterator = array(
            $occurence1,
            $occurence2
        );

        $occurences->getFirstOccurrences()
            ->shouldBeCalled()
            ->willReturn($occurencesIterator);

        $occurences->getNext(Argument::exact($occurence1->getWrappedObject()))
            ->shouldBeCalled()
            ->willReturn($occurence2);

        $occurences->getNext(Argument::exact($occurence2->getWrappedObject()))
            ->shouldBeCalled()
            ->willReturn(false);

        $incrementation->oughtToBeIncrement($occurence2->getWrappedObject(), $occurence1->getWrappedObject())
            ->shouldBeCalled()
            ->willReturn(true);

        $results = $this->analyse($occurences);
        $results->shouldBeAnInstanceOf('\Iterator');
        $results->shouldHaveCount(0);
    }
}
