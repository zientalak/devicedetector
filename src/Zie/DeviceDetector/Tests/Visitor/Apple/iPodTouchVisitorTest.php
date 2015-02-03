<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Apple\IPodTouchVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IPodTouchVisitor
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class iPodTouchVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeIPod()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (iPod touch; U; CPU iPhone OS 4_1 like Mac OS X; HW iPod4,1; de_de) AppleWebKit/525.18.1 (KHTML, like Gecko) (AdMob-iSDK-20100614; iphoneos4.0)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'IPodTouchVisitor should return seeking status.'
        );
        $this->assertFalse(
            $collector->getCapability(Capabilities::IS_OSX),
            'IPodTouchVisitor should recognize OSX.'
        );
        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_IOS),
            'IPodTouchVisitor should recognize iOS.'
        );
        $this->assertEquals(
            Capabilities::OS_IOS,
            $collector->getCapability(Capabilities::OS),
            'IPodTouchVisitor should return iOS.'
        );
        $this->assertEquals(
            'iPod',
            $collector->getCapability(Capabilities::BRAND_NAME),
            'IPodTouchVisitor should return brand name.'
        );
        $this->assertEquals(
            'iPod touch 4G',
            $collector->getCapability(Capabilities::BRAND_NAME_FULL),
            'IPodTouchVisitor should return full brand name.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new IPodTouchVisitor();
    }
}
