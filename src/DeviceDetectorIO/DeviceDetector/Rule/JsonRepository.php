<?php

namespace DeviceDetectorIO\DeviceDetector\Rule;

/**
 * Class JsonRepository
 * @package DeviceDetectorIO\DeviceDetector\Rule
 */
class JsonRepository implements RuleRepositoryInterface
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
    public function getRules()
    {
        $this->loadRules();

        return $this->rules;
    }

    /**
     * @param string $filePath
     * @return self
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        $this->loaded = false;
        $this->rules = array();

        return $this;
    }

    /**
     * @return self
     */
    protected function loadRules()
    {
        if (!$this->loaded) {
            if (!is_file($this->filePath)) {
                throw new \LogicException(sprintf('File "%s" does not exists.', $this->filePath));
            }

            $this->rules = json_decode(file_get_contents($this->filePath), true);
            $this->loaded = true;
        }

        return $this;
    }
}
