<?php

namespace Zie\DeviceDetector\Tests\Token;

use Zie\DeviceDetector\Token\UserAgentToken;

/**
 * Class UserAgentTokenTest
 * @package Zie\DeviceDetector\Tests\Token
 */
class UserAgentTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.7.10) Gecko/20050717 Firefox/1.0.6';
        $userAgentToken = new UserAgentToken($userAgent);

        $this->assertEquals($userAgent, $userAgentToken->getData());
    }
}
