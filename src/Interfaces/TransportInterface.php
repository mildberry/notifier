<?php

namespace Mildberry\Notifier\Interfaces;

use Mildberry\Notifier\Notify\NotifyCollection;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
interface TransportInterface
{
    /**
     * @param NotifyInterface $notify
     * @return NotifyInterface
     */
    public function sendNotify(NotifyInterface $notify);

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function sendNotifyCollection(NotifyCollection $collection);
}
