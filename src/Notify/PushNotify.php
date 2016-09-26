<?php

namespace Mildberry\Notifier\Notify;

use Mildberry\Notifier\Interfaces\PushNotifyInterface;
use Mildberry\Notifier\Notify;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class PushNotify extends Notify implements PushNotifyInterface
{
    /**
     * @param string $device
     * @param string $text
     */
    public function __construct($device, $text)
    {
        $this
            ->setBody($text)
            ->setRecipient($device)
        ;
    }
}