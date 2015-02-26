<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Factory;

use DeviceDetectorIO\DeviceDetector\Cache\ArrayCache;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeviceUserAgentFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactory');
    }

    function it_implements_device_useragent_factory()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactoryInterface');
    }

    function it_return_device_without_cache()
    {
        $this
            ->getDevice('Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2')
            ->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\Device');
    }

    function it_return_device_with_cache()
    {
        $this->beConstructedWith(new ArrayCache());

        $this
            ->getDevice('Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2')
            ->shouldReturnAnInstanceOf('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }
}
