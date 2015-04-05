<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Capability\Collator;
use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Matcher\MatcherInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RulesVisitorSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Visitor
 */
class RulesVisitorSpec extends ObjectBehavior
{
    function let(MatcherInterface $matcher)
    {
        $this->beConstructedWith($matcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\RulesVisitor');
    }

    function it_implement_visitor_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface');
    }

    function it_is_instanceof_useragent_tokenized_visitor()
    {
        $this->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentTokenizedVisitor');
    }

    function it_accept_useragent_tokenized_token()
    {
        $collator = new Collator();
        $userAgentToken = new UserAgentToken('userAgent');
        $this->accept(new UserAgentTokenizedToken($userAgentToken, new UserAgentTokenizer()), $collator)->shouldReturn(
            true
        );
        $this->accept($userAgentToken, $collator)->shouldReturn(false);
    }

    function it_visit_token(
        MatcherInterface $matcher,
        TokenInterface $token,
        CollatorInterface $collator,
        RuleInterface $rule,
        ConditionInterface $condition
    ) {
        $this->beConstructedWith($matcher);

        $capabilities = array(
            Capabilities::IS_BOT => true,
            Capabilities::BOT_NAME => 'Spider360'
        );
        $rule->getCapabilities()
            ->shouldBeCalledTimes(1)
            ->willReturn($capabilities);

        $matcher->match(Argument::exact($token->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(new \ArrayIterator(array($rule->getWrappedObject())));

        $collator->merge(Argument::exact($capabilities))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $this->visit($token, $collator)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
