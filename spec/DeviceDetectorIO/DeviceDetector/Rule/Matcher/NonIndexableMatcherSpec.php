<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Matcher;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver\ResolverInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Rule;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class NonIndexableMatcherSpec.
 */
class NonIndexableMatcherSpec extends ObjectBehavior
{
    public function let(RepositoryInterface $repository, ResolverInterface $resolver)
    {
        $this->beConstructedWith($repository, $resolver);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Matcher\NonIndexableMatcher');
    }

    public function it_implements_matcher_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Matcher\MatcherInterface');
    }

    public function it_match_bu_using_repository_and_resolver(
        TokenInterface $token,
        RepositoryInterface $repository,
        ResolverInterface $resolver,
        Rule $rule,
        EvaluatorInterface $evaluator
    ) {
        $this->beConstructedWith($repository, $resolver);

        $condition = new Condition();
        $conditions = [$condition];

        $rule->getConditions()
            ->shouldBeCalled()
            ->willReturn($conditions);

        $rules = [$rule];

        $repository->getNonIndexableRules()
            ->shouldBeCalled()
            ->willReturn($rules);

        $resolver->resolve(Argument::exact($condition))
            ->shouldBeCalled()
            ->willReturn($evaluator);

        $evaluator
            ->evaluate(
                Argument::exact($token->getWrappedObject()),
                $condition,
                Argument::exact($rule->getWrappedObject())
            )
            ->shouldBeCalled()
            ->willReturn(true);

        $results = $this->match($token);

        $results->shouldReturnAnInstanceOf('\Iterator');
        $results->shouldHaveCount(1);
        $results->shouldHaveKey($rule);
    }
}
