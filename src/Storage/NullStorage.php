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
     * @return void
     */
    public function saveNotify(NotifyInterface $notify)
    {
    }

    /**
     * @param NotifyCollection $collection
     * @return void
     */
    public function saveNotifyCollection(NotifyCollection $collection)
    {
    }
}
