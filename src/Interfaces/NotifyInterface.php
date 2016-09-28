<?php

namespace Mildberry\Notifier\Interfaces;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
interface NotifyInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getExternalId();

    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId);

    /**
     * @return boolean
     */
    public function isSended();

    /**
     * @param boolean $sended
     * @return $this
     */
    public function setSended($sended);

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

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return string
     */
    public function toJson();
}
