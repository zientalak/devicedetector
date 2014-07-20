<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Capabilities;

class RobotVisitor extends AbstractUserAgentVisitor
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
    protected function doVisit(TokenInterface $token, ContextInterface $context)
    {
        $context->setCapability(Capabilities::IS_ROBOT, true);

        return VisitorInterface::STATE_FOUND;
    }
} 