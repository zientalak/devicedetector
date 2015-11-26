<?php

namespace DeviceDetectorIO\DeviceDetector\Cache;

/**
 * Interface CacheInterface.
 */
interface CacheInterface
{
    const LIFETIME_DAY = 86400;

    /**
     * Fetch an entry from the cache.
     *
     * @param string $id
     *
     * @return mixed|false
     */
    public function get($id);

    /**
     * Tests if an entry exists in the cache.
     *
     * @param string $id
     *
     * @return bool
     */
    public function has($id);

    /**
     * Puts data into the cache.
     *
     * @param string $id       The cache id.
     * @param mixed  $data     The cache entry/data.
     * @param int    $lifeTime The cache lifetime.
     *                         If != 0, sets a specific lifetime for this cache entry (0 => infinite lifeTime).
     *
     * @return bool TRUE if the entry was successfully stored in the cache, FALSE otherwise.
     */
    public function save($id, $data, $lifeTime = 0);

    /**
     * Deletes a cache entry.
     *
     * @param string $id The cache id.
     *
     * @return bool TRUE if the cache entry was successfully deleted, FALSE otherwise.
     */
    public function delete($id);

    /**
     * Deletes all cache entries.
     *
     * @return bool TRUE if the cache entries were successfully deleted, FALSE otherwise.
     */
    public function deleteAll();
}
