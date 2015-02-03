<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Apple\IPadVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IPadVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class IPadVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeIPad()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (iPad2,2; iPad; U; CPU OS 7_0 like Mac OS X; nl_NL) com.google.GooglePlus/23341 (KHTML, like Gecko) Mobile/K94AP (gzip)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'IPadVisitor should return seeking status.'
        );
        $this->assertFalse(
            $collector->getCapability(Capabilities::IS_OSX),
            'IPadVisitor should recognize OSX.'
        );
        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_IOS),
            'IPadVisitor should recognize iOS.'
        );
        $this->assertEquals(
            Capabilities::OS_IOS,
            $collector->getCapability(Capabilities::OS),
            'IPadVisitor should return iOS.'
        );
        $this->assertEquals(
            'iPad',
            $collector->getCapability(Capabilities::BRAND_NAME),
            'IPadVisitor should return brand name.'
        );
        $this->assertEquals(
            'iPad 2',
            $collector->getCapability(Capabilities::BRAND_NAME_FULL),
            'IPadVisitor should return full brand name.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new IPadVisitor();
    }
}

