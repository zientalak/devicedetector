<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver;

use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface;

/**
 * Interface ResolverFactoryInterface.
 */
interface ResolverFactoryInterface
{
    /**
     * @param EvaluatorInterface $evaluator
     *
     * @return self
     */
    public function add(EvaluatorInterface $evaluator);

    /**
     * @param EvaluatorInterface $evaluator
     *
     * @return bool
     */
    public function has(EvaluatorInterface $evaluator);

    /**
     * @param EvaluatorInterface $evaluator
     *
     * @return bool
     */
    public function remove(EvaluatorInterface $evaluator);

    /**
     * @return bool
     */
    public function removeAll();
}
