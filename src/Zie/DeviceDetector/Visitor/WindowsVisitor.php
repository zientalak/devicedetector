<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class WindowsVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class WindowsVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var array
     */
    protected $patterns = array(
        '#Windows NT 6.3#' => '8.1',
        '#Windows NT 6.2#' => '8',
        '#Windows NT 6.1#' => '7',
        '#Windows NT 6.0#' => 'Vista',
        '#Windows NT 5.2#' => 'Server 2003',
        '#Windows NT 5.1#' => 'XP',
        '#Windows NT 5.01#' => '2000',
        '#Windows NT 5.0#' => '2000',
        '#Windows NT 4.0#' => 'NT 4.0',
        '#Windows 98#' => 'Me',
        '#Win 9x 4.90#' => 'Me',
        '#Windows 98#' => '98',
        '#Windows 95#' => '95',
        '#Windows CE#' => 'CE',
        '#Windows 3.1#' => '3.1',
        '#Win16#' => '3.11'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        $userAgent = $token->getData();
        foreach ($this->patterns as $pattern => $version) {
            if (preg_match($pattern, $userAgent)) {
                $context->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS)
                    ->setCapability(Capabilities::OS_VERSION, $version)
                    ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT)
                    ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_WINDOWS);
                break;
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
} 