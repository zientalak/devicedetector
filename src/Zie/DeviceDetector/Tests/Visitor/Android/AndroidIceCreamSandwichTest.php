<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Tests\Visitor\Android\AndroidBaseTest;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\AndroidVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidIceCreamSandwichTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidIceCreamSandwichTest extends AndroidBaseTest
{
    /**
     * @test
     */
    public function recognizeAndoirdHoneycomb()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 4.0.3; pl-pl; Transformer TF101 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidVisitor should return seeking status.'
        );
        $this->assertSame(
            Capabilities::OS_ANDROID,
            $collector->getCapability(Capabilities::OS),
            'AndroidVisitor should set Android OS.'
        );
        $this->assertSame(
            Capabilities::VENDOR_GOOGLE,
            $collector->getCapability(Capabilities::OS_VENDOR),
            'AndroidVisitor should set Google vendor.'
        );
        $this->assertSame(
            '4.0.3',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AndroidVisitor should set version properly.'
        );
        $this->assertSame(
            '4.0.3',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AndroidVisitor should set full version properly.'
        );
        $this->assertSame(
            'Ice Cream Sandwich',
            $collector->getCapability(Capabilities::OS_RELEASE),
            'AndroidVisitor should recognize Ice Cream Sandwich release.'
        );
    }
}
