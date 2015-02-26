<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\Collector\Collector;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPool;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeviceDetectorSpec extends ObjectBehavior
{
    function let(VisitorManager $visitorManager, TokenPool $tokenPool, Collector $collector)
    {
        $this->beConstructedWith($visitorManager, $tokenPool, $collector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Detector\DeviceDetector');
    }

    function it_implements_detector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface');
    }

    function it_detect_device(VisitorManager $visitorManager, TokenPool $tokenPool, Collector $collector)
    {
        $this->init_collector($collector);
        $this->init_visitor_manager(
            $visitorManager,
            $tokenPool->getWrappedObject(),
            $collector->getWrappedObject()
        );

        $this->detect()->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\Device');
    }

    private function init_visitor_manager(
        VisitorManager $visitorManager,
        TokenPoolInterface $tokenPool,
        CollectorInterface $collector
    ) {
        $visitorManager
            ->visit(
                Argument::exact($tokenPool),
                Argument::exact($collector)
            )
            ->shouldBeCalledTimes(1);
    }

    private function init_collector(Collector $collector)
    {
        $collector->clear()->shouldBeCalledTimes(1);
        $collector->getCapabilities()->shouldBeCalledTimes(1)->willReturn(array());
    }
}
