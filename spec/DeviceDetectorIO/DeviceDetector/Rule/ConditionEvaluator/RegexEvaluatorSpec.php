<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RegexEvaluatorSpec.
 */
class RegexEvaluatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\RegexEvaluator');
    }

    public function it_implements_evalulator_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface');
    }

    public function it_return_true_if_regexp_match(UserAgentToken $token, ConditionInterface $condition, RuleInterface $rule)
    {
        $token->__toString()->willReturn(
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.74 Safari/537.36 MRCHROME'
        );
        $condition->getValue()->willReturn('#AppleWebKit(?:/(?P<webkit_version>\d+[\.\d]+))#is');
        $condition
            ->getDynamicCapabilities()
            ->shouldBeCalled()
            ->willReturn(['webkit_version']);

        $rule->getCapabilities()
            ->willReturn(['applewebkit' => true])
            ->shouldBeCalled();

        $rule->setCapabilities(Argument::exact(['applewebkit' => true, 'webkit_version' => '537.36']))
            ->shouldBeCalled();

        $this->evaluate($token, $condition, $rule)->shouldReturn(true);
    }

    public function it_return_false_of_regexp_does_not_match(
        UserAgentToken $token,
        ConditionInterface $condition,
        RuleInterface $rule
    ) {
        $token->__toString()->willReturn(
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.74 Safari/537.36 MRCHROME'
        );
        $condition->getValue()->willReturn('#AppleWebKitt(?:/(?P<webkit_version>\d+[\.\d]+))#is');
        $condition
            ->getDynamicCapabilities()
            ->shouldNotBeCalled()
            ->willReturn(['webkit_version']);

        $rule->getCapabilities()
            ->willReturn(['applewebkit' => true])
            ->shouldNotBeCalled();

        $rule->setCapabilities(Argument::exact(['applewebkit' => true, 'webkit_version' => '537.36']))
            ->shouldNotBeCalled();

        $this->evaluate($token, $condition, $rule)->shouldReturn(false);
    }

    public function it_return_regexp_name()
    {
        $this->getName()->shouldReturn(ConditionInterface::TYPE_REGEX);
    }
}
