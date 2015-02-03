<?php

namespace Zie\DeviceDetector\Tests\Factory;

use Zie\DeviceDetector\CacheProvider\InMemoryProvider;
use Zie\DeviceDetector\Factory\DeviceUserAgentFactory;

class DeviceUserAgentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function factoryShouldReturnDevice()
    {
        $factory = new DeviceUserAgentFactory();

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\DeviceInterface',
            $factory->getDevice('Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2')
        );
    }

    /**
     * @test
     */
    public function factoryShouldReturnCachedDevice()
    {
        $factory = new DeviceUserAgentFactory(new InMemoryProvider());

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\CacheDevice',
            $factory->getDevice('Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2')
        );
    }
}
