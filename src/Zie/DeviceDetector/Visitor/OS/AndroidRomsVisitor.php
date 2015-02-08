<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidRomsVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class AndroidRomsVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var array
     */
    private $patterns = array(
        '#RazoDroiD v(?P<version>[^\s]*)#is' => 'RazoDroiD',
        '#MildWild(?: CM-(?P<version>\d+[\.\d]*))?#is' => 'MildWild',
        '#CyanogenMod(?:[-/](?:CM)?(?P<version>\d+[\.\d]*))?#is' => 'CyanogenMod',
        '#MocorDroid(?:(?P<version>\d+[\.\d]*))?#is' => 'MocorDroid',
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $userAgent = $token->getData();
        foreach ($this->patterns as $pattern => $name) {
            $matches = array();
            if (preg_match($pattern, $userAgent, $matches)) {
                $collector->setCapability(Capabilities::OS_ROM, $name);
                if (isset($matches['version'])) {
                    $collector->setCapability(Capabilities::OS_ROM_VERSION, $matches['version']);
                }
                break;
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
