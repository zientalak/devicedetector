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
     * @dataProvider providerSuccess
     * @param $userAgent
     * @param array $capabilities
     */
    public function testSuccess($userAgent, array $capabilities)
    {
        $visitor = $this->createVisitor();
        $context = $this->createContext($capabilities);
        $token = $this->createUserAgentToken($userAgent);

        $this->assertTrue($visitor->accept($token, $context));
        $this->assertContains(
            $visitor->visit($token, $context),
            array(VisitorInterface::STATE_SEEKING, VisitorInterface::STATE_FOUND)
        );

        $this->postContextSuccess($context);
    }

    /**
     * @dataProvider providerFailure
     * @param $userAgent
     * @param array $capabilities
     */
    public function testFailure($userAgent, array $capabilities)
    {
        $visitor = $this->createVisitor();
        $context = $this->createContext($capabilities);

        $token = $this->createUserAgentToken($userAgent);

        $this->assertTrue($visitor->accept($token, $context));
        $this->assertContains(
            $visitor->visit($token, $context),
            array(VisitorInterface::STATE_SEEKING, VisitorInterface::STATE_FOUND)
        );

        $this->postContextFailure($context);
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
     * @param ContextInterface $context
     */
    public abstract function postContextSuccess(ContextInterface $context);

    /**
     * @param ContextInterface $context
     */
    public abstract function postContextFailure(ContextInterface $context);

    /**
     * @return array
     */
    public abstract function providerSuccess();

    /**
     * @return array
     */
    public abstract function providerFailure();
} 