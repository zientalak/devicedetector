<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Warmer;

use DeviceDetectorIO\DeviceDetector\Rule\Collection\PriorityQueue;
use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;

/**
 * Class PHPWarmer
 * @package DeviceDetectorIO\DeviceDetector\Rule\Warmer
 */
class PHPWarmer extends AbstractWarmer
{
    /**
     * @var array
     */
    private $indexableRules = array();

    /**
     * @var array
     */
    private $nonIndexableRules = array();

    /**
     * @var string
     */
    private $path;

    /**
     * @param $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function warmup()
    {
        $this->prepareRules();

        $destination = new \SplFileObject($this->path, 'w');
        $destination->ftruncate($destination->getSize());
        $destination->fwrite("<?php\n");
        $destination->fwrite(
            'return '.var_export(
                array(
                    'indexable' => $this->indexableRules,
                    'nonindexable' => $this->nonIndexableRules
                ),
                true
            ).';'
        );
    }

    /**
     * @return PriorityQueue
     */
    protected function prepareRules()
    {
        $this->indexableRules = array();
        $this->nonIndexableRules = array();

        /** @var RuleInterface $rule */
        foreach (parent::prepareRules() as $rule) {
            $conditions = $rule->getConditions();
            $conditions->rewind();
            /** @var ConditionInterface $condition */
            $condition = $conditions->current();

            if ($this->isIndexableRule($condition)) {
                $this->indexableRules[$condition->getValue()][0][] = serialize($rule);
                continue;
            }

            $this->nonIndexableRules[] = serialize($rule);
        }
    }

    /**
     * @param ConditionInterface $condition
     * @return bool
     */
    private function isIndexableRule(ConditionInterface $condition)
    {
        return $condition->isType(ConditionInterface::TYPE_TEXT)
        || $condition->isType(ConditionInterface::TYPE_PLACEHOLDER)
        || $condition->isType(ConditionInterface::TYPE_SPACE);
    }
}
