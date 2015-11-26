<?php

namespace DeviceDetectorIO\DeviceDetector\UserAgent;

/**
 * Interface UserAgentTokenizerInterface.
 */
interface UserAgentTokenizerInterface
{
    /**
     * @param string $userAgent
     *
     * @return \Iterator<DeviceDetectorIO\DeviceDetector\Rule\Node\NodeInterface>
     */
    public function tokenize($userAgent);
}
