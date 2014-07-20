<?php
namespace Zie\DeviceDetector\Tests\TestCase;

use Zie\DeviceDetector\Context\Context;
use Zie\DeviceDetector\Token\UserAgentToken;

/**
 * Class VisitorTestCase
 * @package Zie\DeviceDetector\Tests\TestCase
 */
abstract class VisitorTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    abstract function getUserAgentSuccess();

    /**
     * @return array
     */
    abstract function getCapabilitiesSuccess();

    /**
     * @param string $userAgent
     * @return UserAgentToken
     */
    protected function getUserAgentToken($userAgent)
    {
        return new UserAgentToken($userAgent);
    }

    /**
     * @param array $capabilities
     * @return Context
     */
    protected function getContext(array $capabilities = array())
    {
        $context = new Context();
        $context->setCapabilities($capabilities);

        return $context;
    }
} 