<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;

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
        foreach ($this->getPatterns() as $pattern) {
            $position = stripos($token->getData(), $pattern);
            if (false !== $position) {
                return (int)$this->doVisit(
                    $token,
                    $collector,
                    $position
                );
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @param integer $position
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $collector, $position);

    /**
     * @return array
     */
    abstract protected function getPatterns();
}
