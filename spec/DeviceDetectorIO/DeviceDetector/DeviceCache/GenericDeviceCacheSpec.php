<?php

namespace spec\DeviceDetectorIO\DeviceDetector\DeviceCache;

use DeviceDetectorIO\DeviceDetector\Cache\DoctrineCacheBridge;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use Doctrine\Common\Cache\ArrayCache;
use PhpSpec\ObjectBehavior;

/**
 * Class GenericDeviceCacheSpec.
 */
class GenericDeviceCacheSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(new DoctrineCacheBridge(new ArrayCache()));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\DeviceCache\GenericDeviceCache');
    }

    public function it_implements_cache_device_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\DeviceCache\DeviceCacheInterface');
    }

    public function it_add_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device([]), $fingerprint);

        $this->has($fingerprint)->shouldReturn(false);
        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
    }

    public function it_get_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device([]), $fingerprint);

        $this->get($fingerprint)->shouldReturn(false);
        $this->add($device)->shouldReturn(true);
        $this->get($fingerprint)->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    public function it_remove_device()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device([]), $fingerprint);

        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
        $this->remove($fingerprint)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(false);
    }

    public function it_delete_all_devices()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device([]), $fingerprint);

        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
        $this->removeAll()->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(false);
    }

    public function it_is_sensitive_for_change_prefix()
    {
        $fingerprint = sha1(time());
        $device = new CacheDevice(new Device([]), $fingerprint);

        $this->add($device)->shouldReturn(true);
        $this->has($fingerprint)->shouldReturn(true);
        $this->setPrefix('it_is_sensitive_for_change_prefix');
        $this->has($fingerprint)->shouldReturn(false);
    }
}
