<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class TokenPoolSpec.
 */
class TokenPoolSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Token\TokenPool');
    }

    public function it_implement_token_pool_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface');
    }

    public function it_set_tokens(TokenInterface $token1, TokenInterface $token2)
    {
        $tokens = [$token1, $token2];

        $this->setPool($tokens)->shouldReturn(true);
        $this->getPool()->shouldReturnAnInstanceOf('\Iterator');
        $this->getPool()->shouldHaveCount(2);
        $this->count()->shouldReturn(2);
        $this->has($token1)->shouldReturn(true);
        $this->has($token2)->shouldReturn(true);
    }

    public function it_delete_all_tokens(TokenInterface $token1)
    {
        $this->add($token1)->shouldReturn(true);
        $this->add($token1)->shouldReturn(true);
        $this->getPool()->shouldHaveCount(1);
        $this->removeAll()->shouldReturn(true);
        $this->getPool()->shouldHaveCount(0);
    }

    public function it_add_token(TokenInterface $token1)
    {
        $this->add($token1)->shouldReturn(true);
        $this->has($token1)->shouldReturn(true);
    }

    public function it_remove_token(TokenInterface $token1)
    {
        $this->add($token1)->shouldReturn(true);
        $this->has($token1)->shouldReturn(true);
        $this->remove($token1)->shouldReturn(true);
        $this->remove($token1)->shouldReturn(false);
        $this->has($token1)->shouldReturn(false);
    }
}
