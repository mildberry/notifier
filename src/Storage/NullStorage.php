<?php

namespace Mildberry\Notifier\Storage;

use Mildberry\Notifier\Interfaces\NotifyInterface;
use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Notify\NotifyCollection;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NullStorage implements StorageInterface
{
    /**
     * @param NotifyInterface $notify
     * @return NotifyInterface
     */
    public function saveNotify(NotifyInterface $notify)
    {
        $notify->setId(1);

        return $notify;
    }

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function saveNotifyCollection(NotifyCollection $collection)
    {
        $id = 0;
        foreach ($collection as $notify) {
            $notify->setId(($id + 1));
            $collection->offsetSet($id, $notify);
            $id++;
        }

        return $collection;
    }
}
