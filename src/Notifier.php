<?php

namespace Mildberry\Notifier;

use Mildberry\Notifier\Exception\TransportNotFoundException;
use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Interfaces\TransportInterface;
use Mildberry\Notifier\Notify\Notify;
use Mildberry\Notifier\Notify\NotifyCollection;

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
     * @param string|array $notifyInterfaces
     * @param TransportInterface $transport
     * @return $this
     */
    public function setNotifyTransport($notifyInterfaces, TransportInterface $transport)
    {
        if (!is_array($notifyInterfaces)) {
            $notifyInterfaces = [$notifyInterfaces];
        }

        foreach ($notifyInterfaces as $notifyInterface) {
            $this->transports[$notifyInterface] = $transport;
        }

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
        $transport = $this->getTransportByNotify($notify);

        $transport->sendNotify($notify);
    }

    /**
     * @param Notify $notify
     * @return TransportInterface
     * @throws TransportNotFoundException
     */
    private function getTransportByNotify(Notify $notify)
    {
        $notifyInterfaces = array_keys($this->transports);

        foreach ($notifyInterfaces as $interface) {
            if ($notify instanceof $interface) {
                return $this->transports[$interface];
            }
        }

        throw new TransportNotFoundException('Transport for notify "'.get_class($notify).'" not found');
    }
}
