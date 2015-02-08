<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Tests\Visitor\Android\AndroidBaseTest;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\AndroidVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidGingerbreadTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidGingerbreadTest extends AndroidBaseTest
{
    /**
     * @test
     */
    public function recognizeAndoirdGingerbread()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 2.3.7; ja-jp; L-02D Build/GWK74) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidVisitor should return seeking status.'
        );
        $this->assertSame(
            Capabilities::VENDOR_GOOGLE,
            $collector->getCapability(Capabilities::OS_VENDOR),
            'AndroidVisitor should set Google vendor.'
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
            '2.3.7',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AndroidVisitor should set version properly.'
        );
        $this->assertSame(
            '2.3.7',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AndroidVisitor should set full version properly.'
        );
        $this->assertSame(
            'Gingerbread',
            $collector->getCapability(Capabilities::OS_RELEASE),
            'AndroidVisitor should recognize Gingerbread release.'
        );
    }
}
