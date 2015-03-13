<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor\Apple;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IPadVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\Apple\IPadVisitor');
    }

    function it_implement_visitor_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface');
    }

    function it_is_instanceof_apple_mobile_visitor()
    {
        $this->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Visitor\Apple\AppleMobileVisitor');
    }

    function it_should_recognize_apple_device(TokenInterface $token, CollectorInterface $collectorInterface)
    {
        $token->getData()
            ->shouldBeCalledTimes(1)
            ->willReturn('Mozilla/5.0 (iPad2,2; iPad; U; CPU OS 7_0 like Mac OS X; nl_NL) com.google.GooglePlus/23341 (KHTML, like Gecko) Mobile/K94AP (gzip)');

        $collectorInterface
            ->hasCapability(Argument::exact(Capabilities::OS))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::IS_IOS), Argument::exact(true))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS), Argument::exact(Capabilities::OS_IOS))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS_VENDOR), Argument::exact(Capabilities::VENDOR_APPLE))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::BRAND_NAME), Argument::exact('iPad'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS_VERSION), Argument::exact('7.0'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::BRAND_NAME_FULL), Argument::exact('iPad 2'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $this->visit($token, $collectorInterface)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
