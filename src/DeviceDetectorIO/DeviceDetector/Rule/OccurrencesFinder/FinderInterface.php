<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrencesInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;

/**
 * Interface FinderInterface.
 */
interface FinderInterface
{
    /**
     * @param UserAgentTokenizedToken $token
     *
     * @return OccurrencesInterface
     */
    public function find(UserAgentTokenizedToken $token);
}
