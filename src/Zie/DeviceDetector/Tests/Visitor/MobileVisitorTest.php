<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\MobileVisitor;
use Zie\DeviceDetector\Visitor\RobotVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class MobileVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class MobileVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeMobile()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0) BlackBerry8703e/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/104'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'MobileVisitor should return seeking status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_MOBILE),
            'MobileVisitor should recognize that mobile devices.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new MobileVisitor();
    }
}
