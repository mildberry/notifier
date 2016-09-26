<?php

namespace Mildberry\Notifier\Notify;

use Mildberry\Notifier\Interfaces\NotifyInterface;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class Notify implements NotifyInterface
{
    /**
     * @var string
     */
    protected $recipient;

    /**
     * @var string
     */
    protected $body;

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     *
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
}
