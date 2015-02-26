<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Collector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CollectorSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Collector
 */
class CollectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Collector\Collector');
    }

    function it_is_a_collector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface');
    }

    function it_add_capability()
    {
        $this->hasCapability('capability1')->shouldReturn(false);
        $this->addCapability('capability1', 'capability1')->shouldReturn($this);
        $this->hasCapability('capability1')->shouldReturn(true);
    }

    function it_get_capabilities()
    {
        $capabilities = array(
            'capability1' => 'capability1',
            'capability2' => 'capability2'
        );

        $this->getCapabilities()->shouldReturn(array());
        $this->setCapabilities($capabilities)->shouldReturn($this);
        $this->getCapabilities()->shouldEqual($capabilities);
    }

    function it_get_capability()
    {
        $this->addCapability('capability1', 'capability1')->shouldReturn($this);
        $this->getCapability('capability1')->shouldReturn('capability1');
    }

    function it_remove_capability()
    {
        $this->addCapability('capability1', 'capability1')->shouldReturn($this);
        $this->hasCapability('capability1')->shouldReturn(true);
        $this->removeCapability('capability1')->shouldReturn($this);
    }

    function it_clear_capability()
    {
        $capabilities = array(
            'capability1' => 'capability1',
            'capability2' => 'capability2'
        );

        $this->setCapabilities($capabilities)->shouldReturn($this);
        $this->clear()->shouldReturn($this);
        $this->getCapabilities()->shouldEqual(array());
    }

    function it_merge_capabilities()
    {
        $capabilities = array(
            'capability1' => 'capability1',
            'capability2' => 'capability2'
        );

        $this->setCapabilities($capabilities);
        $this->getCapabilities()->shouldEqual($capabilities);

        $capabilities = array(
            'capability1' => 'capability1',
            'capability3' => 'capability3'
        );

        $this->mergeCapabilities($capabilities)->shouldReturn($this);
        $this->getCapabilities()->shouldEqual(array(
            'capability1' => 'capability1',
            'capability2' => 'capability2',
            'capability3' => 'capability3'
        ));
    }
}
