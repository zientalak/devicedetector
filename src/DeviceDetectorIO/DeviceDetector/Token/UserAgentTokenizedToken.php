<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

use DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizerInterface;

/**
 * Class UserAgentTokenizedToken.
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
     * @param UserAgentToken              $token
     * @param UserAgentTokenizerInterface $tokenizer
     */
    public function __construct(UserAgentToken $token, UserAgentTokenizerInterface $tokenizer)
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
            $this->tokens = $this->tokenizer->tokenize(
                $this->token->getData()
            );
        }

        return $this->tokens;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        $this->getData();

        return serialize([
            'tokens' => $this->tokens,
            'token' => $this->token,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->token = $data['token'];
        $this->tokens = $data['tokens'];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->token->getData();
    }
}
