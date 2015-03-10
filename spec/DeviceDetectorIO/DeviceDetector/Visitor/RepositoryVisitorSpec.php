<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleRepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositoryVisitorSpec extends ObjectBehavior
{
    function let(RuleRepositoryInterface $repository, MatchingStrategyInterface $strategy)
    {
        $this->beConstructedWith($repository, $strategy);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\RepositoryVisitor');
    }

    function it_implement_repository_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface');
    }

    function it_call_strategy(RuleRepositoryInterface $repository, MatchingStrategyInterface $strategy, TokenInterface $token, CollectorInterface $collector)
    {
        $repository
            ->getRules()
            ->shouldBeCalledTimes(1)
            ->willReturn(array(array()));

        $strategy
            ->match(Argument::exact(array()), Argument::exact($token->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $collector
            ->mergeCapabilities(Argument::any())
            ->shouldNotBeCalled();

        $this->beConstructedWith($repository, $strategy);

        $this->visit($token, $collector)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }

    function it_merge_capabilities(RuleRepositoryInterface $repository, MatchingStrategyInterface $strategy, TokenInterface $token, CollectorInterface $collector)
    {
        $repository
            ->getRules()
            ->shouldBeCalledTimes(1)
            ->willReturn(array(array(1)));

        $strategy
            ->match(Argument::exact(array(1)), Argument::exact($token->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(array(1));

        $collector
            ->mergeCapabilities(Argument::exact(array(1)))
            ->shouldBeCalledTimes(1);

        $this->beConstructedWith($repository, $strategy);

        $this->visit($token, $collector)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
