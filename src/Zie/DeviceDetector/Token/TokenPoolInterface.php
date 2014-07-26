<?php

namespace Zie\DeviceDetector\Token;

/**
 * Interface TokenPoolInterface
 * @package Zie\DeviceDetector\Token
 */
interface TokenPoolInterface extends \Countable
{
    /**
     * @return \Iterator
     */
    public function getTokens();

    /**
     * @return array
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

    /**
     * @return string|boolean
     */
    public function getFingerprint();
} 