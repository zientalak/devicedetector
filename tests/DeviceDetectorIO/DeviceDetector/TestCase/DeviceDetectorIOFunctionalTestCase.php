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
     * @var DeviceUserAgentFactory
     */
    protected $factory;

    /**
     * @param string $userAgent
     * @param array $capabilities
     */
    public function assertDeviceContainsCapabilities($userAgent, array $capabilities)
    {
        $device = $this
            ->createFactory()
            ->getDevice($userAgent);

        foreach ($capabilities as $name => $value) {
            $this->assertSame(
                $value,
                $device->getCapability($name),
                sprintf(
                    'Device should contains capability %s: %s for useragent: %s. Available capabilities: %s.',
                    $name,
                    $value,
                    $userAgent,
                    var_export($device->getCapabilities(), true)
                )
            );
        }

        $diff = array_diff_assoc($device->getCapabilities(), $capabilities);
        $this->assertEmpty(
            $diff,
            sprintf(
                'Should not be differences between expected results and device capabilities for useragent "%s". "%s" diff given.',
                $userAgent,
                var_export($diff, true)
            )
        );
    }

    /**
     * @return DeviceUserAgentFactory
     */
    protected function createFactory()
    {
        if(null === $this->factory) {
            $this->factory = new DeviceUserAgentFactory();;
        }

        return $this->factory;
    }
}
