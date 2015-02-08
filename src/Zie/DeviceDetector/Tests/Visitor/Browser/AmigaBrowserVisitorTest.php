<?php

namespace Zie\DeviceDetector\Tests\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Browser\AmigaBrowserVisitor;
use Zie\DeviceDetector\Visitor\Browser\FennecVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AmigaBrowserVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class AmigaBrowserVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAweb()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 5.5; Amiga-AWeb/3.4APL)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AmigaBrowserVisitor should return seeking status.'
        );

        $this->assertEquals(
            'Amiga-AWeb',
            $collector->getCapability(Capabilities::BROWSER),
            'AmigaBrowserVisitor should recognize Amiga-AWeb browser.'
        );

        $this->assertEquals(
            '3.4APL',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'AmigaBrowserVisitor should recognize Amiga-AWeb version.'
        );

        $this->assertEquals(
            '3.4APL',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'AmigaBrowserVisitor should recognize Amiga-AWeb version.'
        );
    }

    /**
     * @test
     */
    public function recognizeAmigaVoyager()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'AmigaVoyager/2.95 (compatible; MC680x0; AmigaOS)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AmigaBrowserVisitor should return seeking status.'
        );

        $this->assertEquals(
            'AmigaVoyager',
            $collector->getCapability(Capabilities::BROWSER),
            'AmigaBrowserVisitor should recognize AmigaVoyager browser.'
        );

        $this->assertEquals(
            '2.95',
            $collector->getCapability(Capabilities::BROWSER_VERSION),
            'AmigaBrowserVisitor should recognize AmigaVoyager version.'
        );

        $this->assertEquals(
            '2.95',
            $collector->getCapability(Capabilities::BROWSER_VERSION_FULL),
            'AmigaBrowserVisitor should recognize AmigaVoyager version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AmigaBrowserVisitor();
    }
}
