<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Apple\OSXVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidAlphaTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class OSXVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeOSX()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'OSXVisitor should return seeking status.'
        );
        $this->assertEquals(
            Capabilities::OS_OSX,
            $collector->getCapability(Capabilities::OS),
            'OSXVisitor should return OSX.'
        );
        $this->assertEquals(
            Capabilities::VENDOR_APPLE,
            $collector->getCapability(Capabilities::OS_VENDOR),
            'OSXVisitor should return Apple vendor.'
        );
        $this->assertEquals(
            Capabilities::OS_FAMILY_UNIX,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'OSXVisitor should return Unix family vendor.'
        );
        $this->assertEquals(
            '10.8.5',
            $collector->getCapability(Capabilities::OS_VERSION),
            'OSXVisitor should return expected version.'
        );
        $this->assertEquals(
            '10.8.5',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'OSXVisitor should return expected full version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new OSXVisitor();
    }
}
