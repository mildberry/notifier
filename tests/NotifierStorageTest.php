<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Interfaces\StorageInterface;
use Mildberry\Notifier\Notifier;
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
        $this->notifier
            ->setStorage(new NullStorage())
            ->setNotifyTransport(SmsNotifyInterface::class, (new NullTransport()))
        ;
    }

    public function testNullStorage()
    {
        $this->assertTrue($this->notifier->getStorage() instanceof StorageInterface);
        $this->notifier->send(new SmsNotify('1234567890', '123'));
    }
}