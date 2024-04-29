<?php

namespace Brendanpetty\RudimentaryEmailLogging;

use Illuminate\Support\ServiceProvider;

class EmailLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'rudimentary-email-logger');
    }
}