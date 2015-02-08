<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class AndroidVisitor extends AbstractPatternVisitor
{
    /**
     * @var array
     */
    private $releasesMap = array(
        '1.0' => 'Alpha',
        '1.1' => 'Beta',
        '1.5' => 'Cupcake',
        '1.6' => 'Donut',
        '2.0' => 'Eclair',
        '2.1' => 'Eclair',
        '2.2' => 'Froyo',
        '2.3' => 'Gingerbread',
        '3.0' => 'Honeycomb',
        '3.1' => 'Honeycomb',
        '3.2' => 'Honeycomb',
        '4.0' => 'Ice Cream Sandwich',
        '4.1' => 'Jelly Bean',
        '4.2' => 'Jelly Bean',
        '4.3' => 'Jelly Bean',
        '4.4' => 'KitKat',
        '5.0' => 'Lollipop'
    );

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches)
    {
        if ($match) {
            $collector
                ->setCapability(Capabilities::OS, Capabilities::OS_ANDROID)
                ->setCapability(Capabilities::OS_VERSION, $matches['version'])
                ->setCapability(Capabilities::OS_VERSION_FULL, $matches['version'])
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_GOOGLE);

            foreach ($this->releasesMap as $releasePattern => $releaseName) {
                if (preg_match(sprintf('#^%s#is', $releasePattern), $matches['version'])) {
                    $collector->setCapability(Capabilities::OS_RELEASE, $releaseName);
                    break;
                }

                if (preg_match(sprintf('#%s#is', $releaseName), $matches['version'])) {
                    $collector->setCapability(Capabilities::OS_RELEASE, $releaseName)
                        ->setCapability(Capabilities::OS_VERSION, $releasePattern)
                        ->setCapability(Capabilities::OS_VERSION_FULL, $releasePattern);
                    break;
                }
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPattern()
    {
        return '#(?:Android|Adr)[\s/](?P<version>[^\s-;]+)#is';
    }
}
