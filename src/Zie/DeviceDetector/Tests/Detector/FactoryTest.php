<?php

namespace Zie\DeviceDetector\Tests\Detector;

use Zie\DeviceDetector\CacheProvider\InMemoryProvider;
use Zie\DeviceDetector\Detector\Factory;

/**
 * Class FactoryTest
 * @package Zie\DeviceDetector\Tests\Detector
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateDeviceDetectorFromUserAgent()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

        $factory = new Factory();
        $detector = $factory->createDeviceDetectorFromUserAgent($userAgent);

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Detector\DeviceDetector',
            $detector,
            'Factory should return instance DeviceDetector.'
        );
    }

    public function testCreateCacheDeviceDetectorFromUserAgent()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

        $factory = new Factory();
        $detector = $factory->createCacheDeviceDetectorFromUserAgent(
            $userAgent,
            new InMemoryProvider()
        );

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Detector\CacheDetector',
            $detector,
            'Factory should return instance CacheDetector.'
        );
    }
}
