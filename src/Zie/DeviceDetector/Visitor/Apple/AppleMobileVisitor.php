<?php

namespace Zie\DeviceDetector\Visitor\Apple;

use Symfony\Component\VarDumper\VarDumper;
use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AppleMobileVisitor
 * @package Zie\DeviceDetector\Visitor\Apple
 */
abstract class AppleMobileVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        if (preg_match($this->getDevicePattern(), $token->getData())) {

            $collector
                ->setCapability(Capabilities::IS_IOS, true)
                ->setCapability(Capabilities::OS, Capabilities::OS_IOS)
                ->setCapability(Capabilities::BRAND_NAME, $this->getBrandName());

            $versionPattern = sprintf(
                '#%s (OS )?(?J)(?P<version>[\d+\.\_\-]+)|(?P<version>[\d+\.\_\-]+) like Mac OS X#',
                $this->getBrandName()
            );

            $matches = array();
            if (preg_match($versionPattern, $token->getData(), $matches)) {
                if (isset($matches['version'])) {
                    $matches['version'] = preg_replace('#[^\d+\.]#', '.', $matches['version']);
                    $collector
                        ->setCapability(Capabilities::OS_VERSION, $matches['version'])
                        ->setCapability(Capabilities::OS_VERSION_FULL, $matches['version']);
                }
            }

            foreach ($this->getDeviceVersionsPatterns() as $pattern => $name) {
                if (preg_match(sprintf('#%s#is', $pattern), $token->getData())) {
                    $collector->setCapability(Capabilities::BRAND_NAME_FULL, $name);
                    break;
                }
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @return string
     */
    abstract protected function getDevicePattern();

    /**
     * @return array
     */
    abstract protected function getDeviceVersionsPatterns();

    /**
     * @return string
     */
    abstract protected function getBrandName();
}
