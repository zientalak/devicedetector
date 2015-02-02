<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\LinuxVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class LinuxVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class LinuxVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeX11()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'LinuxVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_LINUX,
            $collector->getCapability(Capabilities::OS),
            'LinuxVisitorTest should set recognize Linux.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_LINUX,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'LinuxVisitorTest should set recognize Linux family OS.'
        );
    }

    /**
     * @test
     */
    public function recognizeLinux()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'LinuxVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_LINUX,
            $collector->getCapability(Capabilities::OS),
            'LinuxVisitorTest should set recognize Linux.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_LINUX,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'LinuxVisitorTest should set recognize Linux family OS.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new LinuxVisitor();
    }
}
