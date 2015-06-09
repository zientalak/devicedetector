<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class StrposEvalulatorSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator
 */
class StrposEvalulatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\StrposEvalulator');
    }

    function it_implements_evalulator_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface');
    }

    function it_return_true_if_stripos_match(UserAgentToken $token, ConditionInterface $condition, RuleInterface $rule)
    {
        $token->__toString()->willReturn(
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.74 Safari/537.36 MRCHROME'
        );
        $condition->getValue()->willReturn('AppleWebKit');

        $this->evaluate($token, $condition, $rule)->shouldReturn(true);
    }

    function it_return_false_of_stripos_does_not_match(
        UserAgentToken $token,
        ConditionInterface $condition,
        RuleInterface $rule
    ) {
        $token->__toString()->willReturn(
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.74 Safari/537.36 MRCHROME'
        );
        $condition->getValue()->willReturn('AppleWebKit2');

        $this->evaluate($token, $condition, $rule)->shouldReturn(false);
    }

    function it_return_regexp_name()
    {
        $this->getName()->shouldReturn(ConditionInterface::TYPE_STRPOS);
    }
}
