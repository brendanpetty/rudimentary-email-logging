<?php

namespace Brendanpetty\RudimentaryEmailLogging\handler;

use Brendanpetty\RudimentaryEmailLogging\Mail\LogEntry;
use Illuminate\Support\Facades\Mail;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\SymfonyMailerHandler;
use Monolog\LogRecord;
use Monolog\Level;

class EmailLogHandler extends AbstractProcessingHandler
{
    public function __construct(
        protected Level $level = Level::Warning,
        protected bool $bubble = true,
        protected string $appName = 'Custom Log',
        protected array $config = []
    ) {
        parent::__construct($level, $bubble);
    }

    public function write(LogRecord $record): void {
        Mail::to($this->config['to'])->send(new LogEntry(
            $this->appName,
            $this->config['from'],
            $this->config['subject'],
            $record->formatted,
        ));
    }
}
