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
    /**
     * @test
     */
    public function whetherProviderHasDeviceAfterAdding()
    {
        $sha1 = sha1('1');
        $sha2 = sha1('2');

        $device1 = $this->createCacheDevice($sha1);
        $device2 = $this->createCacheDevice($sha2);

        $provider = $this->createCacheProvider();

        $this->assertFalse(
            $provider->hasDevice($sha1),
            'Provider should not contain device before adding.'
        );

        $provider->addDevice($device1);
        $provider->addDevice($device2);

        $this->assertTrue(
            $provider->hasDevice($sha1),
            'Provider should contain device 1 after adding.'
        );

        $this->assertTrue(
            $provider->hasDevice($sha2),
            'Provider should contain device 2 after adding.'
        );
    }

    /**
     * @test
     */
    public function whetherProviderContainsExpectedDevicesAfterAdding()
    {
        $sha1 = sha1('1');

        $device1 = $this->createCacheDevice($sha1);

        $provider = $this->createCacheProvider();

        $provider->addDevice($device1);

        $this->assertEquals(
            $device1,
            $provider->getDevice($sha1),
            'Provider should contain device 1 after adding.'
        );
    }

    /**
     * @test
     */
    public function whetherProviderRemoveDeviceAfterRemoving()
    {
        $sha1 = sha1('1');
        $sha2 = sha1('2');

        $device1 = $this->createCacheDevice($sha1);
        $device2 = $this->createCacheDevice($sha2);

        $provider = $this->createCacheProvider();

        $provider->addDevice($device1);
        $provider->addDevice($device2);

        $this->assertTrue(
            $provider->hasDevice($sha1),
            'Provider should contain device 1.'
        );
        $this->assertTrue(
            $provider->hasDevice($sha2),
            'Provider should contain device 2.'
        );

        $provider->removeDevice($device1);
        $provider->removeDevice($device2);

        $this->assertFalse(
            $provider->hasDevice($sha1),
            'Provider should not contain device 1 after removing.'
        );
        $this->assertFalse(
            $provider->hasDevice($sha2),
            'Provider should not contain device 2 after removing.'
        );
    }

    /**
     * @test
     * @expectedException \Zie\DeviceDetector\Exception\CachedDeviceNotFoundException
     */
    public function whetherProviderThrowExceptionIfNotContainDevice()
    {
        $provider = $this->createCacheProvider();
        $provider->getDevice(sha1('1'));
    }

    /**
     * @return InMemoryProvider
     */
    public function createCacheProvider()
    {
        return new InMemoryProvider();
    }
}
