<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder;

use DeviceDetectorIO\DeviceDetector\Rule\Comparer\ComparerInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\Condition;
use DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Rule;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FinderSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder
 */
class FinderSpec extends ObjectBehavior
{
    function let(RepositoryInterface $repository, ComparerInterface $comparer)
    {
        $this->beConstructedWith($repository, $comparer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder\Finder');
    }

    function it_implements_finder_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder\FinderInterface');
    }

    function it_find_occurrences(RepositoryInterface $repository, ComparerInterface $comparer, UserAgentTokenizedToken $token, Rule $rule)
    {
        $this->beConstructedWith($repository, $comparer);

        $node1 = new Node('chrome', 0, Node::TYPE_TEXT);
        $node2 = new Node('/', 1, Node::TYPE_TEXT);
        $node3 = new Node('12.05b', 2, Node::TYPE_TEXT);

        $token->getData()
            ->shouldBeCalled()
            ->willReturn(array(
                $node1,
                $node2,
                $node3
            ));

        $condition = new Condition();
        $condition->setPosition(0);

        $conditions = new \ArrayIterator(array(
            $condition
        ));

        $rule->getConditions()
            ->shouldBeCalled()
            ->willReturn($conditions);

        $repository->getIndexableRulesByUserAgentToken(Argument::exact($token->getWrappedObject()))
            ->shouldBeCalled()
            ->willReturn(array(
                $rule
            ));

        $comparer->areEquals(Argument::exact($node1), Argument::exact($condition))
            ->shouldBeCalled()
            ->willReturn(true);

        $comparer->areEquals(Argument::exact($node2), Argument::exact($condition))
            ->shouldBeCalled()
            ->willReturn(false);

        $comparer->areEquals(Argument::exact($node3), Argument::exact($condition))
            ->shouldBeCalled()
            ->willReturn(true);

        $occurrences = $this->find($token);
        $occurrences->shouldBeAnInstanceOf('DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrences');

        $firstOccurrences = $occurrences->getFirstOccurrences();
        $firstOccurrences->shouldHaveCount(2);
    }
}
