<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserAgentTokenizedTokenSpec extends ObjectBehavior
{
    function let(UserAgentToken $token, UserAgentTokenizer $tokenizer)
    {
        $this->beConstructedWith($token, $tokenizer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken');
    }

    function it_implement_token_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Token\TokenInterface');
    }

    function it_return_tokens(UserAgentToken $token, UserAgentTokenizer $tokenizer)
    {
        $token
            ->getData()
            ->shouldBeCalledTimes(1)
            ->willReturn($this->create_useragent());

        $tokenizer
            ->tokenize(Argument::exact($this->create_useragent()))
            ->shouldBeCalledTimes(1)
            ->willReturn(array('mozilla', 'linux'));

        $this->beConstructedWith($token, $tokenizer);

        $this->getData()->shouldReturn(array('mozilla', 'linux'));
        $this->getData()->shouldReturn(array('mozilla', 'linux'));
    }

    private function create_useragent()
    {
        return 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';
    }
}
