<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class AbstractMachVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
abstract class AbstractMachVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $strpos = strripos($token->getData(), $this->getPattern());

        return (int)$this->doVisit(
            $token,
            $collector,
            $strpos !== false,
            $strpos
        );
    }

    /**
     * @param TokenInterface $token
     * @param CollectorInterface $collector
     * @param boolean $match
     * @param integer $position
     * @return integer
     */
    abstract protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, $position);

    /**
     * @return string
     */
    abstract protected function getPattern();
}
