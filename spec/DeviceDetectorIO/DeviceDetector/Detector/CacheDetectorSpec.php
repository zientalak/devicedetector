<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\CacheProvider\GenericProvider;
use DeviceDetectorIO\DeviceDetector\Collector\Collector;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use DeviceDetectorIO\DeviceDetector\Fingerprint\GenericGenerator;
use DeviceDetectorIO\DeviceDetector\Token\TokenPool;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CacheDetectorSpec extends ObjectBehavior
{
    function let(VisitorManager $visitorManager, TokenPool $tokenPool, Collector $collector)
    {
        $this->beConstructedWith($visitorManager, $tokenPool, $collector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Detector\CacheDetector');
    }

    function it_implements_detector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface');
    }

    function it_detect_device_and_add_to_cache(
        VisitorManager $visitorManager,
        TokenPool $tokenPool,
        Collector $collector,
        GenericProvider $provider,
        GenericGenerator $generator
    ) {
        $this->init_collector($collector);
        $this->init_visitor_manager(
            $visitorManager,
            $tokenPool->getWrappedObject(),
            $collector->getWrappedObject()
        );

        $fingerprint = sha1(time());

        $generator
            ->getFingerprint(Argument::exact($tokenPool->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn($fingerprint);

        $this->setFingerprintGenerator($generator);

        $provider
            ->getDevice(Argument::exact($fingerprint))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $provider
            ->addDevice(Argument::type('DeviceDetectorIO\DeviceDetector\Device\CacheDevice'))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $this->setCacheProvider($provider);

        $this->detect()->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    function it_detect_device_from_cache(
        TokenPool $tokenPool,
        GenericProvider $provider,
        GenericGenerator $generator
    ) {

        $fingerprint = sha1(time());

        $generator
            ->getFingerprint(Argument::exact($tokenPool->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn($fingerprint);

        $this->setFingerprintGenerator($generator);

        $provider
            ->getDevice(Argument::exact($fingerprint))
            ->shouldBeCalledTimes(1)
            ->willReturn(new CacheDevice(new Device(array()), $fingerprint));

        $this->setCacheProvider($provider);

        $this->detect()->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    private function init_collector(Collector $collector)
    {
        $collector->clear()->shouldBeCalledTimes(1);
        $collector->getCapabilities()->shouldBeCalledTimes(1)->willReturn(array());
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
}
