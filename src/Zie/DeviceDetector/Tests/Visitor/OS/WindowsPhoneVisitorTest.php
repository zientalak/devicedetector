<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\LinuxVisitor;
use Zie\DeviceDetector\Visitor\OS\WindowsPhoneVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsPhoneVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class WindowsPhoneVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeWindowsPhone()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident/3.1; IEMobile/7.0; LG; GW910)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsPhoneVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS_PHONE,
            $collector->getCapability(Capabilities::OS),
            'WindowsPhoneVisitor should set recognize Windows Phone.'
        );

        $this->assertEquals(
            '7',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsPhoneVisitor should set recognize Windows Phone version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsPhoneVisitor should set recognize Windows Phone family.'
        );

        $this->assertEquals(
            '7',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsPhoneVisitor should set recognize Windows Phone full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsPhoneSpecific()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; XBLWP7; ZuneWP7)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsPhoneVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS_PHONE,
            $collector->getCapability(Capabilities::OS),
            'WindowsPhoneVisitor should set recognize Windows Phone.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsPhoneVisitor should set recognize Windows family OS.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new WindowsPhoneVisitor();
    }
}
