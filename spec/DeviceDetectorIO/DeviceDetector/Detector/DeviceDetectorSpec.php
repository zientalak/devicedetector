<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Detector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManagerInterface;

/**
 * Class DeviceDetectorSpec.
 */
class DeviceDetectorSpec extends ObjectBehavior
{
    public function let(VisitorManagerInterface $visitorManager, CollatorInterface $collator)
    {
        $this->beConstructedWith($visitorManager, $collator);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Detector\DeviceDetector');
    }

    public function it_implements_detector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface');
    }

    public function it_detect_device(
        TokenPoolInterface $tokenPool,
        CollatorInterface $collator,
        VisitorManagerInterface $visitorManager
    ) {
        $visitorManager
            ->visit(
                Argument::exact($tokenPool->getWrappedObject()),
                Argument::exact($collator->getWrappedObject())
            )
            ->shouldBeCalledTimes(1)
            ->willReturn(VisitorInterface::STATE_SEEKING);

        $collator->removeAll()->shouldBeCalledTimes(1);
        $collator->getAll()->shouldBeCalledTimes(1)->willReturn([]);

        $this->beConstructedWith($visitorManager, $collator);

        $this->detect($tokenPool)->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\Device');
    }
}
