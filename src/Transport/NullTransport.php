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
        $notify
            ->setSended(true)
            ->setExternalId('1')
        ;

        return $notify;
    }

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function sendNotifyCollection(NotifyCollection $collection)
    {
        $id = 0;
        foreach ($collection as $notify) {
            $notify
                ->setSended(true)
                ->setExternalId(($id + 1))
            ;
            $collection->offsetSet($id, $notify);
            $id++;
        }

        return $collection;
    }
}
