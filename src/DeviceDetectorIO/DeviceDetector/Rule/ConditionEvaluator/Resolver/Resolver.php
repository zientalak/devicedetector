<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver;

use DeviceDetectorIO\DeviceDetector\Exception\EvaluatorNotFoundException;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\EvaluatorInterface;

/**
 * Class Resolver.
 */
class Resolver implements ResolverInterface, ResolverFactoryInterface
{
    /**
     * @var array
     */
    private $evaluators = [];

    /**
     * {@inheritdoc}
     */
    public function add(EvaluatorInterface $evaluator)
    {
        if (!$this->has($evaluator)) {
            $this->evaluators[$evaluator->getName()] = $evaluator;

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function has(EvaluatorInterface $evaluator)
    {
        return isset($this->evaluators[$evaluator->getName()]);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EvaluatorInterface $evaluator)
    {
        if ($this->has($evaluator)) {
            unset($this->evaluators[$evaluator->getName()]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll()
    {
        $this->evaluators = [];

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(ConditionInterface $condition)
    {
        if (!isset($this->evaluators[$condition->getType()])) {
            throw new EvaluatorNotFoundException(
                sprintf('Evaluator for "%s" type not found.', $condition->getType())
            );
        }

        return $this->evaluators[$condition->getType()];
    }
}
