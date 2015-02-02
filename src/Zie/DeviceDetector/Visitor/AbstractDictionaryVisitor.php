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
    public function visit(TokenInterface $token, CollectorInterface $context)
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
        $doVisit = (int)$this->doVisit(
            $token,
            $context,
            $match,
            $matches
        );

        if (VisitorInterface::STATE_FOUND === $doVisit) {
            return $doVisit;
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $context
     * @param boolean $match
     * @param array $matches
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, array $matches);

    /**
     * @return array
     */
    abstract protected function getPatterns();
}
