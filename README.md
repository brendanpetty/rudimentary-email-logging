# rudimentary-email-logging
Very simple Laravel package to allow log entries to be sent immediately as an email. Best used in a stack with a higher log level than the daily (or other less intrusive) log channel catching all the info etc.

# Installation
```
composer require brendanpetty/rudimentary-email-logging
```

in config/logging.php
```
use Brendanpetty\RudimentaryEmailLogging\EmailLogger;

'default' => env('LOG_CHANNEL', 'stack'),

'channels' => [
    'stack' => [
        'channels' => ['daily', 'email'],
    ],

    'email' => [
        'driver' => 'custom',
        'via' => EmailLogger::class,
        'level' => 'warning',
        'to' => env('MAIL_FROM_ADDRESS'),       // or 'email@address.com'
        'from' => env('MAIL_FROM_ADDRESS'),     // or 'email@address.com'
        'subject' => env('APP_NAME') . ' Log',  // or whatever
    ],
]
```

# Usage
```
use Illuminate\Support\Facades\Log;

Log::warning('warning message');
Log::error('error message');
```