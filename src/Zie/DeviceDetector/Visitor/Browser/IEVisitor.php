<?php

namespace Zie\DeviceDetector\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IEVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class IEVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();
        $matches = array();
        $isExcluded = preg_match('#Opera|armv|MOTO|BREW#is', $userAgent);
        if (!$isExcluded
            && preg_match(
                '#msie[ /]?(?P<version>[^\s/;]+)#is',
                $userAgent,
                $matches
            )
        ) {
            $collector->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_IE)
                ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version'])
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_MICROSOFT);
        }

        // IE 11
        if (stripos($userAgent, 'Trident')) {
            if (preg_match('#rv:(?P<version>[\.\d]+)#is', $userAgent, $matches)) {
                $collector->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_IE)
                    ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                    ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version'])
                    ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_MICROSOFT);
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
