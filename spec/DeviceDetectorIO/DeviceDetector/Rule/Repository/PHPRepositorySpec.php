<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Repository;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\Node;
use PhpSpec\ObjectBehavior;

/**
 * Class PHPRepositorySpec.
 */
class PHPRepositorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->setFilePath($this->getFilePath())->shouldReturn($this);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Repository\PHPRepository');
    }

    public function it_implements_repository_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface');
    }

    public function it_return_indexable_rules(UserAgentTokenizedToken $token)
    {
        $node = new Node('chrome', 0, Node::TYPE_TEXT);

        $token->getData()
            ->shouldBeCalled()
            ->willReturn([
                $node,
            ]);

        $this->getIndexableRulesByUserAgentToken($token)
            ->shouldBeAnInstanceOf('\Iterator');
    }

    public function it_return_non_indexable_rules()
    {
        $this->getNonIndexableRules()
            ->shouldBeAnInstanceOf('\Iterator');
    }

    public function it_throw_exception_if_filepath_not_exists()
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
