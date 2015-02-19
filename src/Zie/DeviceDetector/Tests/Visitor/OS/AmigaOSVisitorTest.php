<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\AmigaOSVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AmigaOSVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AmigaOSVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAmigaOSWithVersion()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'AmiTCP Miami (AmigaOS 2.04)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AmigaOSVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_AMIGA,
            $collector->getCapability(Capabilities::OS),
            'AmigaOSVisitorTest should set recognize AmigaOS.'
        );

        $this->assertEquals(
            '2.04',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AmigaOSVisitorTest should set recognize AmigaOS version.'
        );

        $this->assertEquals(
            '2.04',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AmigaOSVisitorTest should set recognize AmigaOS full version.'
        );
    }

    /**
     * @test
     */
    public function recognizeAmigaOS()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'AmigaVoyager/2.95 (compatible; MC680x0; AmigaOS)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AmigaOSVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_AMIGA,
            $collector->getCapability(Capabilities::OS),
            'AmigaOSVisitorTest should set recognize AmigaOS.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AmigaOSVisitor();
    }
}
