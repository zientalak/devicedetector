<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class AbstractPatternVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
abstract class AbstractPatternVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $matches = array();
        $match = (boolean)preg_match($this->getPattern(), $token->getData(), $matches);

        return (int)$this->doVisit(
            $token,
            $collector,
            $match,
            (array)$matches
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
     * @return string
     */
    abstract protected function getPattern();
}
