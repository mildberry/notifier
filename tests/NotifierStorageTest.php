<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\NotifyCollection;
use Mildberry\Notifier\Notify\SmsNotify;
use Mildberry\Notifier\Storage\NullStorage;
use Mildberry\Notifier\Transport\NullTransport;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifierStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct()
    {
        parent::__construct();

        $this->notifier = new Notifier(['saveNotify' => true]);
    }

    public function testNullStorage()
    {
        $this->notifier
            ->setStorage(new NullStorage())
            ->setNotifyTransport(SmsNotifyInterface::class, (new NullTransport()))
        ;
        $this->assertTrue($this->notifier->getStorage() instanceof StorageInterface);
        $sms = new SmsNotify('1234567890', '123');
        $notify = $this->notifier->send($sms);
        $this->assertEquals(1, $notify->getId());

        $collection = new NotifyCollection();
        $collection
            ->push($sms)
            ->push(new SmsNotify('1234567980', 'test'))
        ;

        $collection = $this->notifier->sendCollection($collection);
        $id = 1;
        foreach ($collection as $notify) {
            $this->assertEquals($id, $notify->getId());
            $id ++;
        }
    }
}