<?php

namespace DeviceDetectorIO\DeviceDetector\Capability;

/**
 * Class Collector
 * @package DeviceDetectorIO\DeviceDetector\Capability
 */
class Collator implements CollatorInterface
{
    /**
     * @var array
     */
    private $capabilities = array();

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        return $this->has($name) ? $this->capabilities[$name] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->capabilities[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function set($name, $value)
    {
        $this->capabilities[$name] = $value;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function setAll(array $capabilities)
    {
        $this->capabilities = $capabilities;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(array $capabilities)
    {
        $this->capabilities = array_merge($this->capabilities, $capabilities);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($name)
    {
        if ($this->has($name)) {
            unset($this->capabilities[$name]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll()
    {
        $this->setAll(array());

        return true;
    }
}
