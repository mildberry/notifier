<?php

namespace Mildberry\Notifier\Interfaces;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
interface NotifyInterface
{
    /**
     * @return string
     */
    public function getBody();

    /**
     * @param string $body
     * @return $this
     */
    public function setBody($body);

    /**
     * @return string
     */
    public function getRecipient();

    /**
     * @param string $recipient
     * @return $this
     */
    public function setRecipient($recipient);
}
