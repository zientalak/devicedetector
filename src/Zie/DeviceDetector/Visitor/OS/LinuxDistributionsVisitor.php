<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternsVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

class LinuxDistributionsVisitor extends AbstractPatternsVisitor
{
    /**
     * {@inheritDoc}
     */
    protected function getPatterns()
    {
        return array(
            '#(?P<distribution>Arch\s?Linux)#is',
            '#(?P<distribution>VectorLinux)(?: package)?(?:[ /\-](?P<version>[^\s+\)\(]+))#is',
            '#Linux; .*((?P<distribution>Debian|Knoppix|Mint|Ubuntu|Kubuntu|Xubuntu|Lubuntu|Fedora|Red Hat|Mandriva|Gentoo|Sabayon|Slackware|SUSE|CentOS|BackTrack))[ /](?P<version>[\d+\.]+)#is',
            '#(?P<distribution>Debian|Knoppix|Mint|Ubuntu|Kubuntu|Xubuntu|Lubuntu|Fedora|Red Hat|Mandriva|Gentoo|Sabayon|Slackware|SUSE|CentOS|BackTrack)(?:(?: Enterprise)? Linux)?(?:[ /\-](?P<version>[\d+\.]+))?#is'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, array $matches)
    {
        $collector->setCapability(Capabilities::OS, $matches['distribution'])
            ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_LINUX);

        if (isset($matches['version'])) {
            $collector->setCapability(Capabilities::OS_VERSION, $matches['version'])
                ->setCapability(Capabilities::OS_VERSION_FULL, $matches['version']);
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
