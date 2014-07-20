<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Visitor\SmartTVVisitor;

/**
 * Class SmartTVTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class SmartTVTest extends VisitorTestCase
{
    protected $contextCapabilities = array();

    public function testSuccess()
    {
        $visitor = new SmartTVVisitor();
        $context = $this->getContext($this->getCapabilitiesSuccess());
        $token = $this->getUserAgentToken($this->getUserAgentSuccess());

        $this->assertTrue($visitor->accept($token, $context));
        $visitor->visit($token, $context);
    }

    /**
     * @return array
     */
    function getCapabilitiesSuccess()
    {
        return array();
    }

    /**
     * @return string
     */
    function getUserAgentSuccess()
    {
        return 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Large Screen Safari/533.4';
    }
}