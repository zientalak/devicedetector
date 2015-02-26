<?php

namespace DeviceDetectorIO\DeviceDetector\Cache;

class ArrayCache implements CacheInterface
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        return $this->has($id) ? $this->data[$id] : false;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->data[$id]);
    }

    /**
     * {@inheritdoc}
     */
    public function save($id, $data, $lifeTime = 0)
    {
        $this->data[$id] = $data;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        unset($this->data[$id]);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAll()
    {
        $this->data = array();

        return true;
    }
}
