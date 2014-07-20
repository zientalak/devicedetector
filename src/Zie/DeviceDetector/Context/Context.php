<?php

namespace Zie\DeviceDetector\Context;

/**
 * Class Context
 * @package Zie\DeviceDetector\Context
 */
class Context implements ContextInterface
{
    /**
     * @var array
     */
    private $capabilities = array();

    /**
     * {@inheritdoc}
     */
    public function getCapability($name)
    {
        return isset($this->capabilities[$name]) ? $this->capabilities[$name] : false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCapability($name)
    {
        return isset($this->capabilities[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function setCapability($name, $value)
    {
        $this->capabilities[(string)$name] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function setCapabilities(array $capabilities)
    {
        $this->capabilities = $capabilities;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->setCapabilities(array());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeCapability($name)
    {
        if($this->hasCapability($name)){
            unset($this->capabilities[$name]);
        }

        return $this;
    }

} 