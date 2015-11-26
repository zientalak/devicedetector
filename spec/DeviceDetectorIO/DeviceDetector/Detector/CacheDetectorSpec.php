<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use DeviceDetectorIO\DeviceDetector\DeviceCache\DeviceCacheInterface;
use DeviceDetectorIO\DeviceDetector\Fingerprint\FingerprintGeneratorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManagerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CacheDetectorSpec.
 */
class CacheDetectorSpec extends ObjectBehavior
{
    public function let(VisitorManagerInterface $visitorManager, CollatorInterface $collator)
    {
        $this->beConstructedWith($visitorManager, $collator);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Detector\CacheDetector');
    }

    public function it_implements_detector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Detector\DeviceDetectorInterface');
    }

    public function it_detect_device_and_add_to_cache(
        VisitorManagerInterface $visitorManager,
        TokenPoolInterface $tokenPool,
        CollatorInterface $collator,
        DeviceCacheInterface $deviceCache,
        FingerprintGeneratorInterface $fingerprintGenerator
    ) {
        $this->beConstructedWith($visitorManager, $collator);

        $visitorManager
            ->visit(
                Argument::exact($tokenPool->getWrappedObject()),
                Argument::exact($collator->getWrappedObject())
            )
            ->shouldBeCalledTimes(1)
            ->willReturn(VisitorInterface::STATE_SEEKING);

        $fingerprint = sha1(time());

        $fingerprintGenerator
            ->generate(Argument::exact($tokenPool->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn($fingerprint);

        $this->setFingerprintGenerator($fingerprintGenerator);

        $deviceCache
            ->get(Argument::exact($fingerprint))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $deviceCache
            ->add(Argument::type('DeviceDetectorIO\DeviceDetector\Device\CacheDevice'))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $this->setDeviceCache($deviceCache);

        $collator->removeAll()->shouldBeCalledTimes(1);
        $collator->getAll()->shouldBeCalledTimes(1)->willReturn([]);

        $this->detect($tokenPool)->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    public function it_detect_device_from_cache(
        VisitorManagerInterface $visitorManager,
        TokenPoolInterface $tokenPool,
        FingerprintGeneratorInterface $fingerprintGenerator,
        CollatorInterface $collator,
        DeviceCacheInterface $deviceCache
    ) {
        $this->beConstructedWith($visitorManager, $collator);

        $visitorManager
            ->visit(
                Argument::exact($tokenPool->getWrappedObject()),
                Argument::exact($collator->getWrappedObject())
            )
            ->shouldNotBeCalled(1);

        $fingerprint = sha1(time());

        $fingerprintGenerator
            ->generate(Argument::exact($tokenPool->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn($fingerprint);

        $this->setFingerprintGenerator($fingerprintGenerator);

        $deviceCache
            ->get(Argument::exact($fingerprint))
            ->shouldBeCalledTimes(1)
            ->willReturn(new CacheDevice(new Device([]), $fingerprint));

        $deviceCache
            ->add(Argument::any())
            ->shouldNotBeCalled();

        $this->setDeviceCache($deviceCache);

        $collator->removeAll()->shouldNotBeCalled(0);
        $collator->getAll()->shouldNotBeCalled(0);

        $this->detect($tokenPool)->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }
}
