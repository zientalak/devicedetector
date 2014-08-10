<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class OperaVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class OperaVisitor extends AbstractPatternVisitor
{
    /**
     * @var string
     */
    protected $pattern = '#Opera[ /]?(?P<version>\d+\.\d+)#is';

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        if($match){
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_OPERA)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::BROWSER_VENDOR_OPERA)
                ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
