# Notifier
Library for send user notifications by different transports

## Install

``` bash
$ composer require mildberry/notifier
```

## Usage

``` php
<?php

use Maildberry\Notifier\Notifier;
use Maildberry\Notifier\Notify;

$options = [
    'queue' => false,
];

$nofifier = new Notifier($options);

$notifi = Notifi::make('sms', '+79136703311', 'test');
$notifier->send($notifi);

$notifier->send(Norifi::make(['sms', 'email'], ['+79136703322', 'admin@google.com']), 'Hello %name% (%recipient%)' , ['name' => 'Admin']);

```