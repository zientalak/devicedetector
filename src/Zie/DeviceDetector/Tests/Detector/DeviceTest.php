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
    public function testDevice()
    {
        $device = new Device($this->getCapabilities());

        $this->assertFalse($device->isMobile());
        $this->assertFalse($device->isRobot());
        $this->assertFalse($device->isOSX());
        $this->assertFalse($device->isIOS());
        $this->assertFalse($device->isAndroid());
        $this->assertTrue($device->isWindows());
        $this->assertTrue($device->isValid());
        $this->assertEquals(Capabilities::OS_WINDOWS, $device->getOS());
        $this->assertEquals('8', $device->getOSVersion());
        $this->assertEquals(Capabilities::VENDOR_MICROSOFT, $device->getOSVendor());
        $this->assertFalse($device->getOSVersionFull());
        $this->assertEquals(Capabilities::BROWSER_CHROME, $device->getBrowser());
        $this->assertEquals('23', $device->getBrowserVersion());
        $this->assertFalse($device->getBrowserVersionFull());

        $device = new Device(array());
        $this->assertFalse($device->isValid());
    }

    public function testCachedDevice()
    {
        $device = new Device($this->getCapabilities());
        $cachedDevice = new CacheDevice($device, sha1('fingerprint'));

        $this->assertFalse($cachedDevice->isMobile());
        $this->assertFalse($cachedDevice->isRobot());
        $this->assertFalse($cachedDevice->isOSX());
        $this->assertFalse($cachedDevice->isIOS());
        $this->assertFalse($cachedDevice->isAndroid());
        $this->assertTrue($cachedDevice->isWindows());
        $this->assertTrue($cachedDevice->isValid());
        $this->assertEquals(Capabilities::OS_WINDOWS, $cachedDevice->getOS());
        $this->assertEquals('8', $cachedDevice->getOSVersion());
        $this->assertEquals(Capabilities::VENDOR_MICROSOFT, $cachedDevice->getOSVendor());
        $this->assertFalse($cachedDevice->getOSVersionFull());
        $this->assertEquals(Capabilities::BROWSER_CHROME, $cachedDevice->getBrowser());
        $this->assertEquals('23', $cachedDevice->getBrowserVersion());
        $this->assertFalse($cachedDevice->getBrowserVersionFull());
        $this->assertEquals(sha1('fingerprint'), $cachedDevice->getFingerprint());

        $cachedDevice = new CacheDevice(new Device(array()), sha1('fingerprint'));
        $this->assertFalse($cachedDevice->isValid());
    }

    public function testSerializationDevice()
    {
        $device = new Device($this->getCapabilities());

        $serializedDevice = serialize($device);
        /** @var Device $unserializedDevice */
        $unserializedDevice = unserialize($serializedDevice);

        $this->assertInstanceOf('Zie\DeviceDetector\Device\Device', $unserializedDevice);
        $this->assertEquals($device->getCapabilities(), $unserializedDevice->getCapabilities());
    }

    public function testSerializationCacheDevice()
    {
        $device = new Device($this->getCapabilities());
        $cachedDevice = new CacheDevice($device, sha1('fingerprint'));

        $serializedDevice = serialize($cachedDevice);
        /** @var CacheDevice $unserializedDevice */
        $unserializedDevice = unserialize($serializedDevice);

        $this->assertInstanceOf('Zie\DeviceDetector\Device\CacheDevice', $unserializedDevice);
        $this->assertEquals($cachedDevice->getCapabilities(), $unserializedDevice->getCapabilities());
        $this->assertEquals($cachedDevice->getFingerprint(), $unserializedDevice->getFingerprint());
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
            Capabilities::IS_DESKTOP => true,
            Capabilities::BROWSER_VERSION => '23',
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8',
            Capabilities::OS_VENDOR => Capabilities::VENDOR_MICROSOFT
        );
    }
}
