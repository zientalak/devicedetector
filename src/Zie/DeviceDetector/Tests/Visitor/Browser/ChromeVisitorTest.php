<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\ChromeVisitor;
use Zie\DeviceDetector\Visitor\Browser\ChromiumVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class ChromeVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class ChromeVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeGoogleChrome()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.38 Safari/537.36'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'ChromeVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_CHROME,
            $collector->getCapability(Capabilities::BROWSER),
            'ChromeVisitorTest should recognize Google Chrome browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_GOOGLE,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'ChromeVisitorTest should recognize Google vendor browser.'
        );

        $this->assertEquals(
            '40',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'ChromeVisitorTest should recognize Google Chrome version.'
        );

        $this->assertEquals(
            '40.0.2214.38',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'ChromeVisitorTest should recognize Google Chrome full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new ChromeVisitor();
    }
}
