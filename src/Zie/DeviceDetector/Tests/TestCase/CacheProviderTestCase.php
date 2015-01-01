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
            Capabilities::IS_DESKTOP => true,
            Capabilities::BROWSER_VERSION => '23',
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8',
            Capabilities::OS_VENDOR => Capabilities::VENDOR_MICROSOFT
        );
    }

    abstract public function whetherProviderHasDeviceAfterAdding();
    abstract public function whetherProviderContainsExpectedDevicesAfterAdding();
    abstract public function whetherProviderRemoveDeviceAfterRemoving();
    abstract public function whetherProviderThrowExceptionIfNotContainDevice();
}
