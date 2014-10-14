<?php

namespace Zie\DeviceDetector\Tests\Detector;

use Zie\DeviceDetector\Capabilities;
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

    /**
     * @return array
     */
    public function getCapabilities()
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
