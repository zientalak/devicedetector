<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\FirefoxVisitor;
use Zie\DeviceDetector\Visitor\Browser\OperaMiniVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class OperaMiniVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class OperaMiniVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeOperaMini()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Opera/10.61 (J2ME/MIDP; Opera Mini/5.1.21219/19.999; en-US; rv:1.9.3a5) WebKit/534.5 Presto/2.6.30'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'OperaMiniVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::BROWSER_OPERA_MINI,
            $collector->getCapability(Capabilities::BROWSER),
            'OperaMiniVisitor should recognize Firefox browser.'
        );

        $this->assertEquals(
            Capabilities::VENDOR_OPERA,
            $collector->getCapability(Capabilities::BROWSER_VENDOR),
            'OperaMiniVisitor should recognize Opera vendor browser.'
        );

        $this->assertEquals(
            '5',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'OperaMiniVisitor should recognize Opera version.'
        );

        $this->assertEquals(
            '5.1.21219',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'OperaMiniVisitor should recognize Opera full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new OperaMiniVisitor();
    }
}
