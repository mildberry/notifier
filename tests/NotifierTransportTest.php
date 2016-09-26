<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Interfaces\EmailNotifyInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\SmsNotify;
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
}