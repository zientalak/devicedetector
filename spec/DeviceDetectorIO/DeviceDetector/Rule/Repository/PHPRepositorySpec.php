<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Repository;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PHPRepositorySpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Repository
 */
class PHPRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->setFilePath($this->getFilePath())->shouldReturn($this);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Repository\PHPRepository');
    }

    function it_implements_repository_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface');
    }

    function it_return_indexable_rules(UserAgentTokenizedToken $token)
    {
        $node = new Node('chrome', Node::TYPE_TEXT, 0);

        $token->getData()
            ->shouldBeCalled()
            ->willReturn(array(
                $node
            ));

        $this->getIndexableRulesByUserAgentToken($token)
            ->shouldBeAnInstanceOf('\Iterator');
    }

    function it_return_non_indexable_rules()
    {
        $this->getNonIndexableRules()
            ->shouldBeAnInstanceOf('\Iterator');
    }

    function it_throw_exception_if_filepath_not_exists()
    {
        $this->setFilePath(__DIR__.'/rules.data');

        $this->shouldThrow('\LogicException')->during('getNonIndexableRules');
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        return __DIR__.'/../../../../../resources/rules/php/rules.data';
    }
}
