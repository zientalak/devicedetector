<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor\Browser;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor;

class SafariVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();
        if (stripos($userAgent, 'Safari')) {

            $collector->addCapability(Capabilities::BROWSER, Capabilities::BROWSER_SAFARI)
                ->addCapability(Capabilities::BROWSER_VENDOR, Capabilities::VENDOR_APPLE);

            if (preg_match('#Version\/(?P<version>[\.\d]+)#is', $userAgent, $matches)) {
                $collector->addCapability(Capabilities::BROWSER, Capabilities::BROWSER_SAFARI)
                    ->addCapability(Capabilities::BROWSER_VERSION, current(explode(".", $matches['version'])));
            }

        }

        return self::STATE_SEEKING;
    }
}
