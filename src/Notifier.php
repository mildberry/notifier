<?php

namespace Mildberry\Notifier;

use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Interfaces\TransportInterface;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class Notifier
{
    /**
     * @var TransportInterface[]
     */
    private $transports;

    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var array
     */
    private $options;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @param string $alias
     * @param TransportInterface $transport
     * @return $this
     */
    public function addTransport($alias, TransportInterface $transport)
    {
        $this->transports[$alias] = $transport;

        return $this;
    }

    /**
     * @param Notify|NotifyCollection $notify
     */
    public function send($notify)
    {
        if ($notify instanceof Notify) {
            $notify = (new NotifyCollection())->push($notify);
        }

        foreach ($notify as $item) {
            $this->sendNotify($item);
        }
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param StorageInterface $storage
     *
     * @return $this
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * @param array $options
     */
    private function setOptions(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param Notify $notify
     */
    private function sendNotify(Notify $notify)
    {
    }
}
