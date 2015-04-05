<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Interface TokenPoolInterface
 * @package DeviceDetectorIO\DeviceDetector\Token
 */
interface TokenPoolInterface extends \IteratorAggregate, \Countable
{
    /**
     * @return \Iterator
     */
    public function getPool();

    /**
     * @param TokenInterface $token
     * @return boolean
     */
    public function add(TokenInterface $token);

    /**
     * @param TokenInterface $token
     * @return boolean
     */
    public function has(TokenInterface $token);

    /**
     * @param TokenInterface $token
     * @return boolean
     */
    public function remove(TokenInterface $token);

    /**
     * @return boolean
     */
    public function removeAll();
}
