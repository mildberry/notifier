<?php

namespace Mildberry\Notifier\Transport;

use Mildberry\Notifier\Interfaces\NotifyInterface;
use Mildberry\Notifier\Interfaces\TransportInterface;
use Mildberry\Notifier\Notify\NotifyCollection;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class VarDumpTransport extends NullTransport implements TransportInterface
{
    /**
     * @param NotifyInterface $notify
     * @return NotifyInterface
     */
    public function sendNotify(NotifyInterface $notify)
    {
        $notify = parent::sendNotify($notify);

        print $notify->toJson();

        return $notify;
    }

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function sendNotifyCollection(NotifyCollection $collection)
    {
        $collection = parent::sendNotifyCollection($collection);

        print $collection->toJson();

        return $collection;
    }
}
