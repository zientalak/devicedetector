<?php

namespace Zie\DeviceDetector\Token;

/**
 * Class UserAgentToken
 * @package Zie\DeviceDetector\Token
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
}
