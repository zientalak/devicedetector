<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\WindowsMobileVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsMobileVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class WindowsMobileVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeWindowsCE()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Opera/9.80 (Windows Mobile; WCE; Opera Mobi/WMD-50430; U; en-GB) Presto/2.4.13 Version/10.00'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsMobileVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS_MOBILE,
            $collector->getCapability(Capabilities::OS),
            'WindowsMobileVisitor should set recognize Windows Mobile.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsMobileVisitor should set recognize Windows family.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new WindowsMobileVisitor();
    }
}
