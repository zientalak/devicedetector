<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Visitor\OS;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AndroidReleaseVisitorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Visitor\OS\AndroidReleaseVisitor');
    }

    function it_implement_visitor_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface');
    }

    function it_is_instanceof_useragent_visitor()
    {
        $this->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor');
    }

    function it_match_android_release(TokenInterface $token, CollectorInterface $collector)
    {
        $collector
            ->getCapability(Argument::exact(Capabilities::OS))
            ->shouldBeCalledTimes(1)
            ->willReturn(Capabilities::OS_ANDROID);

        $collector
            ->getCapability(Argument::exact(Capabilities::OS_VERSION))
            ->shouldBeCalledTimes(1)
            ->willReturn('5.0');

        $collector
            ->addCapability(Argument::exact(Capabilities::OS_RELEASE), Argument::exact('Lollipop'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collector);

        $this->visit($token, $collector)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }

    function it_match_android_version_from_release(TokenInterface $token, CollectorInterface $collector)
    {
        $collector
            ->getCapability(Argument::exact(Capabilities::OS))
            ->shouldBeCalledTimes(1)
            ->willReturn(Capabilities::OS_ANDROID);

        $collector
            ->getCapability(Argument::exact(Capabilities::OS_VERSION))
            ->shouldBeCalledTimes(1)
            ->willReturn('Lollipop');

        $collector
            ->addCapability(Argument::exact(Capabilities::OS_RELEASE), Argument::exact('Lollipop'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collector);

        $collector
            ->addCapability(Argument::exact(Capabilities::OS_VERSION), Argument::exact('5.0'))
            ->shouldBeCalledTimes(1)
            ->willReturn($collector);

        $this->visit($token, $collector)->shouldReturn(VisitorInterface::STATE_SEEKING);
    }
}
