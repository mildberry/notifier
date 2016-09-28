<?php

namespace Mildberry\Notifier\Interfaces;

use Mildberry\Notifier\Notify\NotifyCollection;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
interface StorageInterface
{
    /**
     * @param NotifyInterface $notify
     * @return NotifyInterface
     */
    public function saveNotify(NotifyInterface $notify);

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function saveNotifyCollection(NotifyCollection $collection);
}
