<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\EmailNotifyInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\EmailNotify;
use Mildberry\Notifier\Transport\VarDumpTransport;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct()
    {
        parent::__construct();

        $this->notifier = new Notifier();
        $this->notifier->setNotifyTransport(EmailNotifyInterface::class, (new VarDumpTransport()));
    }

    /**
     * @expectedException \Mildberry\Notifier\Exception\TransportNotFoundException
     */
    public function testCreateNotifierClass()
    {
        $notifier = new Notifier();
        $this->assertTrue($notifier instanceof Notifier);
        $notifier->send(new EmailNotify('123456798', 'test', 'test'));
        $notifier->setNotifyTransport(EmailNotifyInterface::class, (new VarDumpTransport()));
        $this->assertEquals(1, count($notifier->getTransports()));
    }
}
