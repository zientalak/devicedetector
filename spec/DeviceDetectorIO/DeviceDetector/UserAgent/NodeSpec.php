<?php

namespace spec\DeviceDetectorIO\DeviceDetector\UserAgent;

use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class NodeSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\UserAgent
 */
class NodeSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('mozilla', NodeInterface::TYPE_TEXT, 1);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\UserAgent\Node');
    }

    function it_implements_node_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface');
    }

    function it_return_expected_values()
    {
        $this->getValue()->shouldReturn('mozilla');
        $this->getType()->shouldReturn(NodeInterface::TYPE_TEXT);
        $this->getPosition()->shouldReturn(1);
        $this->isType(NodeInterface::TYPE_TEXT)->shouldReturn(true);
        $this->isType(NodeInterface::TYPE_SPACE)->shouldReturn(false);
    }

    function it_is_serializable()
    {
        $this->serialize()->shouldReturn(
            serialize(
                array(
                    'value' => 'mozilla',
                    'position' => 1,
                    'type' => NodeInterface::TYPE_TEXT
                )
            )
        );

        $data = array(
            'value' => 'chrome',
            'position' => 10,
            'type' => NodeInterface::TYPE_SPACE
        );

        $this->unserialize(serialize($data));

        $this->getValue()->shouldReturn('chrome');
        $this->getType()->shouldReturn(NodeInterface::TYPE_SPACE);
        $this->getPosition()->shouldReturn(10);
        $this->isType(NodeInterface::TYPE_TEXT)->shouldReturn(false);
        $this->isType(NodeInterface::TYPE_SPACE)->shouldReturn(true);
    }
}
