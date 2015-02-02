<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\SafariVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class SafariVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class SafariVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeSafari()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'SafariVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_SAFARI,
            $collector->getCapability(Capabilities::BROWSER),
            'SafariVisitorTest should recognize Safari browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_APPLE,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'SafariVisitorTest should recognize Safari vendor browser.'
        );

        $this->assertEquals(
            '6',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'SafariVisitorTest should recognize Safari version.'
        );

        $this->assertEquals(
            '6.0.2',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'SafariVisitorTest should recognize Safari full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new SafariVisitor();
    }
}
