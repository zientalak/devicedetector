<?php

namespace spec\DeviceDetectorIO\DeviceDetector\MatchingStrategy;

use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringMatchingStrategySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\MatchingStrategy\StringMatchingStrategy');
    }

    function it_implements_matching_strategy()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyInterface');
    }

    function it_return_false_on_non_expected_token(TokenInterface $token)
    {
        $this->match(array(), $token)->shouldReturn(false);
    }


    function it_accept_only_isset_rule_strategy()
    {
        $this
            ->match(
                $this->create_not_match_rule(),
                $this->create_useragent_tokenized_token()
            )
            ->shouldReturn(false);
    }

    function it_match_capabilities()
    {
        $this
            ->match(
                $this->create_match_rule(),
                $this->create_useragent_tokenized_token()
            )
            ->shouldReturn(
                array(
                    'test' => 'test1'
                )
            );
    }

    /**
     * @return UserAgentTokenizedToken
     */
    private function create_useragent_tokenized_token()
    {
        return new UserAgentTokenizedToken(
            new UserAgentToken($this->create_useragent_string()),
            new UserAgentTokenizer()
        );
    }

    /**
     * @return array
     */
    private function create_match_rule()
    {
        return array(
            'patterns' => array(
                array(
                    'strategy' => 'string',
                    'value' => 'android',
                )
            ),
            'capabilities' => array(
                'test' => 'test1'
            )
        );
    }

    /**
     * @return array
     */
    private function create_not_match_rule()
    {
        return array('patterns' => array(array('strategy' => 'regex')));
    }

    /**
     * @return string
     */
    private function create_useragent_string()
    {
        return 'Mozilla/5.0 (Linux; U; Android 1.0; en-us; generic) AppleWebKit/525.10 (KHTML, like Gecko) Version/3.0.4 Mobile Safari/523.12.2';
    }
}
