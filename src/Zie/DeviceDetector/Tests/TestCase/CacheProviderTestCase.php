<?php

namespace Zie\DeviceDetector\Tests\TestCase;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Device\Device;

/**
 * Class CacheProviderTestCase
 * @package Zie\DeviceDetector\Tests\TestCase
 */
abstract class CacheProviderTestCase extends \PHPUnit_Framework_TestCase
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

        $this->assertFalse(
            $provider->getDevice($fingerprint),
            'Provider should return false if device does not exists.'
        );

        $this->assertTrue(
            $provider->addDevice($device1),
            'Provider should return true on successfully add.'
        );

        $this->assertTrue(
            $provider->hasDevice($fingerprint),
            'Provider should contain device after adding.'
        );
    }

    /**
     * @test
     */
    public function whetherProviderAddDevice()
    {
        $fingerprint = hash('sha1', '1');
        $device1 = $this->createCacheDevice($fingerprint);

        $provider = $this->createCacheProvider();

        $this->assertTrue(
            $provider->addDevice($device1),
            'Provider should return true on successfully add.'
        );

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

        $this->assertTrue(
            $provider->addDevice($device1),
            'Provider should return true on successfully add.'
        );

        $this->assertTrue(
            $provider->hasDevice($fingerprint),
            'Provider should return true if contain device.'
        );

        $this->assertTrue(
            $provider->removeDevice($device1),
            'Provider should return true on successfully remove.'
        );

        $this->assertFalse(
            $provider->hasDevice($fingerprint),
            'Provider should not contain device 1 after removing.'
        );
    }

    /**
     * @test
     */
    public function whetherProviderClearAllData()
    {
        $fingerprint = hash('sha1', '1');
        $device1 = $this->createCacheDevice($fingerprint);

        $provider = $this->createCacheProvider();

        $this->assertTrue(
            $provider->addDevice($device1),
            'Provider should return true on successfully add.'
        );

        $provider->clear();

        $this->assertFalse($provider->hasDevice($device1->getFingerprint()));
    }

    /**
     * @param string $fingerprint
     * @return CacheDevice
     */
    protected function createCacheDevice($fingerprint)
    {
        $device = new Device($this->getCapabilities());

        return new CacheDevice($device, $fingerprint);
    }

    /**
     * @return array
     */
    protected function getCapabilities()
    {
        return array(
            Capabilities::BROWSER => Capabilities::BROWSER_CHROME,
            Capabilities::IS_MOBILE => false,
            Capabilities::IS_ROBOT => false,
            Capabilities::IS_SMART_TV => false,
            Capabilities::BROWSER_VERSION => '23',
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8',
            Capabilities::OS_VENDOR => Capabilities::VENDOR_MICROSOFT
        );
    }
}
