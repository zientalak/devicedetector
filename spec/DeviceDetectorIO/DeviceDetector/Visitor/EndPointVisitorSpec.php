<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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

    function it_is_instanceof_useragent_visitor()
    {
        $this->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor');
    }

    function it_set_endpoint_capabilities(TokenInterface $token, CollectorInterface $collector)
    {
        $collector
            ->getCapability(Argument::exact(Capabilities::IS_MOBILE))
            ->shouldBeCalledTimes(1)
            ->willReturn(null);

        $collector
            ->addCapability(Argument::exact(Capabilities::IS_DESKTOP), Argument::exact(true))
            ->shouldBeCalledTimes(1);

        $collector
            ->getCapability(Argument::exact(Capabilities::IS_SMART_TV))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $collector
            ->addCapability(Argument::exact(Capabilities::IS_SMART_TV), Argument::exact(false))
            ->shouldBeCalledTimes(1);

        $collector
            ->getCapability(Argument::exact(Capabilities::IS_ROBOT))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $collector
            ->addCapability(Argument::exact(Capabilities::IS_ROBOT), Argument::exact(false))
            ->shouldBeCalledTimes(1);

        $this->visit($token, $collector)->shouldReturn(VisitorInterface::STATE_SEEKING);

    }
}
