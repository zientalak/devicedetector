<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\FirefoxVisitor;
use Zie\DeviceDetector\Visitor\Browser\IEVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IEVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class IEVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeIE5()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 5.0; Windows NT;)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'IEVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_IE,
            $collector->getCapability(Capabilities::BROWSER),
            'IEVisitorTest should recognize IE browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'IEVisitorTest should recognize Microsoft vendor browser.'
        );

        $this->assertEquals(
            '5',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'IEVisitorTest should recognize Microsoft version.'
        );

        $this->assertEquals(
            '5.0',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'IEVisitorTest should recognize Microsoft full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeIE6()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'IEVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_IE,
            $collector->getCapability(Capabilities::BROWSER),
            'IEVisitorTest should recognize IE browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'IEVisitorTest should recognize Microsoft vendor browser.'
        );

        $this->assertEquals(
            '10',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'IEVisitorTest should recognize Microsoft version.'
        );

        $this->assertEquals(
            '10.0',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'IEVisitorTest should recognize Microsoft full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeIE10()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (IE 11.0; Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'IEVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_IE,
            $collector->getCapability(Capabilities::BROWSER),
            'IEVisitorTest should recognize IE browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'IEVisitorTest should recognize Microsoft vendor browser.'
        );

        $this->assertEquals(
            '11',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'IEVisitorTest should recognize Microsoft version.'
        );

        $this->assertEquals(
            '11.0',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'IEVisitorTest should recognize Microsoft full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new IEVisitor();
    }
}
