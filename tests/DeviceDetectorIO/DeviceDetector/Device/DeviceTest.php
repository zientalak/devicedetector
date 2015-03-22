<?php

namespace DeviceDetectorIO\DeviceDetector\Tests\Device;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Device\CacheDevice;
use DeviceDetectorIO\DeviceDetector\Device\Device;

class DeviceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers Device::serialize
     * @covers Device::unserializable
     */
    public function deviceShouldBeSerializable()
    {
        $device = new Device($this->getCapabilities());
        $serializedDevice = serialize($device);
        /** @var Device $unserializedDevice */
        $unserializedDevice = unserialize($serializedDevice);
        $this->assertInstanceOf(
            'DeviceDetectorIO\DeviceDetector\Device\Device',
            $unserializedDevice,
            'Unserialize should return instance of DeviceDetectorIO\DeviceDetector\Device\Device.'
        );
        $this->assertSame(
            $device->getCapabilities(),
            $unserializedDevice->getCapabilities(),
            'Object should be same before and after serialization.'
        );
    }

    /**
     * @test
     * @covers CacheDevice::serialize
     * @covers CacheDevice::unserializable
     */
    public function cacheDeviceShouldBeSerializable()
    {
        $device = new Device($this->getCapabilities());
        $cachedDevice = new CacheDevice($device, sha1('fingerprint'));
        $serializedDevice = serialize($cachedDevice);
        /** @var CacheDevice $unserializedDevice */
        $unserializedDevice = unserialize($serializedDevice);
        $this->assertInstanceOf(
            'DeviceDetectorIO\DeviceDetector\Device\CacheDevice',
            $unserializedDevice,
            'Unserialize should return instance of DeviceDetectorIO\DeviceDetector\Device\CacheDevice.'
        );
        $this->assertSame(
            $cachedDevice->getCapabilities(),
            $unserializedDevice->getCapabilities(),
            'Object should be same before and after serialization.'
        );
        $this->assertSame(
            $cachedDevice->getFingerprint(),
            $unserializedDevice->getFingerprint(),
            'Fingerprints should be identical.'
        );
    }

    /**
     * @return array
     */
    protected function getCapabilities()
    {
        return array(
            Capabilities::BROWSER => Capabilities::BROWSER_CHROME,
            Capabilities::IS_MOBILE => false,
            Capabilities::IS_BOT => false,
            Capabilities::IS_SMART_TV => false,
            Capabilities::BROWSER_VERSION => '23',
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8',
            Capabilities::OS_VENDOR => Capabilities::VENDOR_MICROSOFT
        );
    }
}
