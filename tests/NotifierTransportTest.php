<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\EmailNotifyInterface;
use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\NotifyCollection;
use Mildberry\Notifier\Notify\SmsNotify;
use Mildberry\Notifier\Transport\NullTransport;
use Mildberry\Notifier\Transport\VarDumpTransport;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifierTransportTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct()
    {
        parent::__construct();

        $this->notifier = new Notifier();

        $this->notifier->setNotifyTransport([EmailNotifyInterface::class], (new VarDumpTransport()));
    }

    /**
     * @expectedException \Mildberry\Notifier\Exception\TransportNotFoundException
     */
    public function testFailedVarDumpTransport()
    {
        $this->notifier->send(new SmsNotify('1234567890', 'test'));
    }

    public function testSendCollectionNullTransport()
    {
        $this->notifier->setNotifyTransport(SmsNotifyInterface::class, new NullTransport());
        $collection = new NotifyCollection();
        $collection
            ->push(new SmsNotify('1234567890', 'test1'))
            ->push(new SmsNotify('1234567890', 'test2'))
        ;

        $collection = $this->notifier->sendCollection($collection);
        $id = 1;
        foreach ($collection as $notify) {
            $this->assertEquals($id, $notify->getExternalId());
            $this->assertTrue($notify->isSended());
            $id ++;
        }
    }
}