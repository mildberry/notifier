<?php

namespace Mildberry\Notifier\Tests;

use Mildberry\Notifier\Notifier;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifierTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNotifierClass()
    {
        $notifier = new Notifier();

        $this->assertTrue($notifier instanceof Notifier);
    }
}
