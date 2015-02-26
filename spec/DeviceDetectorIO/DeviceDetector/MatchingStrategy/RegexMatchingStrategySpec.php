<?php

namespace spec\DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegexMatchingStrategySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\MatchingStrategy\RegexMatchingStrategy');
    }

    function it_implements_matching_strategy()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyInterface');
    }

    function it_return_false_on_non_expected_token(TokenInterface $token)
    {
        $this->match(array(), $token)->shouldReturn(false);
    }

    function it_accept_only_regex_rule_strategy()
    {
        $this
            ->match(
                $this->create_not_match_rule(),
                $this->create_useragent_token()
            )
            ->shouldReturn(false);
    }

    function it_match_capabilities()
    {
        $this
            ->match(
                $this->create_match_rule(),
                $this->create_useragent_token()
            )
            ->shouldReturn(
                array(
                    'os' => 'Android',
                    'is_mobile' => true,
                    'os_version' => '1.0'
                )
            );
    }

    /**
     * @return UserAgentToken
     */
    private function create_useragent_token()
    {
        return new UserAgentToken($this->create_useragent_string());
    }

    /**
     * @return array
     */
    private function create_not_match_rule()
    {
        return array('patterns' => array(array('strategy' => 'isset')));
    }

    /**
     * @return string
     */
    private function create_useragent_string()
    {
        return 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';
    }

    /**
     * @return array
     */
    private function create_match_rule()
    {
        return array(
            'patterns' => array(
                array(
                    'strategy' => 'regex',
                    'value' => '#(?:Android|Adr)[\s/](?P<os_version>[^\s-;]+)#is',
                    'matches' => array(
                        'os_version' => 'os_version'
                    )
                )
            ),
            'capabilities' => array(
                'os' => 'Android',
                'is_mobile' => true
            )
        );
    }
}
