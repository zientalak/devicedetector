<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Apple\IPadVisitor;
use Zie\DeviceDetector\Visitor\Apple\IPhoneVisitor;
use Zie\DeviceDetector\Visitor\Apple\OSXVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IPhoneVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class IPhoneVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeIPhone()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Mobile/10A405 [FBAN/FBIOS;FBAV/5.0;FBBV/47423;FBDV/iPhone5,2;FBMD/iPhone;FBSN/iPhone OS;FBSV/6.0;FBSS/2; FBCR/StarHub;FBID/phone;FBLC/en_US]'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'IPhoneVisitor should return seeking status.'
        );
        $this->assertFalse(
            $collector->getCapability(Capabilities::IS_OSX),
            'IPhoneVisitor should recognize OSX.'
        );
        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_IOS),
            'IPhoneVisitor should recognize iOS.'
        );
        $this->assertEquals(
            Capabilities::OS_IOS,
            $collector->getCapability(Capabilities::OS),
            'IPhoneVisitor should return iOS.'
        );
        $this->assertEquals(
            'iPhone',
            $collector->getCapability(Capabilities::BRAND_NAME),
            'IPhoneVisitor should return brand name.'
        );
        $this->assertEquals(
            'iPhone 5',
            $collector->getCapability(Capabilities::BRAND_NAME_FULL),
            'IPhoneVisitor should return full brand name.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new IPhoneVisitor();
    }
}
