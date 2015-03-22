<?php

namespace DeviceDetectorIO\DeviceDetector\UserAgent;

/**
 * Interface UserAgentTokenizerInterface
 * @package DeviceDetectorIO\DeviceDetector\UserAgent
 */
interface UserAgentTokenizerInterface
{
    /**
     * @param string $userAgent
     * @return array
     */
    public function tokenize($userAgent);
}
