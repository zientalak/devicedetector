<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Fingerprint;

use DeviceDetectorIO\DeviceDetector\Token\TokenPool;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenericGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Fingerprint\GenericGenerator');
    }

    function it_implements_fingerprint_generator()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Fingerprint\FingerprintGeneratorInterface');
    }

    function it_generate_fingerprint()
    {
        $token = new UserAgentToken('token');

        $tokenPool = new TokenPool();
        $tokenPool->addToken($token);

        $this->getFingerprint($tokenPool)->shouldReturn(sha1(serialize($token)));
    }

    function it_throw_exception_on_empty_token_pool()
    {
        $this->shouldThrow('\LogicException')
            ->during('getFingerprint', array(new TokenPool()));
    }

    function it_throw_exception_if_algorithm_not_exists()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', array('sha999'));
    }
}
