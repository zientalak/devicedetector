<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Class TokenPool
 * @package DeviceDetectorIO\DeviceDetector\Token
 */
class TokenPool implements TokenPoolInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $pool;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pool = new \SplObjectStorage();
    }

    /**
     * {@inheritdoc}
     */
    public function getTokens()
    {
        return $this->pool;
    }

    /**
     * {@inheritdoc}
     */
    public function setTokens(array $tokens)
    {
        $this->clear();

        foreach ($tokens as $token) {
            $this->addToken($token);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->pool->removeAll($this->pool);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addToken(TokenInterface $token)
    {
        $this->pool->attach($token);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeToken(TokenInterface $token)
    {
        if ($this->hasToken($token)) {
            $this->pool->detach($token);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasToken(TokenInterface $token)
    {
        return $this->pool->contains($token);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->pool->count();
    }
}
