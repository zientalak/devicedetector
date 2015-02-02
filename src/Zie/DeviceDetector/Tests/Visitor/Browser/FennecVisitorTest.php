<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\FennecVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class FennecVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class FennecVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeFennec()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; Linux i686; rv:2.1.1) Gecko/20110415 Firefox/4.0.2pre Fennec/4.0.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'FennecVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_FENNEC,
            $collector->getCapability(Capabilities::BROWSER),
            'FennecVisitorTest should recognize Fennec browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_MOZILLA,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'FennecVisitorTest should recognize Mozilla vendor browser.'
        );

        $this->assertEquals(
            '4',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'FennecVisitorTest should recognize Fennec version.'
        );

        $this->assertEquals(
            '4.0.1',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'FennecVisitorTest should recognize Fennec full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new FennecVisitor();
    }
}
