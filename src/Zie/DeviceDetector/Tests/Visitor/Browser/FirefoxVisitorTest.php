<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\FirefoxVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class FirefoxVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class FirefoxVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeFirefox()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; Linux i686 on x86_64; rv:12.0) Gecko/20100101 Firefox/12.0'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'FirefoxVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_FIREFOX,
            $collector->getCapability(Capabilities::BROWSER),
            'FirefoxVisitorTest should recognize Firefox browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_MOZILLA,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'FirefoxVisitorTest should recognize Mozilla vendor browser.'
        );

        $this->assertEquals(
            '12',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'FirefoxVisitorTest should recognize Mozilla version.'
        );

        $this->assertEquals(
            '12.0',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'FirefoxVisitorTest should recognize Mozilla full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new FirefoxVisitor();
    }
}
