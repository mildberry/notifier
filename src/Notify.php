<?php

namespace Mildberry\Notifier;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class Notify
{
    /**
     * @var string
     */
    private $transport;

    /**
     * @var string
     */
    private $recipient;

    /**
     * @var string
     */
    private $message;

    /**
     * @param string|array $transport
     * @param string|array $recipient
     * @param string|array $message
     * @return self|NotifyCollection
     */
    public static function make($transport, $recipient, $message)
    {
        return new self();
    }

    /**
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param string $transport
     *
     * @return $this
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
