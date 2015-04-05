<?php

namespace spec\DeviceDetectorIO\DeviceDetector\DeviceCache;

use DeviceDetectorIO\DeviceDetector\Cache\DoctrineCacheBridge;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use Doctrine\Common\Cache\ArrayCache;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GenericDeviceCacheSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\DeviceCache
 */
class GenericDeviceCacheSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new DoctrineCacheBridge(new ArrayCache()));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\DeviceCache\GenericDeviceCache');
    }

    function it_implements_cache_device_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\DeviceCache\DeviceCacheInterface');
    }

    function it_add_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->has($fingerprint)->shouldReturn(false);
        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
    }

    function it_get_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->get($fingerprint)->shouldReturn(false);
        $this->add($device)->shouldReturn(true);
        $this->get($fingerprint)->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    function it_remove_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
        $this->remove($fingerprint)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(false);
    }

    function it_delete_all_devices()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
        $this->removeAll()->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(false);
    }

    function it_is_sensitive_for_change_prefix()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device(array()), $fingerprint);

        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
        $this->setPrefix('it_is_sensitive_for_change_prefix');
        $this->has($fingerprint)->shouldReturn(false);
    }
}
