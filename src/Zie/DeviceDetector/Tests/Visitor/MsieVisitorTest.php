<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class MsieVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class MsieVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\MsieVisitor';

    public function testSuccess()
    {
        $this->lte11TestSuccess();
        $this->gte11TestSuccess();
    }

    public function testFailure()
    {
        $this->notIEFailure();
        $this->operaLikeIEFailure();
    }

    private function gte11TestSuccess()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_IE, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('10', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('10.6', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $context->getCapability(Capabilities::BROWSER_VENDOR)
        );
    }

    private function lte11TestSuccess()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_IE, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('6', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('6.0', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(
            Capabilities::VENDOR_MICROSOFT,
            $context->getCapability(Capabilities::BROWSER_VENDOR)
        );
    }

    private function notIEFailure()
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::BROWSER_IE));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }

    private function operaLikeIEFailure()
    {
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; de) Opera 11.01';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::BROWSER_IE));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}
