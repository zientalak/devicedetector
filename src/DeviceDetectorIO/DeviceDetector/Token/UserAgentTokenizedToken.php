<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer;
use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizerInterface;

/**
 * Class UserAgentTokenizedToken
 * @package DeviceDetectorIO\DeviceDetector\Token
 */
class UserAgentTokenizedToken implements TokenInterface
{
    /**
     * @var UserAgentToken
     */
    private $token;

    /**
     * @var UserAgentTokenizerInterface
     */
    private $tokenizer;

    /**
     * @var array
     */
    private $tokens;

    /**
     * @param UserAgentToken $token
     * @param UserAgentTokenizer $tokenizer
     */
    public function __construct(UserAgentToken $token, UserAgentTokenizer $tokenizer)
    {
        $this->token = $token;
        $this->tokenizer = $tokenizer;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        if (null === $this->tokens) {
            $this->tokens = $this->tokenizer->tokenize($this->token->getData());
        }

        return $this->tokens;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        $this->getData();

        return serialize($this->tokens);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->tokens = unserialize($serialized);
    }
}
