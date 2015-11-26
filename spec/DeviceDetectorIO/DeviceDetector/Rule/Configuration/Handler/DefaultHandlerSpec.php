<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DefaultHandlerSpec.
 */
class DefaultHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\DefaultHandler');
    }

    public function it_implements_handler_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerInterface');
    }

    public function it_handle_configuration(RuleInterface $rule)
    {
        $configuration = [
            'priority' => 1,
            'category' => 'browser',
            'capabilities' => [
                'is_bot' => true,
            ],
            'conditions' => [
                [
                    'type' => 'text',
                    'value' => 'chrome',
                    'strategy' => 'sequence',
                    'capabilities' => [
                        'is_modile' => true,
                    ],
                ],
            ],
        ];

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
