<?php

namespace DeviceDetectorIO\DeviceDetector\Device;

/**
 * Class Device.
 */
class Device implements DeviceInterface
{
    /**
     * @var array
     */
    protected $capabilities = [];

    /**
     * @param array $capabilities
     */
    public function __construct(array $capabilities)
    {
        $this->capabilities = $capabilities;
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
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function getCapability($name)
    {
        return isset($this->capabilities[$name]) ? $this->capabilities[$name] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return count($this->capabilities) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->capabilities);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->capabilities = unserialize($serialized);
    }

    /**
     * @param $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        $underscored = strtolower(
            preg_replace(
                '/(?|([a-z\d])([A-Z])|([^\^])([A-Z][a-z]))/',
                '$1_$2',
                $name
            )
        );

        if (substr($underscored, 0, 3) === 'is_') {
            return true === $this->getCapability($underscored);
        }

        if (substr($underscored, 0, 4) === 'get_') {
            return $this->getCapability(substr($underscored, 4));
        }

        throw new \BadMethodCallException(sprintf('Method %s does not exists.', $name));
    }
}
