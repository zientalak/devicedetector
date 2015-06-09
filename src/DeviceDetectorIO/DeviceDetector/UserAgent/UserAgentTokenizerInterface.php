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
     * @return \Iterator<DeviceDetectorIO\DeviceDetector\Rule\Node\NodeInterface>
     */
    public function tokenize($userAgent);
}
