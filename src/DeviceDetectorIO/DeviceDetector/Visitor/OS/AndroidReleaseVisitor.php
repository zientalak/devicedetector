<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor\OS;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor;

/**
 * Class AndroidReleaseVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor\OS
 */
class AndroidReleaseVisitor extends AbstractUserAgentVisitor
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
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $isAndroid = Capabilities::OS_ANDROID === $collector->getCapability(Capabilities::OS);
        $osVersion = $collector->getCapability(Capabilities::OS_VERSION);

        if ($isAndroid && $osVersion) {
            foreach ($this->releasesMap as $releasePattern => $releaseName) {
                if (preg_match(sprintf('#^%s#is', $releasePattern), $osVersion)) {
                    $collector->addCapability(Capabilities::OS_RELEASE, $releaseName);
                    break;
                }
                if (preg_match(sprintf('#%s#is', $releaseName), $osVersion)) {
                    $collector->addCapability(Capabilities::OS_RELEASE, $releaseName)
                        ->addCapability(Capabilities::OS_VERSION, $releasePattern);
                    break;
                }
            }
        }

        return self::STATE_SEEKING;
    }
}
