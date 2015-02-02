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
    public function whetherProviderHasDevice()
    {
        $fingerprint = hash('sha1', '1');
        $device1 = $this->createCacheDevice($fingerprint);
        $provider = $this->createCacheProvider();

        $this->assertFalse(
            $provider->hasDevice($fingerprint),
            'Provider should not contain device before adding.'
        );

        $provider->addDevice($device1);

        $this->assertTrue(
            $provider->hasDevice($fingerprint),
            'Provider should contain device after adding.'
        );
    }

    /**
     * @test
     */
    public function whetherProviderContainsExpectedDevice()
    {
        $fingerprint = hash('sha1', '1');
        $device1 = $this->createCacheDevice($fingerprint);

        $provider = $this->createCacheProvider();
        $provider->addDevice($device1);

        $this->assertEquals(
            $device1,
            $provider->getDevice($fingerprint),
            'Provider should contain device 1 after adding.'
        );
    }

    /**
     * @test
     */
    public function whetherProviderRemoveDevice()
    {
        $fingerprint = hash('sha1', '1');
        $device1 = $this->createCacheDevice($fingerprint);

        $provider = $this->createCacheProvider();
        $provider->addDevice($device1);

        $this->assertTrue(
            $provider->hasDevice($fingerprint),
            'Provider should contain device 1 after adding.'
        );

        $provider->removeDevice($device1);

        $this->assertFalse(
            $provider->hasDevice($fingerprint),
            'Provider should not contain device 1 after removing.'
        );
    }

    /**
     * @test
     * @expectedException \Zie\DeviceDetector\Exception\CachedDeviceNotFoundException
     */
    public function whetherProviderThrowExceptionIfNotContainDevice()
    {
        $provider = $this->createCacheProvider();
        $provider->getDevice(hash('sha1', '1'));
    }

    /**
     * @return InMemoryProvider
     */
    public function createCacheProvider()
    {
        return new InMemoryProvider();
    }
}
