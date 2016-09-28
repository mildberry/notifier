<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\EmailNotifyInterface;
use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Storage\NullStorage;
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
     * @ex
     */
    public function testCreateNotifierClass()
    {
        $notifier = new Notifier(['saveNotify' => true]);
        $this->assertTrue($notifier instanceof Notifier);
        $notifier->setStorage(new NullStorage());
        $this->assertTrue($notifier->getStorage() instanceof StorageInterface);
        $notifier->setNotifyTransport(EmailNotifyInterface::class, (new VarDumpTransport()));
        $this->assertEquals(1, count($notifier->getTransports()));
    }
}
