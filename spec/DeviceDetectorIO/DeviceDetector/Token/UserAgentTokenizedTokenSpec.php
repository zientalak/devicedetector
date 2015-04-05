<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UserAgentTokenizedTokenSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Token
 */
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
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';

        $token
            ->getData()
            ->shouldBeCalledTimes(2)
            ->willReturn($userAgent);

        $tokenizer
            ->tokenize(Argument::exact($userAgent))
            ->shouldBeCalledTimes(1)
            ->willReturn(array('mozilla', 'linux'));

        $this->beConstructedWith($token, $tokenizer);

        $this->getData()->shouldReturn(array('mozilla', 'linux'));
        $this->getData()->shouldReturn(array('mozilla', 'linux'));

        $this->__toString()->shouldReturn($userAgent);
    }

    function it_is_serializable(UserAgentTokenizer $tokenizer)
    {
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';

        $tokenizer
            ->tokenize(Argument::exact($userAgent))
            ->shouldBeCalledTimes(1)
            ->willReturn(array('mozilla', 'linux'));

        $token = new UserAgentToken($userAgent);
        $this->beConstructedWith($token, $tokenizer);

        $this->serialize()->shouldReturn(serialize(
            array(
                'tokens' => array('mozilla', 'linux'),
                'token' => $token
            )
        ));

        $data = array(
            'tokens' => array('mozilla', 'windows'),
            'token' => $token
        );
        $this->unserialize(serialize($data));

        $this->getData()->shouldReturn($data['tokens']);
    }
}
