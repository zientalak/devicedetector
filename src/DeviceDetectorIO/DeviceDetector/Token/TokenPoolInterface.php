<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Interface TokenPoolInterface.
 */
interface TokenPoolInterface extends \IteratorAggregate, \Countable
{
    /**
     * @return \Iterator
     */
    public function getPool();

    /**
     * @param TokenInterface $token
     *
     * @return bool
     */
    public function add(TokenInterface $token);

    /**
     * @param TokenInterface $token
     *
     * @return bool
     */
    public function has(TokenInterface $token);

    /**
     * @param TokenInterface $token
     *
     * @return bool
     */
    public function remove(TokenInterface $token);

    /**
     * @return bool
     */
    public function removeAll();
}
