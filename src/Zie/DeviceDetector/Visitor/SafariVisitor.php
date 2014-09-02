<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class SafariVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class SafariVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        $userAgent = $token->getData();
        if (stripos($userAgent, 'Safari')) {
            $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_SAFARI)
                ->setCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_APPLE);

            if (preg_match('#Version\/(?P<version>[\.\d]+)#is', $userAgent, $matches)) {
                $context->setCapability(Capabilities::BROWSER, Capabilities::BROWSER_SAFARI)
                    ->setCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])))
                    ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
} 