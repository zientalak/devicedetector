<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserAgentTokenSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($this->create_useragent());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Token\UserAgentToken');
    }

    function it_implement_token_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Token\TokenInterface');
    }

    function it_return_useragent()
    {
        $this->getData()->shouldReturn($this->create_useragent());
    }

    private function create_useragent()
    {
        return 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';
    }
}
