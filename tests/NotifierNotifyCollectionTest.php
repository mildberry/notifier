<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\NotifyCollection;
use Mildberry\Notifier\Notify\SmsNotify;
use Mildberry\Notifier\Storage\NullStorage;
use Mildberry\Notifier\Transport\VarDumpTransport;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifierNotifyCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct()
    {
        parent::__construct();

        $this->notifier = new Notifier(['saveNotify' => true]);
        $this->notifier
            ->setStorage(new NullStorage())
            ->setNotifyTransport(SmsNotifyInterface::class, (new VarDumpTransport()))
        ;
    }

    public function testNotifyCollectionClass()
    {
        $this->expectOutputString('[{"id":null,"externalId":0,"recipient":"1234567980","body":"test"},{"id":null,"externalId":1,"recipient":"1234567890","body":"test2"}]');

        $collection = new NotifyCollection();

        $this->assertTrue($collection instanceof NotifyCollection);
        $sms = new SmsNotify('1234567980', 'test');
        $collection->push($sms);
        $collection->offsetSet(1, (new SmsNotify('1234567890', 'test2')));
        $this->assertEquals(2, $collection->count());
        $this->assertEquals(2, count($collection->getNotifies()));
        $this->assertTrue($collection->offsetExists(0));
        $this->assertEquals($sms, $collection->offsetGet(0));

        $this->notifier->sendCollection($collection);

        $collection->offsetUnset(0);
        $this->assertEquals(1, $collection->count());
    }

}
