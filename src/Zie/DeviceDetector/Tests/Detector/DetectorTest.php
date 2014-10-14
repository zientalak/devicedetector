<?php

namespace Zie\DeviceDetector\Tests\Detector;

use Zie\DeviceDetector\Detector\Factory;

class DetectorTest extends \PHPUnit_Framework_TestCase
{
    public function testDetect()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

        $detector = $this->createDeviceDetector($userAgent);
        $device = $detector->detect();

        $this->assertInstanceOf('Zie\DeviceDetector\Device\DeviceInterface', $device);
    }

    /**
     * @param string $userAgent
     * @return \Zie\DeviceDetector\Detector\DeviceDetector
     */
    private function createDeviceDetector($userAgent)
    {
        $factory = new Factory();

        return $factory->createDeviceDetectorFromUserAgent($userAgent);
    }
}
