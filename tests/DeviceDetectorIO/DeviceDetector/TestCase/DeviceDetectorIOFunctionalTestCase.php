<?php

namespace DeviceDetectorIO\DeviceDetector\Tests\TestCase;

use DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactory;

/**
 * Class DeviceDetectorIOFunctionalTestCase
 * @package DeviceDetectorIO\DeviceDetector\Tests\TestCase
 */
abstract class DeviceDetectorIOFunctionalTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $userAgent
     * @param array $capabilities
     */
    public function assertDeviceContainsCapabilities($userAgent, array $capabilities)
    {
        $factory = $this->createFactory();
        $device = $factory->getDevice($userAgent);

        foreach ($capabilities as $name => $value) {
            $this->assertSame(
                $value,
                $device->getCapability($name),
                sprintf('Device should contains capability %s:%s.', $name, $value)
            );
        }
    }

    /**
     * @return DeviceUserAgentFactory
     */
    protected function createFactory()
    {
        return new DeviceUserAgentFactory();
    }
}
