<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor\Apple;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OSXVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\Apple\OSXVisitor');
    }

    function it_implement_visitor_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface');
    }

    function it_is_instanceof_useragent_visitor()
    {
        $this->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor');
    }

    function it_should_recognize_osx(TokenInterface $token, CollectorInterface $collectorInterface)
    {
        $token->getData()
            ->shouldBeCalledTimes(1)
            ->willReturn('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1');

        $collectorInterface
            ->hasCapability(Argument::exact(Capabilities::OS))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS), Argument::exact(Capabilities::OS_OSX))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS_VENDOR), Argument::exact(Capabilities::VENDOR_APPLE))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS_FAMILY), Argument::exact(Capabilities::OS_FAMILY_UNIX))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $collectorInterface
            ->addCapability(Argument::exact(Capabilities::OS_VERSION), Argument::exact('10.8.5'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collectorInterface);

        $this->visit($token, $collectorInterface)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
