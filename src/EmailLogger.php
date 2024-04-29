<?php

namespace Brendanpetty\RudimentaryEmailLogging;

use Monolog\Logger;
use Monolog\LogRecord;
use Monolog\Level;
use Brendanpetty\RudimentaryEmailLogging\handler\EmailLogHandler;

class EmailLogger
{
    public function __construct(
        protected Level $level = Level::Warning,
        protected bool $bubble = true,
        protected array $config = []
    ) { }

    public function __invoke(array $config): Logger {
        return new Logger(
            config('app.name'),
            [
                new EmailLogHandler($this->level, $this->bubble, config('app.name'), $config)
            ]
        );
    }
}
