<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver;

use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface;

/**
 * Interface ResolverFactoryInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver
 */
interface ResolverFactoryInterface
{
    /**
     * @param EvaluatorInterface $evaluator
     * @return self
     */
    public function add(EvaluatorInterface $evaluator);

    /**
     * @param EvaluatorInterface $evaluator
     * @return boolean
     */
    public function has(EvaluatorInterface $evaluator);

    /**
     * @param EvaluatorInterface $evaluator
     * @return boolean
     */
    public function remove(EvaluatorInterface $evaluator);

    /**
     * @return boolean
     */
    public function removeAll();
}
