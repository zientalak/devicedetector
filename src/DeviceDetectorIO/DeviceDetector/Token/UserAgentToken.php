<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Class UserAgentToken
 * @package DeviceDetectorIO\DeviceDetector\Token
 */
class UserAgentToken implements TokenInterface
{
    /**
     * @var string
     */
    private $userAgent;

    /**
     * @param string $userAgent
     */
    public function __construct($userAgent)
    {
        $this->userAgent = (string)$userAgent;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->userAgent;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->userAgent);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->userAgent = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->userAgent;
    }
}
