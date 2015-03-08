<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Interface TokenPoolInterface
 * @package DeviceDetectorIO\DeviceDetector\Token
 */
interface TokenPoolInterface extends \Countable
{
    /**
     * @return \Iterator
     */
    public function getTokens();

    /**
     * @param array $tokens
     * @return self
     */
    public function setTokens(array $tokens);

    /**
     * @param TokenInterface $token
     * @return self
     */
    public function addToken(TokenInterface $token);

    /**
     * @param TokenInterface $token
     * @return boolean
     */
    public function hasToken(TokenInterface $token);

    /**
     * @param TokenInterface $token
     * @return self
     */
    public function removeToken(TokenInterface $token);

    /**
     * @return self
     */
    public function clear();
}
