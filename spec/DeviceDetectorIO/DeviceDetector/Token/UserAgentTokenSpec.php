<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Token;

use PhpSpec\ObjectBehavior;

/**
 * Class UserAgentTokenSpec.
 */
class UserAgentTokenSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($this->get_useragent());
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Token\UserAgentToken');
    }

    public function it_implement_token_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Token\TokenInterface');
    }

    public function it_return_useragent()
    {
        $this->getData()->shouldReturn($this->get_useragent());
        $this->__toString()->shouldReturn($this->get_useragent());
    }

    public function it_is_serializable()
    {
        $this->serialize()->shouldReturn(serialize($this->get_useragent()));

        $capabilities = 'UserAgent Serialized';
        $this->unserialize(serialize($capabilities));
        $this->getData()->shouldReturn($capabilities);
    }

    private function get_useragent()
    {
        return 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';
    }
}
