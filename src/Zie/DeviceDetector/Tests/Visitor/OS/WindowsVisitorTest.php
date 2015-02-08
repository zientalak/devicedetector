<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\WindowsVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class WindowsVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class WindowsVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeWindows10()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36 Edge/12.0'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitor should set recognize Windows.'
        );

        $this->assertSame(
            '10',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitor should set recognize Windows version.'
        );

        $this->assertSame(
            '10',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitor should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitor should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows81()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (IE 11.0; Windows NT 6.3; Trident/7.0; .NET4.0E; .NET4.0C; rv:11.0) like Gecko'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '8.1',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '8.1',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows80()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.15 (KHTML, like Gecko) Chrome/24.0.1295.0 Safari/537.15'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '8',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '8',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows7()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows; U; Windows NT 6.1; sk; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '7',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '7',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsVista()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 3.5.21022; .NET CLR 3.5.30729; MS-RTC LM 8; OfficeLiveConnector.1.4; OfficeLivePatch.1.3; .NET CLR 3.0.30729)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            'Vista',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            'Vista',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsServer2003()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.2; WOW64; Trident/4.0; uZard/1.0; Server_KO_SKT)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            'Server 2003',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            'Server 2003',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsXP()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; cs; rv:1.9.1.8) Gecko/20100202 Firefox/3.5.8'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            'XP',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            'XP',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows2000()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0; SV1; .NET CLR 1.1.4322; .NET CLR 1.0.3705; .NET CLR 2.0.50727)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '2000',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '2000',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsNT40()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 4; SV1)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            'NT 4.0',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            'NT 4.0',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsME()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows; U; Win 9x 4.90; de-DE; rv:0.9.4.1) Gecko/20020314 Netscape6/6.2.2'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            'Me',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            'Me',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows98()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 4.01; Windows 98)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '98',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '98',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows95()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/4.0 (compatible; MSIE 5.5; AOL 6.0; Windows 95)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '95',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '95',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindowsCE()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Windows; U; Windows CE 5.1; rv:1.8.1a3) Gecko/20060610 Minimo/0.016'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            'CE',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            'CE',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * @test
     */
    public function recognizeWindows31()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'NCSA_Mosaic/2.0 (Windows 3.1)'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'WindowsVisitorTest should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_WINDOWS,
            $collector->getCapability(Capabilities::OS),
            'WindowsVisitorTest should set recognize Windows.'
        );

        $this->assertSame(
            '3.1',
            $collector->getCapability(Capabilities::OS_VERSION),
            'WindowsVisitorTest should set recognize Windows version.'
        );

        $this->assertSame(
            '3.1',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'WindowsVisitorTest should set recognize Windows full version.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_WINDOWS,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'WindowsVisitorTest should set recognize Windows family.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new WindowsVisitor();
    }
}
