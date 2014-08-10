<?php
namespace Zie\DeviceDetector\Tests\TestCase;

use Zie\DeviceDetector\Context\Context;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class VisitorTestCase
 * @package Zie\DeviceDetector\Tests\TestCase
 */
abstract class VisitorTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $visitor;

    /**
     * @param $userAgent
     * @param array $capabilities
     * @return Context
     */
    public function initTestSuccess($userAgent, array $capabilities)
    {
        return $this->initTest($userAgent, $capabilities);
    }

    /**
     * @param $userAgent
     * @param array $capabilities
     * @return Context
     */
    public function initTestFailure($userAgent, array $capabilities)
    {
        return $this->initTest($userAgent, $capabilities);
    }

    /**
     * @return VisitorInterface
     */
    public function createVisitor()
    {
        return new $this->visitor;
    }

    /**
     * @param array $capabilities
     * @return Context
     */
    public function createContext(array $capabilities)
    {
        $context = new Context();
        $context->setCapabilities($capabilities);

        return $context;
    }

    /**
     * @param $userAgent
     * @return UserAgentToken
     */
    protected function createUserAgentToken($userAgent)
    {
        return new UserAgentToken($userAgent);
    }

    /**
     * @param $userAgent
     * @param array $capabilities
     * @return Context
     */
    protected function initTest($userAgent, array $capabilities)
    {
        $visitor = $this->createVisitor();
        $context = $this->createContext($capabilities);
        $token = $this->createUserAgentToken($userAgent);

        $this->assertTrue($visitor->accept($token, $context));
        $this->assertContains(
            $visitor->visit($token, $context),
            array(VisitorInterface::STATE_SEEKING, VisitorInterface::STATE_FOUND)
        );

        return $context;
    }

    public abstract function testSuccess();
    public abstract function testFailure();
} 