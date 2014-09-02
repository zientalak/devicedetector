<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class OperaMiniVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class OperaMiniVisitor extends AbstractPatternVisitor
{
    /**
     * @var string
     */
    protected $pattern = '#Opera Mini[ /]?(?P<version>[^\s/]+)#is';

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        if ($match) {
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_OPERA_MINI)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_OPERA)
                ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
