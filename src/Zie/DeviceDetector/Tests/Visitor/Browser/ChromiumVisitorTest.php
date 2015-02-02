<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\ChromiumVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class ChromiumVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class ChromiumVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeGoogleChrome()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Ubuntu/10.10 Chromium/8.0.552.237 Chrome/8.0.552.237 Safari/534.10'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'ChromiumVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_CHROMIUM,
            $collector->getCapability(Capabilities::BROWSER),
            'ChromiumVisitorTest should recognize Google Chromium browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_GOOGLE,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'ChromiumVisitorTest should recognize Google Chromium vendor browser.'
        );

        $this->assertEquals(
            '8',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'ChromiumVisitorTest should recognize Google Chromium version.'
        );

        $this->assertEquals(
            '8.0.552.237',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'ChromiumVisitorTest should recognize Google Chromium full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new ChromiumVisitor();
    }
}
