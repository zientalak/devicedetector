<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class MsieVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class MsieVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        $userAgent = $token->getData();
        $matches = array();
        if (!preg_match('#Opera|armv|MOTO|BREW#is', $userAgent) && preg_match(
                '#msie[ /]?(?P<version>[^\s/;]+)#is',
                $userAgent,
                $matches
            )
        ) {
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_IE)
                ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version'])
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_MICROSOFT);
        }

        // IE 11
        if (stripos($userAgent, 'Trident')) {
            if (preg_match('#rv:(?P<version>[\.\d]+)#is', $userAgent, $matches)) {
                $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_IE)
                    ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                    ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version'])
                    ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_MICROSOFT);
            }
        }
    }

} 