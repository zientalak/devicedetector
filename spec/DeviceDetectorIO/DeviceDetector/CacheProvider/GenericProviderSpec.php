<?php

namespace spec\DeviceDetectorIO\DeviceDetector\CacheProvider;

use DeviceDetectorIO\DeviceDetector\Cache\ArrayCache;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenericProviderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new ArrayCache());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\CacheProvider\GenericProvider');
    }

    function it_implements_cache_provider_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\CacheProvider\CacheProviderInterface');
    }

    function it_add_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->hasDevice($fingerprint)->shouldReturn(false);
        $this->addDevice($device)->shouldReturn(true);
        $this->hasDevice($fingerprint)->shouldReturn(true);
    }

    function it_get_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->getDevice($fingerprint)->shouldReturn(false);
        $this->addDevice($device)->shouldReturn(true);
        $this->getDevice($fingerprint)->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    function it_remove_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->addDevice($device)->shouldReturn(true);
        $this->hasDevice($fingerprint)->shouldReturn(true);
        $this->removeDevice($fingerprint)->shouldReturn(true);
        $this->hasDevice($fingerprint)->shouldReturn(false);
    }

    function it_clear_devices()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->addDevice($device)->shouldReturn(true);
        $this->hasDevice($fingerprint)->shouldReturn(true);
        $this->clear()->shouldReturn(true);
        $this->hasDevice($fingerprint)->shouldReturn(false);
    }

    function it_is_sensitive_for_change_prefix()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->addDevice($device)->shouldReturn(true);
        $this->hasDevice($fingerprint)->shouldReturn(true);
        $this->setPrefix('it_is_sensitive_for_change_prefix');

        $this->hasDevice($fingerprint)->shouldReturn(false);
    }
}
