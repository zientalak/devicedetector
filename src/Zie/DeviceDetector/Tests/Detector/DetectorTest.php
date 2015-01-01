<?php

namespace Zie\DeviceDetector\Tests\Detector;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Detector\DeviceDetector;
use Zie\DeviceDetector\Token\TokenPool;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\VisitorManager\VisitorManagerInterface;

class DetectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function whetherDeviceDetectorReturnDeviceObject()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

        $detector = $this->createDeviceDetector($userAgent);

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\DeviceInterface',
            $detector->detect(),
            'Detector should return Zie\DeviceDetector\Device\DeviceInterface object.'
        );
    }

    /**
     * @param string $userAgent
     * @return DeviceDetector
     */
    private function createDeviceDetector($userAgent)
    {
        $tokenPool = new TokenPool();
        $tokenPool->addToken(new UserAgentToken($userAgent));

        return new DeviceDetector(
            $this->createVisitorManager(),
            $tokenPool,
            $this->createContext()
        );
    }

    /**
     * @return VisitorManagerInterface
     */
    private function createVisitorManager()
    {
        $mock = $this->getMock('Zie\DeviceDetector\VisitorManager\VisitorManagerInterface');

        $mock->expects($this->once())
            ->method('visit')
            ->willReturn($this->returnSelf());

        return $mock;
    }

    /**
     * @return ContextInterface
     */
    private function createContext()
    {
        $mock = $this->getMock('Zie\DeviceDetector\Context\ContextInterface');

        $mock->expects($this->once())
            ->method('clear')
            ->will($this->returnValue($this->returnSelf()));

        $mock->expects($this->once())
            ->method('getCapabilities')
            ->will($this->returnValue(array()));

        return $mock;
    }
}
