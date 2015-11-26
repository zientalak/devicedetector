<?php

namespace DeviceDetectorIO\DeviceDetector\UserAgent;

/**
 * Class Node.
 */
class Node implements NodeInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var int
     */
    protected $type;

    /**
     * @param string $value
     * @param int    $position
     * @param int    $type
     */
    public function __construct($value, $position, $type = self::TYPE_TEXT)
    {
        $this->value = $value;
        $this->type = (int) $type;
        $this->position = (int) $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function isType($type)
    {
        return $type === $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            'value' => $this->value,
            'position' => $this->position,
            'type' => $this->type,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->value = $data['value'];
        $this->position = $data['position'];
        $this->type = $data['type'];
    }
}
