<?php

namespace spec\DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MatchingStrategyChainSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyChain');
    }

    function it_implements_matching_strategy()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyInterface');
    }

    function it_return_false_if_not_match(
        MatchingStrategyInterface $strategy,
        TokenInterface $token
    ) {
        $matchFalse = array(false);

        $strategy->match(Argument::exact($matchFalse), Argument::exact($token->getWrappedObject()))
            ->willReturn(false)
            ->shouldBeCalledTimes(1);

        $this->addStrategy($strategy)->shouldReturn($this);

        $this
            ->match($matchFalse, $token)
            ->shouldReturn(false);
    }

    function it_return_capabilities_if_match(
        MatchingStrategyInterface $strategy,
        TokenInterface $token
    ) {
        $matchFalse = array(true);

        $strategy->match(Argument::exact($matchFalse), Argument::exact($token->getWrappedObject()))
            ->willReturn(array('capability' => true))
            ->shouldBeCalledTimes(1);

        $this->addStrategy($strategy)->shouldReturn($this);

        $this
            ->match($matchFalse, $token)
            ->shouldReturn(array('capability' => true));
    }
}
