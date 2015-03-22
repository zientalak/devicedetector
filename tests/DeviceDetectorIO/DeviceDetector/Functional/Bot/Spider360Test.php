<?php

namespace DeviceDetectorIO\DeviceDetector\Tests\Functional\Bot;

use DeviceDetectorIO\DeviceDetector\Tests\TestCase\DeviceDetectorIOFunctionalTestCase;

/**
 * Class Spider360Test
 * @package DeviceDetectorIO\Functional\Bot
 */
class Spider360Test extends DeviceDetectorIOFunctionalTestCase
{
    /**
     * @test
     */
    public function shouldRecognize360SpiderBot()
    {
        $this->assertDeviceContainsCapabilities(
            'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider(compatible; HaosouSpider; http://www.haosou.com/help/help_3_2.html)',
            array(
                'bot_name' => '360Spider',
                'bot_url' => 'http://www.so.com/help/help_3_2.html',
                'bot_vendor_name' => 'Online Media Group, Inc.',
                'is_bot' => true,
                'is_mobile' => false,
                'is_desktop' => false
            )
        );
    }
}
