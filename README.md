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
        'to' => env('MAIL_FROM_ADDRESS'),
        'from' => env('MAIL_FROM_ADDRESS'),
        'subject' => env('APP_NAME') . ' Log',
    ],
]
```

in app/providers/AppServiceProvider.php
```
use Brendanpetty\RudimentaryEmailLogging\EmailLogHandler;

public function boot()
{
    Log::extend('email', function ($app, $config) {
        return new Logger('email', [new EmailLogHandler()]);
    });
}
```

# Usage
```
use Illuminate\Support\Facades\Log;

Log::warning('warning message');
Log::error('error message');
```