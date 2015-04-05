<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Repository;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;

/**
 * Interface RepositoryInterface
 * @package DeviceDetectorIO\DeviceDetector\Repository
 */
interface RepositoryInterface
{
    /**
     * @param UserAgentTokenizedToken $token
     * @return \Iterator<DeviceDetectorIO\DeviceDetector\Rule\Rule\RuleInterface>
     */
    public function getIndexableRulesByUserAgentToken(UserAgentTokenizedToken $token);

    /**
     * @return \Iterator<DeviceDetectorIO\DeviceDetector\Rule\Rule\RuleInterface>
     */
    public function getNonIndexableRules();
}
