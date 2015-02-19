<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\LinuxDistributionsVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

class LinuxDistributionVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeArchLinux()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 Arch Linux (X11; U; Linux x86_64; en-US) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.100'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'LinuxDistributionVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            'Arch Linux',
            $collector->getCapability(Capabilities::OS),
            'LinuxDistributionVisitorTest should set recognize Arch Linux.'
        );
    }

    /**
     * @test
     */
    public function recognizeVectorLinux()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; U; Linux i686; en-GB; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3 (VectorLinux package 3.5.3-1vl60)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'LinuxDistributionVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            'VectorLinux',
            $collector->getCapability(Capabilities::OS),
            'LinuxDistributionVisitorTest should set recognize VectorLinux.'
        );

        $this->assertEquals(
            '3.5.3-1vl60',
            $collector->getCapability(Capabilities::OS_VERSION),
            'LinuxDistributionVisitorTest should set recognize VectorLinux version.'
        );

        $this->assertEquals(
            '3.5.3-1vl60',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'LinuxDistributionVisitorTest should set recognize VectorLinux full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeFedora()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.0.6) Gecko/20060905 Fedora/1.5.0.6-10 Firefox/1.5.0.6 pango-text'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'LinuxDistributionVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            'Fedora',
            $collector->getCapability(Capabilities::OS),
            'LinuxDistributionVisitorTest should set recognize Fedora.'
        );

        $this->assertEquals(
            '1.5.0.6',
            $collector->getCapability(Capabilities::OS_VERSION),
            'LinuxDistributionVisitorTest should set recognize Fedora version.'
        );

        $this->assertEquals(
            '1.5.0.6',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'LinuxDistributionVisitorTest should set recognize Fedora full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeUbuntu()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; U; Linux x86_64; en; rv:1.9.0.14) Gecko/20080528 Ubuntu/9.10 (karmic) Epiphany/2.22 Firefox/3.0'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'LinuxDistributionVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            'Ubuntu',
            $collector->getCapability(Capabilities::OS),
            'LinuxDistributionVisitorTest should set recognize Ubuntu.'
        );

        $this->assertEquals(
            '9.10',
            $collector->getCapability(Capabilities::OS_VERSION),
            'LinuxDistributionVisitorTest should set recognize Ubuntu version.'
        );

        $this->assertEquals(
            '9.10',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'LinuxDistributionVisitorTest should set recognize Ubuntu full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new LinuxDistributionsVisitor();
    }
}