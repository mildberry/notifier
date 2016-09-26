<?php

namespace Mildberry\Notifier\Notify;

use Mildberry\Notifier\Interfaces\EmailNotifyInterface;
use Mildberry\Notifier\Traits\SubjectTrait;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class EmailNotify extends Notify implements EmailNotifyInterface
{
    use SubjectTrait;

    /**
     * @param string $recipient
     * @param string $body
     * @param string $subject
     */
    public function __construct($recipient, $body, $subject)
    {
        $this
            ->setBody($body)
            ->setRecipient($recipient)
            ->setSubject($subject)
        ;
    }
}
