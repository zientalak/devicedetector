<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Class TokenPool.
 */
class TokenPool implements TokenPoolInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $pool;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->pool = new \SplObjectStorage();
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->pool;
    }

    /**
     * {@inheritdoc}
     */
    public function setPool(array $pool)
    {
        $this->removeAll();

        foreach ($pool as $token) {
            $this->add($token);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function add(TokenInterface $token)
    {
        $this->pool->attach($token);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function has(TokenInterface $token)
    {
        return $this->pool->contains($token);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(TokenInterface $token)
    {
        if ($this->has($token)) {
            $this->pool->detach($token);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll()
    {
        $this->pool->removeAll($this->pool);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getPool()
    {
        return $this->pool;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->pool->count();
    }
}
