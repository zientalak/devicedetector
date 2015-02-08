<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\WindowsRTVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsRTVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class WindowsRTVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeWindowsRT8()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS_RT,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitor should set recognize Windows RT.'
        );

        $this->assertSame(
            '8',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitor should set recognize Windows version.'
        );

        $this->assertSame(
            '8',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitor should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitor should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsRT81()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows NT 6.3; ARM; WOW64; Trident/7.0; rv:11.0) like Gecko'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS_RT,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitor should set recognize Windows RT.'
        );

        $this->assertSame(
            '8.1',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitor should set recognize Windows version.'
        );

        $this->assertSame(
            '8.1',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitor should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitor should set recognize Windows family.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new WindowsRTVisitor();
    }
}
