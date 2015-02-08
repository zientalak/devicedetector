<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\UnknownStateException;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\UserAgentToken;

/**
 * Class AbstractDictionaryVisitor
 * @package Zie\DeviceDetector\Visitor
 */
abstract class AbstractDictionaryVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $patterns = array_map(
            function ($segment) {
                return preg_quote($segment);
            },
            $this->getPatterns()
        );
        $pattern = sprintf('#%s#is', implode('|', $patterns));
        $matches = array();
        $match = (boolean)preg_match($pattern, $token->getData(), $matches);

        return (int)$this->doVisit(
            $token,
            $collector,
            $match,
            $matches
        );
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @param boolean $match
     * @param array $matches
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches);

    /**
     * @return array
     */
    abstract protected function getPatterns();
}
