<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Warmer;

use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\DefaultHandler;
use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader\LoaderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PHPWarmerSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Warmer
 */
class PHPWarmerSpec extends ObjectBehavior
{
    function let(LoaderInterface $loader, HandlerInterface $handler)
    {
        $this->beConstructedWith($loader, $handler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Warmer\PHPWarmer');
    }

    function it_implements_warmer_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Warmer\WarmerInterface');
    }

    function it_warmup_configuration(LoaderInterface $loader)
    {
        $this->beConstructedWith($loader, new DefaultHandler());

        $configuration = array(
            array(
                'priority' => 0,
                'category' => 'browser',
                'capabilities' => array(
                    'browser_name' => 'Chrome'
                ),
                'conditions' => array(
                    array(
                        'type' => 'text',
                        'value' => 'chrome'
                    )
                )
            ),
            array(
                'priority' => 1,
                'category' => 'os',
                'capabilities' => array(
                    'is_mobile' => true
                ),
                'conditions' => array(
                    array(
                        'type' => 'text',
                        'value' => 'mobile'
                    )
                )
            ),
            array(
                'priority' => 2,
                'category' => 'browser',
                'capabilities' => array(
                    'browser_name' => 'Safari'
                ),
                'conditions' => array(
                    array(
                        'type' => 'regex',
                        'value' => 'safari'
                    )
                )
            ),
        );

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
