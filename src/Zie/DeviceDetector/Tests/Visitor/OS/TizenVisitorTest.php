<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\TizenVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class TizenVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\Browser
 */
class TizenVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeTizen()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; Tizen 2.3; SAMSUNG SM-Z130H) AppleWebKit/537.3 (KHTML, like Gecko) Version/2.3 Mobile Safari/537.3'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'TizenVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_TIZEN,
            $collector->getCapability(Capabilities::OS),
            'TizenVisitorTest should set recognize Tizen.'
        );

        $this->assertEquals(
            '2.3',
            $collector->getCapability(Capabilities::OS_VERSION),
            'TizenVisitorTest should set recognize Tizen version.'
        );

        $this->assertEquals(
            '2.3',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'TizenVisitorTest should set recognize Tizen full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_LINUX,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsPhoneVisitor should set recognize Tizen family.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new TizenVisitor();
    }
}
