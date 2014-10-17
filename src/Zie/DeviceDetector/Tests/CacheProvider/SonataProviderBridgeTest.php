<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\SonataProviderBridge;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class SonataProviderBridgeTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class SonataProviderBridgeTest extends CacheProviderTestCase
{
    public function setUp()
    {
        if (!class_exists('Sonata\Cache\Adapter\Cache\NoopCache', true)) {
            $this->markTestSkipped('Skipped due to Sonata Cache component is not installed.');
        }
    }

    public function testProvider()
    {
        $sha1 = sha1('1');
        $sha2 = sha1('2');

        $device1 = $this->createCacheDevice($sha1);
        $device2 = $this->createCacheDevice($sha2);

        $provider = new SonataProviderBridge(new \Sonata\Cache\Adapter\Cache\NoopCache());

        $this->assertFalse($provider->hasDevice($sha1));
        $this->assertFalse($provider->hasDevice($sha2));
    }
}
