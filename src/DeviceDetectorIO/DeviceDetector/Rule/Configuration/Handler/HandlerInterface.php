<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;

/**
 * Interface HandlerInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler
 */
interface HandlerInterface
{
    /**
     * @param array $configuration
     * @param RuleInterface $rule
     * @return void
     */
    public function handle(array $configuration, RuleInterface $rule);
}
