<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\WindowsCEVisitior;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsCEVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class WindowsCEVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeWindowsCE()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows; U; Windows CE; Mobile; like iPhone; ko-kr) AppleWebKit/533.3 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.3 Dorothy'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsCEVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS_CE,
            $collector->getCapability(Capabilities::OS),
            'WindowsCEVisitor should set recognize Windows CE.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsCEVisitor should set recognize Windows family.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new WindowsCEVisitior();
    }
}
