<?php

namespace Mildberry\Notifier\Notify;

use Mildberry\Notifier\Interfaces\NotifyInterface;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class Notify implements NotifyInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $externalId;

    /**
     * @var bool
     */
    protected $sended = false;

    /**
     * @var string
     */
    protected $recipient;

    /**
     * @var string
     */
    protected $body;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSended()
    {
        return $this->sended;
    }

    /**
     * @param boolean $sended
     * @return $this
     */
    public function setSended($sended)
    {
        $this->sended = $sended;

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

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        foreach (get_object_vars($this) as $key => $value) {
            $method = sprintf('get%s', ucwords($key));
            if (method_exists($this, $method)) {
                $array[$key] = $this->$method();
            }
        }

        return $array;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}
