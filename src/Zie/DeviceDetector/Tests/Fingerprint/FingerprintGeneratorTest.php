<?php

namespace Zie\DeviceDetector\Tests\Fingerprint;

use Zie\DeviceDetector\Fingerprint\Sha1Generator;
use Zie\DeviceDetector\Token\TokenPool;

/**
 * Class FingerprintGeneratorTest
 * @package Zie\DeviceDetector\Tests\Fingerprint
 */
class FingerprintGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testFingerprint()
    {
        $token1 = $this->getTokenMock('TokenMock1');
        $token2 = $this->getTokenMock('TokenMock2');

        $tokenPool = new TokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $fingerprintGenerator = new Sha1Generator();

        $this->assertEquals(sha1(serialize($token1) . serialize($token2)), $fingerprintGenerator->getFingerprint($tokenPool));
        $tokenPool->clear();

        $this->assertFalse($fingerprintGenerator->getFingerprint($tokenPool));
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
