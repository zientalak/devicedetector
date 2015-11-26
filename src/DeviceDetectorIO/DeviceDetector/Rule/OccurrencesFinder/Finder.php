<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Comparer\ComparerInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrence;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrences;
use DeviceDetectorIO\DeviceDetector\Rule\Repository\RepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Class OccurrencesFinder.
 */
class Finder implements FinderInterface
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var ComparerInterface
     */
    private $comparer;

    /**
     * @param RepositoryInterface $repository
     * @param ComparerInterface   $comparer
     */
    public function __construct(RepositoryInterface $repository, ComparerInterface $comparer)
    {
        $this->repository = $repository;
        $this->comparer = $comparer;
    }

    /**
     * {@inheritdoc}
     */
    public function find(UserAgentTokenizedToken $token)
    {
        $nodes = $token->getData();
        $rules = $this->repository->getIndexableRulesByUserAgentToken($token);

        $occurences = new Occurrences();

        /** @var RuleInterface $rule */
        foreach ($rules as $rule) {
            /** @var NodeInterface $node */
            foreach ($nodes as $node) {
                $conditions = $rule->getConditions();
                $conditions->rewind();

                /** @var ConditionInterface $condition */
                foreach ($conditions as $condition) {
                    if ($this->comparer->areEquals($node, $condition)) {
                        $occurences->add(new Occurrence($rule, $condition, $node));
                    }
                }
            }
        }

        return $occurences;
    }
}
