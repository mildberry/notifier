<?php

namespace Mildberry\Notifier\Notify;

use Mildberry\Notifier\Interfaces\SmsNotifyInterface;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class SmsNotify extends Notify implements SmsNotifyInterface
{
    /**
     * @param string $phone
     * @param string $text
     */
    public function __construct($phone, $text)
    {
        $this
            ->setBody($text)
            ->setRecipient($phone)
        ;
    }
}
