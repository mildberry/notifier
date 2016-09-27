<?php

namespace Mildberry\Notifier\Transport;

use Mildberry\Notifier\Interfaces\NotifyInterface;
use Mildberry\Notifier\Interfaces\TransportInterface;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class VarDumpTransport implements TransportInterface
{
    /**
     * @param NotifyInterface $notify
     * @return void
     */
    public function sendNotify(NotifyInterface $notify)
    {
        print $notify->toJson();
    }
}
