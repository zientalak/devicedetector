<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Capabilities;

/**
 * Class RobotVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class RobotVisitor extends AbstractPatternMatchVisitor
{
    /**
     * @var array
     */
    protected $patterns = array(
        '+http',
        'bot',
        'crawler',
        'spider',
        'novarra',
        'transcoder',
        'yahoo! searchmonkey',
        'yahoo! slurp',
        'feedfetcher-google',
        'mowser',
        'feedly'
    );

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        $context->setCapability(Capabilities::IS_ROBOT, $match);

        return VisitorInterface::STATE_FOUND;
    }
} 