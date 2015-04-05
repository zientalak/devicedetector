<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TokenPoolSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Token
 */
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

        $this->setPool($tokens)->shouldReturn(true);
        $this->getPool()->shouldReturnAnInstanceOf('\Iterator');
        $this->getPool()->shouldHaveCount(2);
        $this->count()->shouldReturn(2);
        $this->has($token1)->shouldReturn(true);
        $this->has($token2)->shouldReturn(true);
    }

    function it_delete_all_tokens(TokenInterface $token1)
    {
        $this->add($token1)->shouldReturn(true);
        $this->add($token1)->shouldReturn(true);
        $this->getPool()->shouldHaveCount(1);
        $this->removeAll()->shouldReturn(true);
        $this->getPool()->shouldHaveCount(0);
    }

    function it_add_token(TokenInterface $token1)
    {
        $this->add($token1)->shouldReturn(true);
        $this->has($token1)->shouldReturn(true);
    }

    function it_remove_token(TokenInterface $token1)
    {
        $this->add($token1)->shouldReturn(true);
        $this->has($token1)->shouldReturn(true);
        $this->remove($token1)->shouldReturn(true);
        $this->remove($token1)->shouldReturn(false);
        $this->has($token1)->shouldReturn(false);
    }
}
