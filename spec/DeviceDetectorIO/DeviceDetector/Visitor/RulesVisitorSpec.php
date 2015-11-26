<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\Collator;
use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Matcher\MatcherInterface;
use DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy\MergingStrategyInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RulesVisitorSpec.
 */
class RulesVisitorSpec extends ObjectBehavior
{
    public function let(MatcherInterface $matcher, MergingStrategyInterface $mergingStrategy)
    {
        $this->beConstructedWith($matcher, $mergingStrategy);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\RulesVisitor');
    }

    public function it_implement_visitor_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface');
    }

    public function it_is_instanceof_useragent_tokenized_visitor()
    {
        $this->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentTokenizedVisitor');
    }

    public function it_accept_useragent_tokenized_token()
    {
        $collator = new Collator();
        $userAgentToken = new UserAgentToken('userAgent');
        $this->accept(new UserAgentTokenizedToken($userAgentToken, new UserAgentTokenizer()), $collator)->shouldReturn(
            true
        );
        $this->accept($userAgentToken, $collator)->shouldReturn(false);
    }

    public function it_visit_token(
        MatcherInterface $matcher,
        TokenInterface $token,
        CollatorInterface $collator,
        MatcherInterface $matcher,
        MergingStrategyInterface $mergingStrategy,
        RuleInterface $rule
    ) {
        $this->beConstructedWith($matcher, $mergingStrategy);

        $rules = new \ArrayIterator([$rule->getWrappedObject()]);

        $matcher->match(Argument::exact($token->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn($rules);

        $mergingStrategy->merge(Argument::exact($rules), Argument::exact($collator->getWrappedObject()))
            ->shouldBeCalledTimes(1);

        $this->visit($token, $collator)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
