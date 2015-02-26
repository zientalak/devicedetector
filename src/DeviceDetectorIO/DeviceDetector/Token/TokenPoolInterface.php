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
     * @return TokenPoolInterface
     */
    public function setTokens(array $tokens);

    /**
     * @param TokenInterface $token
     * @return TokenPoolInterface
     */
    public function addToken(TokenInterface $token);

    /**
     * @param TokenInterface $token
     * @return boolean
     */
    public function hasToken(TokenInterface $token);

    /**
     * @param TokenInterface $token
     * @return TokenPoolInterface
     */
    public function removeToken(TokenInterface $token);

    /**
     * @return TokenPoolInterface
     */
    public function clear();
}
