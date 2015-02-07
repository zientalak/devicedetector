<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Robot\AddThisVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AddThisVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AddThisVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAddThis()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'AddThis.com robot tech.support@clearspring.com'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'AddThisVisitor should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'AddThisVisitor should set recognize robot.'
        );

        $this->assertEquals(
            'AddThis.com',
            $collector->getCapability(Capabilities::ROBOT_NAME),
            'AddThisVisitor should recognize name.'
        );

        $this->assertEquals(
            'Clearspring Technologies, Inc.',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER),
            'AddThisVisitor should recognize producer.'
        );

        $this->assertEquals(
            'http://www.clearspring.com',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER_URL),
            'AddThisVisitor should recognize producer url.'
        );

        $this->assertEquals(
            Capabilities::ROBOT_CATEGORY_SOCIAL_MEDIA_AGENT,
            $collector->getCapability(Capabilities::ROBOT_CATEGORY),
            'AddThisVisitor should recognize category.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AddThisVisitor();
    }
}
