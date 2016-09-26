<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\EmailNotify;
use Mildberry\Notifier\Notify\PushNotify;
use Mildberry\Notifier\Notify\SmsNotify;
use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Interfaces\EmailNotifyInterface;
use Mildberry\Notifier\Interfaces\PushNotifyInterface;
use Mildberry\Notifier\Transport\VarDumpTransport;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifierNotifyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Notifier
     */
    private $notifier;

    public function __construct()
    {
        parent::__construct();

        $this->notifier = new Notifier();
        $this->notifier->setNotifyTransport([SmsNotifyInterface::class, EmailNotifyInterface::class, PushNotifyInterface::class], (new VarDumpTransport()));
    }

    public function testSmsNotify()
    {
        $this->expectOutputRegex('(1234567890)');
        $sms = new SmsNotify('1234567890', 'sms');

        $this->notifier->send($sms);
    }

    public function testEmailNotify()
    {
        $this->expectOutputRegex('(admin@google.com)');
        $sms = new EmailNotify('admin@google.com', 'Hello admin', 'Test message');

        $this->notifier->send($sms);
    }

    public function testPushNotify()
    {
        $this->expectOutputRegex('(YTFYF5456GFDS44Y)');
        $sms = new PushNotify('YTFYF5456GFDS44Y', 'Take on your phone');

        $this->notifier->send($sms);
    }
}