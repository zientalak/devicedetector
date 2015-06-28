<?php

namespace DeviceDetectorIO\DeviceDetector\Tests\Token;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers UserAgentToken::serialize
     * @covers UserAgentToken::unserializable
     */
    public function userAgentTokenShouldBeSerializable()
    {
        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.7.10) Gecko/20050717 Firefox/1.0.6';
        $userAgentToken = new UserAgentToken($userAgent);
        $serializedToken = serialize($userAgentToken);
        /** @var UserAgentToken $unserializedToken */
        $unserializedToken = unserialize($serializedToken);
        $this->assertInstanceOf(
            'DeviceDetectorIO\DeviceDetector\Token\UserAgentToken',
            $unserializedToken,
            'Unserialize should return instance of DeviceDetectorIO\DeviceDetector\Token\UserAgentToken.'
        );
        $this->assertSame(
            $userAgentToken->getData(),
            $unserializedToken->getData(),
            'Object should be same before and after serialization.'
        );
    }
}
