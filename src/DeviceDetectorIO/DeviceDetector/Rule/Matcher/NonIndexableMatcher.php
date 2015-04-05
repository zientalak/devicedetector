<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Matcher;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver\ResolverInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class NonIndexableMatcher
 * @package DeviceDetectorIO\DeviceDetector\Rule\Matcher
 */
class NonIndexableMatcher implements MatcherInterface
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var ResolverInterface
     */
    private $resolver;

    /**
     * @param RepositoryInterface $repository
     * @param ResolverInterface $resolver
     */
    public function __construct(RepositoryInterface $repository, ResolverInterface $resolver)
    {
        $this->repository = $repository;
        $this->resolver = $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function match(TokenInterface $token)
    {
        $rules = new \SplObjectStorage();

        /** @var RuleInterface $rule */
        foreach ($this->repository->getNonIndexableRules() as $rule) {
            /** @var ConditionInterface $condition */
            foreach ($rule->getConditions() as $condition) {
                /** @var EvaluatorInterface $evaluator */
                $evaluator = $this->resolver->resolve($condition);

                $evaluator->evaluate($token, $condition, $rule)
                    ? $rules->attach($rule) : $rules->detach($rule);
            }
        }

        return $rules;
    }
}
