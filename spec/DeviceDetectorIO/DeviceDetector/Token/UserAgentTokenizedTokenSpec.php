<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UserAgentTokenizedTokenSpec.
 */
class UserAgentTokenizedTokenSpec extends ObjectBehavior
{
    public function let(UserAgentToken $token, UserAgentTokenizer $tokenizer)
    {
        $this->beConstructedWith($token, $tokenizer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken');
    }

    public function it_implement_token_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Token\TokenInterface');
    }

    public function it_return_tokens(UserAgentToken $token, UserAgentTokenizer $tokenizer)
    {
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';

        $token
            ->getData()
            ->shouldBeCalledTimes(2)
            ->willReturn($userAgent);

        $tokenizer
            ->tokenize(Argument::exact($userAgent))
            ->shouldBeCalledTimes(1)
            ->willReturn(['mozilla', 'linux']);

        $this->beConstructedWith($token, $tokenizer);

        $this->getData()->shouldReturn(['mozilla', 'linux']);
        $this->getData()->shouldReturn(['mozilla', 'linux']);

        $this->__toString()->shouldReturn($userAgent);
    }

    public function it_is_serializable(UserAgentTokenizer $tokenizer)
    {
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';

        $tokenizer
            ->tokenize(Argument::exact($userAgent))
            ->shouldBeCalledTimes(1)
            ->willReturn(['mozilla', 'linux']);

        $token = new UserAgentToken($userAgent);
        $this->beConstructedWith($token, $tokenizer);

        $this->serialize()->shouldReturn(serialize(
            [
                'tokens' => ['mozilla', 'linux'],
                'token' => $token,
            ]
        ));

        $data = [
            'tokens' => ['mozilla', 'windows'],
            'token' => $token,
        ];
        $this->unserialize(serialize($data));

        $this->getData()->shouldReturn($data['tokens']);
    }
}
