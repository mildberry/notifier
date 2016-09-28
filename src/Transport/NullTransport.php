<?php

namespace Mildberry\Notifier\Transport;

use Mildberry\Notifier\Interfaces\NotifyInterface;
use Mildberry\Notifier\Interfaces\TransportInterface;
use Mildberry\Notifier\Notify\NotifyCollection;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NullTransport implements TransportInterface
{
    /**
     * @param NotifyInterface $notify
     * @return NotifyInterface
     */
    public function sendNotify(NotifyInterface $notify)
    {
        return $notify;
    }

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function sendNotifyCollection(NotifyCollection $collection)
    {
        return $collection;
    }
}
