<?php

namespace Zie\DeviceDetector\Tests\Detector;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Device\Device;

/**
 * Class DeviceTest
 * @package Zie\DeviceDetector\Tests\Detector
 */
class DeviceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function whetherDeviceReturnExpectedValues()
    {
        $device = new Device($this->getCapabilities());

        $this->assertTrue(
            $device->isValid(),
            'isValid should return true.'
        );
        $this->assertFalse(
            $device->isMobile(),
            'isMobile should return false.'
        );
        $this->assertFalse(
            $device->isRobot(),
            'isRobot should return false.'
        );
        $this->assertFalse(
            $device->isOSX(),
            'isOSX should return false.'
        );
        $this->assertFalse(
            $device->isIOS(),
            'isIOS should return false.'
        );
        $this->assertFalse(
            $device->isAndroid(),
            'isAndroid should return false.'
        );
        $this->assertTrue(
            $device->isWindows(),
            'isWindows should return true.'
        );
        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $device->getOS(),
            'OS should be Windows.'
        );
        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $device->getCapability(Capabilities::OS),
            'OS should be Windows.'
        );
        $this->assertNull(
            $device->getCapability(Capabilities::BROWSER_ENGINE),
            'Browser engine should be null.'
        );
        $this->assertTrue(
            $device->hasCapability(Capabilities::OS),
            'Device should contain OS capability.'
        );
        $this->assertEquals(
            '8',
            $device->getOSVersion(),
            'OS version should be 8.'
        );
        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $device->getOSVendor(),
            'OS vendor should be Microsoft.'
        );
        $this->assertNull(
            $device->getOSVersionFull(),
            'OS full version should be null.'
        );
        $this->assertEquals(
            Capabilities::BROWSER_CHROME,
            $device->getBrowser(),
            'Browser should be Chrome.'
        );
        $this->assertEquals(
            '23',
            $device->getBrowserVersion(),
            'Browser version should be 23.'
        );
        $this->assertNull(
            $device->getBrowserVersionFull(),
            'Browser full version should be null.'
        );

        $device = new Device(array());
        $this->assertFalse(
            $device->isValid(),
            'Device should not be valid.'
        );
    }

    /**
     * @test
     */
    public function whetherCachedDeviceDetectorReturnExpectedValues()
    {
        $device = new Device($this->getCapabilities());
        $cachedDevice = new CacheDevice($device, sha1('fingerprint'));

        $this->assertTrue(
            $cachedDevice->isValid(),
            'isValid should return true.'
        );
        $this->assertFalse(
            $cachedDevice->isMobile(),
            'isMobile should return false.'
        );
        $this->assertFalse(
            $cachedDevice->isRobot(),
            'isRobot should return false.'
        );
        $this->assertFalse(
            $cachedDevice->isOSX(),
            'isOSX should return false.'
        );
        $this->assertFalse(
            $cachedDevice->isIOS(),
            'isIOS should return false.'
        );
        $this->assertFalse(
            $cachedDevice->isAndroid(),
            'isAndroid should return false.'
        );
        $this->assertTrue(
            $cachedDevice->isWindows(),
            'isWindows should return true.'
        );
        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $cachedDevice->getOS(),
            'OS should be Windows.'
        );
        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $device->getCapability(Capabilities::OS),
            'OS should be Windows.'
        );
        $this->assertNull(
            $cachedDevice->getCapability(Capabilities::BROWSER_ENGINE),
            'Browser engine should be null.'
        );
        $this->assertTrue(
            $cachedDevice->hasCapability(Capabilities::OS),
            'Device should contain OS capability.'
        );
        $this->assertEquals(
            '8',
            $cachedDevice->getOSVersion(),
            'OS version should be 8.'
        );
        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $cachedDevice->getOSVendor(),
            'OS vendor should be Microsoft.'
        );
        $this->assertNull(
            $cachedDevice->getOSVersionFull(),
            'OS full version should be null.'
        );
        $this->assertEquals(
            Capabilities::BROWSER_CHROME,
            $cachedDevice->getBrowser(),
            'Browser should be Chrome.'
        );
        $this->assertEquals(
            '23',
            $cachedDevice->getBrowserVersion(),
            'Browser version should be 23.'
        );
        $this->assertNull(
            $cachedDevice->getBrowserVersionFull(),
            'Browser full version should be null.'
        );

        $cachedDevice = new CacheDevice(
            new Device(array()),
            sha1('fingerprint')
        );

        $this->assertFalse(
            $cachedDevice->isValid(),
            'Device should not be valid.'
        );
    }

    /**
     * @test
     */
    public function deviceShouldBeSerializable()
    {
        $device = new Device($this->getCapabilities());

        $serializedDevice = serialize($device);
        /** @var Device $unserializedDevice */
        $unserializedDevice = unserialize($serializedDevice);

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\Device',
            $unserializedDevice,
            'Unserialize should return instance of Zie\DeviceDetector\Device\Device.'
        );
        $this->assertSame(
            $device->getCapabilities(),
            $unserializedDevice->getCapabilities(),
            'Object should be same before and after serialization.'
        );
    }

    /**
     * @test
     */
    public function cacheDeviceShouldBeSerializable()
    {
        $device = new Device($this->getCapabilities());
        $cachedDevice = new CacheDevice($device, sha1('fingerprint'));

        $serializedDevice = serialize($cachedDevice);
        /** @var CacheDevice $unserializedDevice */
        $unserializedDevice = unserialize($serializedDevice);

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\CacheDevice',
            $unserializedDevice,
            'Unserialize should return instance of Zie\DeviceDetector\Device\CacheDevice.'
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
            Capabilities::IS_ROBOT => false,
            Capabilities::IS_SMART_TV => false,
            Capabilities::BROWSER_VERSION => '23',
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8',
            Capabilities::OS_VENDOR => Capabilities::VENDOR_MICROSOFT
        );
    }
}
