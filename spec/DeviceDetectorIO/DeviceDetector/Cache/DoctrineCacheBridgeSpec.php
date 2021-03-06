<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Cache;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\Cache;

/**
 * Class DoctrineCacheBridgeSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Cache
 */
class DoctrineCacheBridgeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new ArrayCache());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Cache\DoctrineCacheBridge');
    }

    function it_implements_cache_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Cache\CacheInterface');
    }

    function it_save_element()
    {
        $id = sha1(get_class());
        $value = time();

        $this->get($id)->shouldReturn(false);
        $this->save($id, $value)->shouldReturn(true);

        $this->get($id)->shouldReturn($value);
    }

    function it_has_element()
    {
        $id = sha1(get_class());
        $value = time();

        $this->has($id)->shouldReturn(false);
        $this->save($id, $value);

        $this->has($id)->shouldReturn(true);
    }

    function it_delete_element()
    {
        $id = sha1(get_class());
        $value = time();

        $this->has($id)->shouldReturn(false);
        $this->save($id, $value);
        $this->has($id)->shouldReturn(true);

        $this->delete($id)->shouldReturn(true);
        $this->has($id)->shouldReturn(false);
    }

    function it_delete_all_elements()
    {
        $id1 = sha1(1);
        $id2 = sha1(1);

        $this->save($id1, 1);
        $this->save($id2, 2);

        $this->deleteAll()->shouldReturn(true);
        $this->has($id1)->shouldReturn(false);
        $this->has($id2)->shouldReturn(false);
    }

    function it_not_delete_all_elements_if_is_not_clearable_cache(Cache $cache)
    {
        $this->beConstructedWith($cache);
        $cache->save(Argument::any(), Argument::any(), 0)->willReturn(true);
        $cache->contains(Argument::any())->willReturn(false);

        $id1 = sha1(1);
        $id2 = sha1(1);

        $this->save($id1, 1);
        $this->save($id2, 2);

        $this->deleteAll()->shouldReturn(false);
        $this->has($id1)->shouldReturn(false);
        $this->has($id2)->shouldReturn(false);
    }
}
