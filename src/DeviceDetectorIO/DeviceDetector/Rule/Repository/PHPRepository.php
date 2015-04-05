<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Repository;

use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Class PHPRepository
 * @package DeviceDetectorIO\DeviceDetector\Repository
 */
class PHPRepository implements RepositoryInterface
{
    /**
     * @var array
     */
    private $rules = array();

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * {@inheritdoc}
     */
    public function getIndexableRulesByUserAgentToken(UserAgentTokenizedToken $token)
    {
        $this->loadRules();

        $rules = new \SplObjectStorage();

        /** @var NodeInterface $node */
        foreach ($token->getData() as $node) {
            if (isset($this->rules['indexable'][$node->getValue()][0])) {
                foreach ($this->rules['indexable'][$node->getValue()][0] as $rule) {
                    if (!$rules->contains($rule)) {
                        $rules->attach($rule);
                    }
                }
            }
        }

        $rules->rewind();

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function getNonIndexableRules()
    {
        $this->loadRules();

        $storage = new \SplObjectStorage();

        foreach ($this->rules['nonindexable'] as $rule) {
            $storage->attach($rule);
        }

        $storage->rewind();

        return $storage;
    }

    /**
     * @param string $filePath
     * @return self
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        $this->loaded = false;
        $this->rules = new \ArrayIterator();

        return $this;
    }

    /**
     * @return void
     * @throws \LogicException
     */
    protected function loadRules()
    {
        if (!$this->loaded) {
            if (!is_file($this->filePath)) {
                throw new \LogicException(sprintf('File "%s" does not exists.', $this->filePath));
            }

            $this->rules = unserialize(file_get_contents($this->filePath));
            $this->loaded = true;
        }
    }
}
