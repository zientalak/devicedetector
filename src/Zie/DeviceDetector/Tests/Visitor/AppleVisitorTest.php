<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class AppleVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AppleVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\AppleVisitor';

    public function testSuccess()
    {
        $this->macTestSuccess();
        $this->iPadTestSuccess();
        $this->iPodTestSuccess();
        $this->iPhoneTestSuccess();
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; sv-SE) AppleWebKit/533.19.4 (KHTML, like Gecko) Version/5.0.3 Safari/533.19.4';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertNull($context->getCapability(Capabilities::BRAND_NAME));
        $this->assertNotEquals(Capabilities::VENDOR_APPLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertNotEquals(Capabilities::OS_FAMILY_UNIX, $context->getCapability(Capabilities::OS_FAMILY));
        $this->assertNotEquals(Capabilities::OS_IOS, $context->getCapability(Capabilities::OS));
    }

    private function iPadTestSuccess()
    {
        $userAgent = 'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals('iPad', $context->getCapability(Capabilities::BRAND_NAME));
        $this->assertEquals('6.0', $context->getCapability(Capabilities::OS_VERSION));
        $this->assertEquals(Capabilities::VENDOR_APPLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertEquals(Capabilities::OS_FAMILY_UNIX, $context->getCapability(Capabilities::OS_FAMILY));
        $this->assertEquals(Capabilities::OS_IOS, $context->getCapability(Capabilities::OS));
    }

    private function iPodTestSuccess()
    {
        $userAgent = 'Mozilla/5.0 (iPod; U; CPU iPhone OS 4_3_3 like Mac OS X; ja-jp) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals('iPod', $context->getCapability(Capabilities::BRAND_NAME));
        $this->assertEquals('4.3.3', $context->getCapability(Capabilities::OS_VERSION));
        $this->assertEquals(Capabilities::VENDOR_APPLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertEquals(Capabilities::OS_FAMILY_UNIX, $context->getCapability(Capabilities::OS_FAMILY));
        $this->assertEquals(Capabilities::OS_IOS, $context->getCapability(Capabilities::OS));
    }

    private function iPhoneTestSuccess()
    {
        $userAgent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like Mac OS X; nb-no) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148a Safari/6533.18.5';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals('iPhone', $context->getCapability(Capabilities::BRAND_NAME));
        $this->assertEquals('4.2.1', $context->getCapability(Capabilities::OS_VERSION));
        $this->assertEquals(Capabilities::VENDOR_APPLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertEquals(Capabilities::OS_FAMILY_UNIX, $context->getCapability(Capabilities::OS_FAMILY));
        $this->assertEquals(Capabilities::OS_IOS, $context->getCapability(Capabilities::OS));
    }

    private function macTestSuccess()
    {
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals('10.7.3', $context->getCapability(Capabilities::OS_VERSION));
        $this->assertEquals(Capabilities::VENDOR_APPLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertEquals(Capabilities::OS_FAMILY_UNIX, $context->getCapability(Capabilities::OS_FAMILY));
        $this->assertEquals(Capabilities::OS_OSX, $context->getCapability(Capabilities::OS));
    }
}