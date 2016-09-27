<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\NotifyCollection;
use Mildberry\Notifier\Notify\SmsNotify;

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

        $this->notifier = new Notifier();
    }

    public function testNotifyCollectionClass()
    {
        $collection = new NotifyCollection();

        $this->assertTrue($collection instanceof NotifyCollection);
        $sms = new SmsNotify('1234567980', 'test');
        $collection->offsetSet(0, $sms);
        $this->assertEquals(1, $collection->count());
        $this->assertEquals(1, count($collection->getNotifies()));
        $this->assertTrue($collection->offsetExists(0));
        $this->assertEquals($sms, $collection->offsetGet(0));
        $collection->offsetUnset(0);
        $this->assertEquals(0, $collection->count());
    }

}
