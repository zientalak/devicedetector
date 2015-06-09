<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\RegexEvaluator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver\Resolver');
    }

    function it_implements_resolver_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver\ResolverInterface');
    }

    function it_implements_resolver_factory_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver\ResolverFactoryInterface');
    }

    function it_add_evaluator()
    {
        $evaluator = new RegexEvaluator();

        $this->add($evaluator)->shouldReturn(true);
        $this->add($evaluator)->shouldReturn(false);
    }

    function it_has_evaluator()
    {
        $evaluator = new RegexEvaluator();

        $this->has($evaluator)->shouldReturn(false);
        $this->add($evaluator);
        $this->has($evaluator)->shouldReturn(true);
    }

    function it_remove_evaluator()
    {
        $evaluator = new RegexEvaluator();

        $this->remove($evaluator)->shouldReturn(false);
        $this->add($evaluator);
        $this->remove($evaluator)->shouldReturn(true);
        $this->has($evaluator)->shouldReturn(false);
    }

    function it_remove_all_evaluator()
    {
        $evaluator = new RegexEvaluator();

        $this->has($evaluator)->shouldReturn(false);
        $this->add($evaluator)->shouldReturn(true);
        $this->removeAll()->shouldReturn(true);
        $this->has($evaluator)->shouldReturn(false);
    }

    function it_resolve_evaluator()
    {
        $evaluator = new RegexEvaluator();
        $this->add($evaluator);

        $condition = new Condition();
        $condition->setType($evaluator->getName());

        $this->resolve($condition)->shouldReturn($evaluator);
    }

    function it_throw_exception_if_evaluator_does_not_exists()
    {
        $evaluator = new RegexEvaluator();

        $condition = new Condition();
        $condition->setType($evaluator->getName());

        $this->shouldThrow('DeviceDetectorIO\DeviceDetector\Exception\EvaluatorNotFoundException')->during('resolve', array($condition));
    }
}
