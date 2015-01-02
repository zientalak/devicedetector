<?php

namespace Zie\DeviceDetector\Tests\Fingerprint;

use Zie\DeviceDetector\Fingerprint\GenericGenerator;
use Zie\DeviceDetector\Token\TokenPool;

/**
 * Class FingerprintGeneratorTest
 * @package Zie\DeviceDetector\Tests\Fingerprint
 */
class FingerprintGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function fingerprintShouldGenerateHashOrReturnFalse()
    {
        $token1 = $this->getTokenMock('TokenMock1');
        $token2 = $this->getTokenMock('TokenMock2');

        $tokenPool = new TokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $fingerprintGenerator = new GenericGenerator(GenericGenerator::SHA1_ALGORITHM);

        $this->assertEquals(
            sha1(serialize($token1) . serialize($token2)),
            $fingerprintGenerator->getFingerprint($tokenPool),
            'Fingerprint should be expected sha1 hash.'
        );
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function fingerprintShouldThrowExceptionOnEmptyTokenPool()
    {
        $token1 = $this->getTokenMock('TokenMock1');
        $token2 = $this->getTokenMock('TokenMock2');

        $tokenPool = new TokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $tokenPool->clear();

        $fingerprintGenerator = new GenericGenerator(GenericGenerator::SHA1_ALGORITHM);
        $fingerprintGenerator->getFingerprint($tokenPool);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function fingerprintThrowExceptionWhenAlgorithmIsInvalid()
    {
        new GenericGenerator('sha111');
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
