<?php

namespace Zie\DeviceDetector\Visitor\Browser;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AmigaBrowserVisitor
 * @package Zie\DeviceDetector\Visitor\Browser
 */
class AmigaBrowserVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var array
     */
    private $patterns = array(
        '#(?P<browser>Amiga-AWeb)[\s/](?P<version>[^\s\()]*)#is',
        '#(?P<browser>AmigaVoyager)[\s/](?P<version>[^\s\()]*)#is'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();
        foreach ($this->patterns as $pattern) {
            $matches = array();
            if (preg_match($pattern, $userAgent, $matches)) {
                $collector->setCapability(Capabilities::BROWSER, $matches['browser']);
                if (isset($matches['version'])) {
                    $collector->setCapability(Capabilities::BROWSER_VERSION, $matches['version'])
                        ->setCapability(Capabilities::BROWSER_VERSION_FULL, $matches['version']);
                }
                break;
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
