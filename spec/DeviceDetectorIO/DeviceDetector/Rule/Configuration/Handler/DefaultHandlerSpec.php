<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DefaultHandlerSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler
 */
class DefaultHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\DefaultHandler');
    }

    function it_implements_handler_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerInterface');
    }

    function it_handle_configuration(RuleInterface $rule)
    {
        $configuration = array(
            'priority' => 1,
            'category' => 'browser',
            'capabilities' => array(
                'is_bot' => true
            ),
            'conditions' => array(
                array(
                    'type' => 'text',
                    'value' => 'chrome',
                    'strategy' => 'sequence',
                    'capabilities' => array(
                        'is_modile' => true
                    )
                )
            )
        );

        $rule->setPriority(Argument::exact($configuration['priority']))
            ->shouldBeCalled();

        $rule->setCategory(Argument::exact($configuration['category']))
            ->shouldBeCalled();

        $rule->setCapabilities(Argument::exact($configuration['capabilities']))
            ->shouldBeCalled();

        $rule->addCondition(Argument::type('DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface'))
            ->shouldBeCalled();

        $this->handle($configuration, $rule);
    }
}
