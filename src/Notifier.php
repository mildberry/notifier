<?php

namespace Mildberry\Notifier;

use Mildberry\Notifier\Exception\TransportNotFoundException;
use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Interfaces\TransportInterface;
use Mildberry\Notifier\Notify\Notify;
use Mildberry\Notifier\Notify\NotifyCollection;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     * @param Notify $notify
     * @return Notify
     */
    public function send(Notify $notify)
    {
        $transport = $this->getTransportByNotify($notify);

        $notify = $transport->sendNotify($notify);

        if ($this->options['saveNotify'] && $this->storage) {
            $notify = $this->storage->saveNotify($notify);
        }

        return $notify;
    }

    /**
     * @param NotifyCollection $collection
     * @return NotifyCollection
     */
    public function sendCollection(NotifyCollection $collection)
    {
        $resultCollection = new NotifyCollection();

        $collections = $this->getNotifiesCollectionByTransport($collection);

        foreach ($collections as $array) {
            $collection = $array['transport']->sendNotifyCollection($array['collection']);
            if ($this->options['saveNotify'] && $this->storage) {
                $collection = $this->storage->saveNotifyCollection($collection);
            }
            $resultCollection->merge($collection);
        }

        return $resultCollection;
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
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * @return Interfaces\TransportInterface[]
     */
    public function getTransports()
    {
        return $this->transports;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options = [])
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'saveNotify' => false,
        ]);

        $this->options = $resolver->resolve($options);
    }

    /**
     * @param Notify $notify
     * @return TransportInterface
     * @throws TransportNotFoundException
     */
    private function getTransportByNotify(Notify $notify)
    {
        if (is_null($this->transports)) {
            throw new TransportNotFoundException('Transport for notify "'.get_class($notify).'" not found');
        }

        $notifyInterfaces = array_keys($this->transports);

        foreach ($notifyInterfaces as $interface) {
            if ($notify instanceof $interface) {
                return $this->transports[$interface];
            }
        }

        throw new TransportNotFoundException('Transport for notify "'.get_class($notify).'" not found');
    }

    /**
     * @param NotifyCollection $collection
     * @return array
     * @throws TransportNotFoundException
     */
    private function getNotifiesCollectionByTransport(NotifyCollection $collection)
    {
        $array = [];

        foreach ($collection as $notify) {
            $transport = $this->getTransportByNotify($notify, $this->transports);
            $transportClass = get_class($transport);
            if (empty($array[$transportClass])) {
                $array[$transportClass] = [
                    'transport' => $transport,
                    'collection' => new NotifyCollection(),
                ];
            }
            $array[$transportClass]['collection']->push($notify);
        }

        return $array;
    }
}
