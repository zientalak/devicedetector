<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;

/**
 * Interface ResolverInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\ConditionEvaluator\Resolver
 */
interface ResolverInterface
{
    /**
     * @param ConditionInterface $condition
     * @return mixed
     */
    public function resolve(ConditionInterface $condition);
}
