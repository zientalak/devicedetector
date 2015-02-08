<?php

namespace Zie\DeviceDetector\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class SafariVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class SafariVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();
        if (stripos($userAgent, 'Safari')) {
            $collector->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_SAFARI)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_APPLE);

            if (preg_match('#Version\/(?P<version>[\.\d]+)#is', $userAgent, $matches)) {
                $collector->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_SAFARI)
                    ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                    ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
