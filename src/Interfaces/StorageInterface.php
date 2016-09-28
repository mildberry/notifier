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
     * @return void
     */
    public function saveNotify(NotifyInterface $notify);

    /**
     * @param NotifyCollection $collection
     * @return void
     */
    public function saveNotifyCollection(NotifyCollection $collection);
}