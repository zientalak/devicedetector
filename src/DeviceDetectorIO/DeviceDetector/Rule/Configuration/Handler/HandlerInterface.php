<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;

/**
 * Interface HandlerInterface.
 */
interface HandlerInterface
{
    /**
     * @param array         $configuration
     * @param RuleInterface $rule
     */
    public function handle(array $configuration, RuleInterface $rule);
}
