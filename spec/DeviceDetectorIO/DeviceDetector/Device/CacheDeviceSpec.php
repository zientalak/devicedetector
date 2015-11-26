<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Device;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use PhpSpec\ObjectBehavior;

/**
 * Class CacheDeviceSpec.
 */
class CacheDeviceSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(new Device($this->createCapabilities()), sha1(1));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Device\CacheDevice');
    }

    public function it_implements_device_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Device\DeviceInterface');
    }

    public function it_is_valid()
    {
        $this->isValid()->shouldReturn(true);
    }

    public function it_has_capability()
    {
        $this->hasCapability(Capabilities::BROWSER)->shouldReturn(true);
        $this->hasCapability(Capabilities::IS_OSX)->shouldReturn(false);
    }

    public function it_return_capabilities()
    {
        $this->isMobile()->shouldReturn(true);
        $this->getCapability(Capabilities::IS_MOBILE)->shouldReturn(true);

        $this->isRobot()->shouldReturn(false);
        $this->getCapability(Capabilities::IS_BOT)->shouldReturn(null);

        $this->getOS()->shouldReturn(Capabilities::OS_WINDOWS);
        $this->getCapability(Capabilities::OS)->shouldReturn(Capabilities::OS_WINDOWS);

        $this->getOSVersion()->shouldReturn('8');
        $this->getCapability(Capabilities::OS_VERSION)->shouldReturn('8');

        $this->getCapabilities()->shouldReturn($this->createCapabilities());

        $this->getCapabilities()->shouldReturn($this->createCapabilities());
    }

    public function it_throw_exception()
    {
        $this->shouldThrow('\BadMethodCallException')->during('throwMeNow');
    }

    public function it_return_fingerprint()
    {
        $this->getFingerprint()->shouldReturn(sha1(1));
    }

    public function it_is_serializable()
    {
        $this->serialize()->shouldReturn(
            serialize(
                [
                    'fingerprint' => sha1(1),
                    'device' => new Device($this->createCapabilities()),
                ]
            )
        );

        $data = [
            'fingerprint' => sha1(2),
            'device' => new Device([Capabilities::BROWSER => Capabilities::BROWSER_CHROME]),
        ];
        $this->unserialize(serialize($data));
        $this->getCapabilities()->shouldReturn([Capabilities::BROWSER => Capabilities::BROWSER_CHROME]);
        $this->getFingerprint()->shouldReturn($data['fingerprint']);
    }

    /**
     * @return array
     */
    protected function createCapabilities()
    {
        return [
            Capabilities::BROWSER => Capabilities::BROWSER_CHROME,
            Capabilities::IS_MOBILE => true,
            Capabilities::OS => Capabilities::OS_WINDOWS,
            Capabilities::OS_VERSION => '8',
        ];
    }
}
