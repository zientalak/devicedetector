<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Device;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeviceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($this->createCapabilities());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Device\Device');
    }

    function it_implements_device_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Device\DeviceInterface');
    }

    function it_is_valid()
    {
        $this->isValid()->shouldReturn(true);
    }

    function it_is_mobile()
    {
        $this->isMobile()->shouldReturn(true);
        $this->getCapability(Capabilities::IS_MOBILE)->shouldReturn(true);
    }

    function it_is_not_robot()
    {
        $this->isRobot()->shouldReturn(false);
        $this->getCapability(Capabilities::IS_ROBOT)->shouldReturn(null);
    }

    function it_is_windows_os()
    {
        $this->getOS()->shouldReturn(Capabilities::OS_WINDOWS);
        $this->getCapability(Capabilities::OS)->shouldReturn(Capabilities::OS_WINDOWS);
    }

    function it_is_windows8()
    {
        $this->getOSVersion()->shouldReturn('8');
        $this->getCapability(Capabilities::OS_VERSION)->shouldReturn('8');
    }

    function it_has_capability()
    {
        $this->hasCapability(Capabilities::BROWSER)->shouldReturn(true);
        $this->hasCapability(Capabilities::IS_OSX)->shouldReturn(false);
    }

    function it_return_capabilities()
    {
        $this->getCapabilities()->shouldReturn($this->createCapabilities());
    }

    function it_throw_exception()
    {
        $this->shouldThrow('\BadMethodCallException')->during('throwMeNow');
    }

    /**
     * @return array
     */
    protected function createCapabilities()
    {
        return array(
            Capabilities::BROWSER => Capabilities::BROWSER_CHROME,
            Capabilities::IS_MOBILE => true,
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8'
        );
    }
}