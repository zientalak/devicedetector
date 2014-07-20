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
     * @param strings $userAgent
     */
    function __construct($userAgent)
    {
        $this->userAgent = (string)$userAgent;
    }

    /**
     * {@inheritdoc}
     */
    public function &getData()
    {
        return $this->userAgent;
    }
} 