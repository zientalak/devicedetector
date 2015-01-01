<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class OperaMiniVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class OperaMiniVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\OperaMiniVisitor';

    public function testSuccess()
    {
        $userAgent = 'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (S60; SymbOS; Opera Mobi/23.348; U; en) Presto/2.5.25 Version/10.54';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_OPERA_MINI, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('9', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('9.80', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(Capabilities::VENDOR_OPERA, $context->getCapability(Capabilities::BROWSER_VENDOR));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertNull($context->getCapability(Capabilities::BROWSER));
        $this->assertNull($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertNull($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertNull($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}
