<?php

namespace DeviceDetectorIO\DeviceDetector\Rule;

/**
 * Interface RuleRepositoryInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule
 */
interface RuleRepositoryInterface
{
    /**
     * @return array
     */
    public function getRules();
}