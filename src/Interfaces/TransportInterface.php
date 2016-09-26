<?php

namespace Mildberry\Notifier\Interfaces;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
interface TransportInterface
{
    /**
     * @param NotifyInterface $notify
     * @return void
     */
    public function sendNotify(NotifyInterface $notify);
}
