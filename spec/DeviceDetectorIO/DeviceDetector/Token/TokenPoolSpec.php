<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenPoolSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Token\TokenPool');
    }

    function it_implement_token_pool_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface');
    }

    function it_set_tokens(TokenInterface $token1, TokenInterface $token2)
    {
        $tokens = array($token1, $token2);

        $this->setTokens($tokens)->shouldReturn($this);
        $this->getTokens()->shouldReturnAnInstanceOf('\Iterator');
        $this->getTokens()->shouldHaveCount(2);
        $this->count()->shouldReturn(2);
        $this->hasToken($token1)->shouldReturn(true);
        $this->hasToken($token2)->shouldReturn(true);
    }

    function it_clear_tokens(TokenInterface $token1)
    {
        $this->addToken($token1)->shouldReturn($this);
        $this->getTokens()->shouldHaveCount(1);
        $this->clear()->shouldReturn($this);
        $this->getTokens()->shouldHaveCount(0);
    }

    function it_add_token(TokenInterface $token1)
    {
        $this->addToken($token1)->shouldReturn($this);
        $this->hasToken($token1)->shouldReturn(true);
    }

    function it_remove_token(TokenInterface $token1)
    {
        $this->addToken($token1)->shouldReturn($this);
        $this->hasToken($token1)->shouldReturn(true);
        $this->removeToken($token1)->shouldReturn($this);
        $this->hasToken($token1)->shouldReturn(false);
    }
}
