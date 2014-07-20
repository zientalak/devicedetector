<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Capabilities;

class SmartTVVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var array
     */
    protected $patterns = array(
        'googletv',
        'boxee',
        'sonydtv',
        'appletv',
        'smarttv',
        'smart-tv',
        'dlna',
        'netcast.tv',
        'ce-html',
        'inettvbrowser',
        'opera tv',
        'viera',
        'konfabulator',
        'sony bravia',
    );

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context)
    {
        $context->setCapability(Capabilities::IS_SMART_TV, true);

        return VisitorInterface::STATE_SEEKING;
    }
} 