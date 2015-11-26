<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Warmer;

use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\DefaultHandler;
use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader\LoaderInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class PHPWarmerSpec.
 */
class PHPWarmerSpec extends ObjectBehavior
{
    public function let(LoaderInterface $loader, HandlerInterface $handler)
    {
        $this->beConstructedWith($loader, $handler);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Warmer\PHPWarmer');
    }

    public function it_implements_warmer_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Warmer\WarmerInterface');
    }

    public function it_warmup_configuration(LoaderInterface $loader)
    {
        $this->beConstructedWith($loader, new DefaultHandler());

        $configuration = [
            [
                'priority' => 0,
                'category' => 'browser',
                'capabilities' => [
                    'browser_name' => 'Chrome',
                ],
                'conditions' => [
                    [
                        'type' => 'text',
                        'value' => 'chrome',
                    ],
                ],
            ],
            [
                'priority' => 1,
                'category' => 'os',
                'capabilities' => [
                    'is_mobile' => true,
                ],
                'conditions' => [
                    [
                        'type' => 'text',
                        'value' => 'mobile',
                    ],
                ],
            ],
            [
                'priority' => 2,
                'category' => 'browser',
                'capabilities' => [
                    'browser_name' => 'Safari',
                ],
                'conditions' => [
                    [
                        'type' => 'regex',
                        'value' => 'safari',
                    ],
                ],
            ],
        ];

        $loader->load()
            ->shouldBeCalled()
            ->willReturn($configuration);

        $this->setPath($this->getFilePath())->shouldReturn($this);

        $this->warmup();
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        return __DIR__.'/../../../../../build/rules.data';
    }
}
