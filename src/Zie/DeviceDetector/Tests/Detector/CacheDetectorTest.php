<?php

namespace Zie\DeviceDetector\Tests\Detector;

use Zie\DeviceDetector\CacheProvider\CacheProviderInterface;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Detector\CacheDetector;
use Zie\DeviceDetector\Device\CacheDevice;
use Zie\DeviceDetector\Fingerprint\FingerprintGeneratorInterface;
use Zie\DeviceDetector\Token\TokenPool;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\VisitorManager\VisitorManagerInterface;

class CacheDetectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function whetherDeviceDetectorReturnDeviceObjectFromCache()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

        $detector = $this->createDeviceDetector($userAgent);
        $detector->setFingerprintGenerator(
            $this->createFingerprintGenerator(hash('sha1', '1'))
        );
        $detector->setCacheProvider(
            $this->createCacheProvider(false)
        );

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\CacheDevice',
            $detector->detect(),
            'Detector should return Zie\DeviceDetector\Device\CacheDevice object from cache.'
        );
    }

    /**
     * @test
     */
    public function whetherDeviceDetectorReturnDeviceObjectAndSetToCache()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';

        $detector = $this->createDeviceDetector($userAgent);
        $detector->setFingerprintGenerator(
            $this->createFingerprintGenerator(hash('sha1', '1'))
        );
        $detector->setCacheProvider(
            $this->createCacheProvider(true)
        );

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Device\CacheDevice',
            $detector->detect(),
            'Detector should return Zie\DeviceDetector\Device\CacheDevice object and set to cache.'
        );
    }

    /**
     * @param boolean $device
     * @return CacheProviderInterface
     */
    private function createCacheProvider($device)
    {
        $mock = $this->getMock('Zie\DeviceDetector\CacheProvider\CacheProviderInterface');

        $mock->expects($this->once())
            ->method('hasDevice')
            ->willReturn($device);

        $mock->expects($device ? $this->once() : $this->never())
            ->method('getDevice')
            ->willReturn($this->createDevice());

        $mock->expects($device ? $this->never() : $this->once())
            ->method('addDevice')
            ->will($this->returnSelf());

        return $mock;
    }

    /**
     * @return CacheDevice
     */
    private function createDevice()
    {
        $mock = $this->getMockBuilder('Zie\DeviceDetector\Device\Device')
            ->disableOriginalConstructor()
            ->getMock();

        return new CacheDevice(
            $mock,
            hash('sha1', '1')
        );
    }

    /**
     * @param $fingerprint
     * @return FingerprintGeneratorInterface
     */
    private function createFingerprintGenerator($fingerprint)
    {
        $mock = $this->getMock('Zie\DeviceDetector\Fingerprint\FingerprintGeneratorInterface');

        $mock->expects($this->once())
            ->method('getFingerprint')
            ->willReturn($this->returnValue($fingerprint));

        return $mock;
    }

    /**
     * @param string $userAgent
     * @return CacheDetector
     */
    private function createDeviceDetector($userAgent)
    {
        $tokenPool = new TokenPool();
        $tokenPool->addToken(new UserAgentToken($userAgent));

        return new CacheDetector(
            $this->createVisitorManager(),
            $tokenPool,
            $this->createCollector()
        );
    }

    /**
     * @return VisitorManagerInterface
     */
    private function createVisitorManager()
    {
        return $this->getMock('Zie\DeviceDetector\VisitorManager\VisitorManagerInterface');

        $mock->expects($this->any())
            ->method('visit')
            ->willReturn($this->returnSelf());

        return $mock;
    }

    /**
     * @return CollectorInterface
     */
    private function createCollector()
    {
        $mock = $this->getMock('Zie\DeviceDetector\Collector\CollectorInterface');

        $mock->expects($this->any())
            ->method('clear')
            ->will($this->returnValue($this->returnSelf()));

        $mock->expects($this->any())
            ->method('getCapabilities')
            ->will($this->returnValue(array()));

        return $mock;
    }
}
