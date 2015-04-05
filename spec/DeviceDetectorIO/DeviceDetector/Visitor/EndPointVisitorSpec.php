<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Capability\Collator;
use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class EndPointVisitorSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Visitor
 */
class EndPointVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\EndPointVisitor');
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
        $this->accept(new UserAgentTokenizedToken($userAgentToken, new UserAgentTokenizer()), $collator)->shouldReturn(true);
        $this->accept($userAgentToken, $collator)->shouldReturn(false);
    }

    function it_set_endpoint_capabilities(TokenInterface $token, CollatorInterface $collator)
    {
        $collator
            ->get(Argument::exact(Capabilities::IS_CONSOLE))
            ->shouldBeCalledTimes(1)
            ->willReturn(null);

        $collator
            ->set(Argument::exact(Capabilities::IS_CONSOLE), Argument::exact(false))
            ->shouldBeCalledTimes(1);

        $collator
            ->get(Argument::exact(Capabilities::IS_MOBILE))
            ->shouldBeCalledTimes(1)
            ->willReturn(null);

        $collator
            ->set(Argument::exact(Capabilities::IS_DESKTOP), Argument::exact(true))
            ->shouldBeCalledTimes(1);

        $collator
            ->get(Argument::exact(Capabilities::IS_SMART_TV))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $collator
            ->set(Argument::exact(Capabilities::IS_SMART_TV), Argument::exact(false))
            ->shouldBeCalledTimes(1);

        $collator
            ->get(Argument::exact(Capabilities::IS_BOT))
            ->shouldBeCalledTimes(2)
            ->willReturn(false);

        $collator
            ->set(Argument::exact(Capabilities::IS_BOT), Argument::exact(false))
            ->shouldBeCalledTimes(1);

        $collator
            ->set(Argument::exact(Capabilities::IS_MOBILE), Argument::exact(false))
            ->shouldBeCalledTimes(1);

        $this->visit($token, $collator)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
