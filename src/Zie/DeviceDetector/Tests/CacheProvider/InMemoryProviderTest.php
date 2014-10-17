<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\InMemoryProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class InMemoryProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class InMemoryProviderTest extends CacheProviderTestCase
{
    public function testProvider()
    {
        $sha1 = sha1('1');
        $sha2 = sha1('2');

        $device1 = $this->createCacheDevice($sha1);
        $device2 = $this->createCacheDevice($sha2);

        $provider = new InMemoryProvider();

        $this->assertFalse($provider->hasDevice($sha1));

        $provider->addDevice($device1);
        $provider->addDevice($device2);

        $this->assertTrue($provider->hasDevice($sha1));
        $this->assertTrue($provider->hasDevice($sha2));
        $this->assertEquals($device1, $provider->getDevice($sha1));
        $this->assertEquals($device2, $provider->getDevice($sha2));

        $provider->removeDevice($device2);

        $this->assertTrue($provider->hasDevice($sha1));
        $this->assertFalse($provider->hasDevice($sha2));
        $this->assertEquals($device1, $provider->getDevice($sha1));
    }
}
