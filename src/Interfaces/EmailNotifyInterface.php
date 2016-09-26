<?php

namespace Mildberry\Notifier\Interfaces;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
interface EmailNotifyInterface extends NotifyInterface
{
    /**
     * @return string
     */
    public function getSubject();

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject);
}
