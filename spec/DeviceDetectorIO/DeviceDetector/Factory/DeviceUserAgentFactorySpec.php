<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Cache\DoctrineCacheBridge;
use Doctrine\Common\Cache\ArrayCache;
use PhpSpec\ObjectBehavior;

/**
 * Class DeviceUserAgentFactorySpec.
 */
class DeviceUserAgentFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactory');
    }

    public function it_implements_device_useragent_factory()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactoryInterface');
    }

    public function it_return_device_without_cache()
    {
        $this
            ->getDevice('Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2')
            ->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\Device');
    }

    public function it_return_device_with_cache()
    {
        $this->beConstructedWith(new DoctrineCacheBridge(new ArrayCache()));
        $this
            ->getDevice('Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2')
            ->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }
}
