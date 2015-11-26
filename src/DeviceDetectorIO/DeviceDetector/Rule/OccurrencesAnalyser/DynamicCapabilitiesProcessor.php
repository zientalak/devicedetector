<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;

/**
 * Class DynamicCapabilitiesProcessor.
 */
class DynamicCapabilitiesProcessor implements DynamicCapabilitiesProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(OccurrenceInterface $occurrence)
    {
        $condition = $occurrence->getCondition();
        $node = $occurrence->getNode();
        $rule = $occurrence->getRule();
        $dynamicCapabilities = $condition->getDynamicCapabilities();

        $matchesCapabilities = [];
        foreach ($dynamicCapabilities as $capability) {
            $matchesCapabilities[$capability] = $node->getValue();
        }

        $rule->setCapabilities(
            array_merge($rule->getCapabilities(), $matchesCapabilities)
        );
    }
}
