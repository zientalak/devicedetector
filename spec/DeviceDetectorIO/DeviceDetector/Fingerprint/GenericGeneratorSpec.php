<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Fingerprint;

use PhpSpec\ObjectBehavior;
use DeviceDetectorIO\DeviceDetector\Token\TokenPool;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;

/**
 * Class GenericGeneratorSpec.
 */
class GenericGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Fingerprint\GenericGenerator');
    }

    public function it_implements_fingerprint_generator()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Fingerprint\FingerprintGeneratorInterface');
    }

    public function it_generate_fingerprint()
    {
        $token = new UserAgentToken('token');
        $tokenPool = new TokenPool();
        $tokenPool->add($token);

        $this->generate($tokenPool)->shouldReturn(sha1(serialize($token)));
    }

    public function it_throw_exception_on_empty_token_pool()
    {
        $this->shouldThrow('\LogicException')
            ->during('generate', [new TokenPool()]);
    }

    public function it_throw_exception_if_algorithm_not_exists()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', ['sha999']);
    }
}
