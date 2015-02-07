<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Robot\Spider360Visitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class Spider360VisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class Spider360VisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeSpider360()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.8.0.11) Gecko/20070312 Firefox/1.5.0.11; 360Spider'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'Spider360Visitor should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'Spider360Visitor should set recognize robot.'
        );

        $this->assertEquals(
            '360Spider',
            $collector->getCapability(Capabilities::ROBOT_NAME),
            'Spider360Visitor should recognize name.'
        );

        $this->assertEquals(
            'Online Media Group, Inc.',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER),
            'Spider360Visitor should recognize producer.'
        );

        $this->assertEquals(
            'http://www.so.com/help/help_3_2.html',
            $collector->getCapability(Capabilities::ROBOT_URL),
            'Spider360Visitor should recognize url.'
        );

        $this->assertEquals(
            Capabilities::ROBOT_CATEGORY_SEARCH_BOT,
            $collector->getCapability(Capabilities::ROBOT_CATEGORY),
            'Spider360Visitor should recognize category.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new Spider360Visitor();
    }
}
