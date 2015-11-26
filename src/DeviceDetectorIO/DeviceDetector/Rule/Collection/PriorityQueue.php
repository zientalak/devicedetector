<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Collection;

/**
 * Class PriorityQueue.
 */
class PriorityQueue extends \SplPriorityQueue
{
    /**
     * @param int $priority1
     * @param int $priority2
     *
     * @return int
     */
    public function compare($priority1, $priority2)
    {
        if ($priority1 === $priority2) {
            return 0;
        }

        return $priority1 < $priority2 ? -1 : 1;
    }
}
