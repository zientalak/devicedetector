<?php

namespace DeviceDetectorIO\DeviceDetector\UserAgent;

/**
 * Class UserAgentTokenizer
 * @package DeviceDetectorIO\DeviceDetector\UserAgent
 */
class UserAgentTokenizer implements UserAgentTokenizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function tokenize($userAgent)
    {
        $iterator = new \SplDoublyLinkedList();
        $iterator->setIteratorMode(\SplDoublyLinkedList::IT_MODE_FIFO);

        foreach ($this->getTokens($userAgent) as $position => $token) {
            $token = trim($token);
            $iterator->push(
                new Node($token, $position, $this->resolveType($token))
            );
        }

        return $iterator;
    }

    /**
     * @param $token
     * @return int
     */
    private function resolveType($token)
    {
        if ('' === $token) {
            return NodeInterface::TYPE_SPACE;
        }

        return NodeInterface::TYPE_TEXT;
    }

    /**
     * @return array
     */
    private function getCatchablePatterns()
    {
        return array(
            'http:\/\/[^;\()]+',
            '[a-z0-9\.\-\_]+,[a-z0-9\.\-\_]+',
            '[a-z0-9\.\-\_]+',
            '[\/;\(),:\s+]+?'
        );
    }

    /**
     * @return string
     */
    private function buildRegex()
    {
        return sprintf(
            '/(%s)|%s/',
            implode(
                ')|(',
                $this->getCatchablePatterns()
            ),
            'i'
        );
    }

    /**
     * @param string $userAgent
     * @return string
     */
    private function normalizeUserAgent($userAgent)
    {
        return function_exists('mb_strtolower')
            ? mb_strtolower($userAgent) : strtolower($userAgent);
    }

    /**
     * @param $userAgent
     * @return array
     */
    private function getTokens($userAgent)
    {
        return
            preg_split(
                $this->buildRegex(),
                $this->normalizeUserAgent($userAgent),
                -1,
                PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
            );
    }
}
