<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AndroidVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class AndroidVisitor extends AbstractPatternVisitor
{
    const DEFAULT_VERSION = '2.0';

    /**
     * @var string
     */
    protected $pattern = '#Android[\s/](?P<version>[^\s;]+)#is';

    /**
     * @var array
     */
    private $validVersions = array(
        '1.0',
        '1.5',
        '1.6',
        '2.0',
        '2.1',
        '2.2',
        '2.3',
        '2.4',
        '3.0',
        '3.1',
        '3.2',
        '3.3',
        '4.0',
        '4.1',
        '4.2',
        '4.3',
        '4.4',
        '5.0'
    );

    /**
     * @var array
     */
    public $releasesMap = array(
        '1.5' => 'Cupcake',
        '1.6' => 'Donut',
        '2.1' => 'Eclair',
        '2.2' => 'Froyo',
        '2.3' => 'Gingerbread',
        '3.0' => 'Honeycomb',
        '4.0' => 'Ice Cream Sandwich',
        '4.1' => 'Jelly Bean',
        '4.4' => 'KitKat',
    );

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        $context->setCapability(Capabilities::IS_ANDROID, $match);
        if ($match) {
            $version = $this->getValidVersion($matches['version']);
            $context->setCapability(Capabilities::OS, Capabilities::OS_ANDROID)
                ->setCapability(Capabilities::OS_VERSION, $version)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::OS_VENDOR_GOOGLE);
            
            if (isset($this->releasesMap[$version])) {
                $context->setCapability(Capabilities::OS_RELEASE, $this->releasesMap[$version]);
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @param $version
     * @return string
     */
    private function getValidVersion($version)
    {
        return in_array($version, $this->validVersions) ? $version : self::DEFAULT_VERSION;
    }
} 