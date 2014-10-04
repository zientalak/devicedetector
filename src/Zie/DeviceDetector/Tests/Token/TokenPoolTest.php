<?php

namespace Zie\DeviceDetector\Tests\Token;

use Zie\DeviceDetector\Token\TokenPool;

/**
 * Class TokenPoolTest
 * @package Zie\DeviceDetector\Tests\Token
 */
class TokenPoolTest extends \PHPUnit_Framework_TestCase
{
    public function testTokenPool()
    {
        $token1 = $this->getTokenMock('TokenMock1');
        $token2 = $this->getTokenMock('TokenMock2');

        $tokenPool = new TokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $this->assertCount(2, $tokenPool);
        $this->assertEquals(2, $tokenPool->count());

        $tokens = $tokenPool->getTokens();
        $this->assertTrue($tokenPool->hasToken($token1));
        $this->assertTrue($tokenPool->hasToken($token2));

        $tokens->rewind();
        $this->assertTrue($tokens->valid());
        $this->assertEquals($token1, $tokens->current());
        $tokens->next();

        $this->assertTrue($tokens->valid());
        $this->assertEquals($token2, $tokens->current());
        $tokens->next();
        $this->assertFalse($tokens->valid());

        $tokenPool->removeToken($token1);
        $this->assertFalse($tokenPool->hasToken($token1));
        $this->assertTrue($tokenPool->hasToken($token2));

        $tokenPool->clear();
        $this->assertCount(0, $tokenPool);

        $tokenPool->setTokens(
            array(
                $token2
            )
        );

        $this->assertTrue($tokenPool->hasToken($token2));
        $this->assertCount(1, $tokenPool);
    }

    /**
     * @param string $mockClassName
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getTokenMock($mockClassName)
    {
        return $this->getMockBuilder('Zie\DeviceDetector\Token\TokenInterface')
            ->setMockClassName($mockClassName)
            ->getMock();
    }
}
