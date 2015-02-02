<?php

namespace Zie\DeviceDetector\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

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
        '#CYGWIN_NT-10.0|CYGWIN_NT-6.4|Windows NT 6.4|Windows NT 10.0|Windows 10#' => '10',
        '#CYGWIN_NT-6.3|Windows NT 6.3|Windows 8.1#' => '8.1',
        '#CYGWIN_NT-6.2|Windows NT 6.2|Windows 8#' => '8',
        '#CYGWIN_NT-6.1|Windows NT 6.1|Windows 7#' => '7',
        '#CYGWIN_NT-6.0|Windows NT 6.0|Windows Vista#' => 'Vista',
        '#CYGWIN_NT-5.2|Windows NT 5.2|Windows Server 2003 / XP x64#' => 'Server 2003',
        '#CYGWIN_NT-5.1|Windows NT 5.1|Windows XP#' => 'XP',
        '#CYGWIN_NT-5.0|Windows NT 5.0|Windows 2000#' => '2000',
        '#CYGWIN_NT-4.0|Windows NT 4.0|WinNT|Windows NT#' => 'NT 4.0',
        '#CYGWIN_ME-4.90|Win 9x 4.90|Windows ME#' => 'Me',
        '#CYGWIN_98-4.10|Win98|Windows 98#' => '98',
        '#CYGWIN_95-4.0|Win32|Win95|Windows 95|Windows_95#' => '95',
        '#Windows CE#' => 'CE',
        '#Windows 3.1#' => '3.1',
        '#Win16#' => '3.11'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        $userAgent = $token->getData();
        foreach ($this->patterns as $pattern => $version) {
            if (preg_match($pattern, $userAgent)) {
                $context->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS)
                    ->setCapability(Capabilities::OS_VERSION, $version)
                    ->setCapability(Capabilities::OS_VERSION_FULL, $version)
                    ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT)
                    ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_WINDOWS);
                break;
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
