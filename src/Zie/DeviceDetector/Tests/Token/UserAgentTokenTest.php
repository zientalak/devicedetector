<?php

namespace Zie\DeviceDetector\Tests\Token;

use Zie\DeviceDetector\Token\UserAgentToken;

/**
 * Class UserAgentTokenTest
 * @package Zie\DeviceDetector\Tests\Token
 */
class UserAgentTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function userAgentTokenShouldReturnRawData()
    {
        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.7.10) Gecko/20050717 Firefox/1.0.6';
        $userAgentToken = new UserAgentToken($userAgent);

        $this->assertEquals(
            $userAgent,
            $userAgentToken->getData(),
            'UserAgentToken should return expected data.'
        );
    }

    /**
     * @test
     */
    public function userAgentTokenShouldBeSerializable()
    {
        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.7.10) Gecko/20050717 Firefox/1.0.6';
        $userAgentToken = new UserAgentToken($userAgent);

        $serializedToken = serialize($userAgentToken);
        /** @var UserAgentToken $unserializedToken */
        $unserializedToken = unserialize($serializedToken);

        $this->assertInstanceOf(
            'Zie\DeviceDetector\Token\UserAgentToken',
            $unserializedToken,
            'Unserialize should return instance of Zie\DeviceDetector\Token\UserAgentToken.'
        );

        $this->assertSame(
            $userAgentToken->getData(),
            $unserializedToken->getData(),
            'Object should be same before and after serialization.'
        );
    }
}
