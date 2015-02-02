<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\OperaVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class OperaVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class OperaVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeOpera()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Opera/9.02 (Windows XP; U; ru)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'OperaVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_OPERA,
            $collector->getCapability(Capabilities::BROWSER),
            'OperaVisitorTest should recognize Opera browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_OPERA,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'OperaVisitorTest should recognize Opera vendor browser.'
        );

        $this->assertEquals(
            '9',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'OperaVisitorTest should recognize Opera version.'
        );

        $this->assertEquals(
            '9.02',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'OperaVisitorTest should recognize Opera full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeOpera15()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.29 Safari/537.36 OPR/15.0.1147.24 (Edition Next)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'OperaVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_OPERA,
            $collector->getCapability(Capabilities::BROWSER),
            'OperaVisitorTest should recognize Opera browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_OPERA,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'OperaVisitorTest should recognize Opera vendor browser.'
        );

        $this->assertEquals(
            '15',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'OperaVisitorTest should recognize Opera version.'
        );

        $this->assertEquals(
            '15.0',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'OperaVisitorTest should recognize Opera full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new OperaVisitor();
    }
}
