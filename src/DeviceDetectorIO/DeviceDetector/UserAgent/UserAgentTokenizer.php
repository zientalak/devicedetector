<?php

namespace DeviceDetectorIO\DeviceDetector\UserAgent;

class UserAgentTokenizer implements UserAgentTokenizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function tokenize($userAgent)
    {
        return array_flip(
            preg_split(
                $this->getRegex(),
                $this->normalizeUserAgent($userAgent),
                -1,
                PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
            )
        );
    }

    /**
     * @return array
     */
    private function getCatchablePatterns()
    {
        return array(
            'http:\/\/[^;\()]+',
            '[a-z0-9\.\-\_]+,[a-z0-9\.\-\_]+',
            '[a-z0-9\.\-\_]+'
        );
    }

    /**
     * @return array
     */
    private function getNonCatchablePatterns()
    {
        return array(
            '\s+',
            '[\/;\(),]+'
        );
    }

    /**
     * @return string
     */
    private function getRegex()
    {
        return sprintf(
            '/(%s)|%s/%s',
            implode(
                ')|(',
                $this->getCatchablePatterns()
            ),
            implode('|', $this->getNonCatchablePatterns()),
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
}
