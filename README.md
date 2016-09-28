# Notifier
Library for send user notifications by different transports

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d0f79f46-ceec-40b3-8303-43d6453e6a00/mini.png)](https://insight.sensiolabs.com/projects/d0f79f46-ceec-40b3-8303-43d6453e6a00)
[![Build Status](https://travis-ci.org/mildberry/notifier.svg?branch=master)](https://travis-ci.org/mildberry/notifier)
[![codecov](https://codecov.io/gh/mildberry/notifier/branch/master/graph/badge.svg)](https://codecov.io/gh/mildberry/notifier)

## Install

``` bash
$ composer require mildberry/notifier
```

## Usage

``` php
<?php

use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\NotifyCollection;
use Mildberry\Notifier\Notify\SmsNotify;
use Mildberry\Notifier\Transport\VarDumpTransport;

include 'vendor/autoload.php';

$notifier = new Notifier();
$notifier->setNotifyTransport(SmsNotifyInterface::class, (new VarDumpTransport()));

$notifier->send(new SmsNotify('79136703311', 'Hello world'));

$collectionSms = new NotifyCollection();
$collectionSms
    ->push(new SmsNotify('79136703311', 'How a you?'))
    ->push(new SmsNotify('79136703311', 'Where are you?'));

$notifier->sendCollection($collectionSms);

```

## Custom notify

``` php
<?php

use Mildberry\Notifier\Interfaces\SmsNotifyInterface;
use Mildberry\Notifier\Notifier;
use Mildberry\Notifier\Notify\Notify;
use Mildberry\Notifier\Transport\VarDumpTransport;

include 'vendor/autoload.php';

class ActivationSms extends Notify implements SmsNotifyInterface
{
    public function __construct($phone, $code)
    {
        $this
            ->setRecipient($phone)
            ->setBody('Your activation code is '.$code)
        ;
    }
}

class RegistrationCompleteSms extends Notify implements SmsNotifyInterface
{
    public function __construct($phone)
    {
        $this
            ->setRecipient($phone)
            ->setBody('Congratulations registration is completed')
        ;
    }
}

$notifier = new Notifier();
$notifier->setNotifyTransport(SmsNotifyInterface::class, (new VarDumpTransport()));

// ... registration process

$notifier->send(new ActivationSms('79136703311', rand(1, 9999)));

// ... registration complete

$notifier->send(new RegistrationCompleteSms('79136703311'));
```

## TODO

- Documentation for Transports
- Documentation for Storage
- Saving externalID and save delivery state from transport
- Notify query

## License
This library is under the MIT license. See the complete license in [here](https://github.com/mildberry/notifier/blob/master/LICENSE)
