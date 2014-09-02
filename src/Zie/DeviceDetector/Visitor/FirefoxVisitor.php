<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class FirefoxVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class FirefoxVisitor extends AbstractPatternVisitor
{
    /**
     * @var string
     */
    protected $pattern = '#Firefox\/(?P<version>[^\s]+)#is';

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        if ($match) {
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_FIREFOX)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_MOZILLA)
                ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
