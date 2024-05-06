<?php

namespace App\Classes;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{

    private string $channel;
    private string $level = 'info';

    private \Monolog\Logger $logger;

    public function __construct(string $channel = 'info')
    {
        $this->channel = $channel;
        $baseLogPath = $_ENV['LOG_PATH'];
        $fileName = $channel . '/' . date('Y-m-d') . '.log';
        $logger = new \Monolog\Logger($this->channel, [new StreamHandler($baseLogPath . '/' . $fileName)]);


//        $logger->pushHandler();
        $this->logger = $logger;
    }


    public function emergency(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->level = 'error';
        $this->log($this->level, $message, $context);
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        $this->level = 'warning';
        $this->log($this->level, $message, $context);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement notice() method.
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        $this->level = 'info';
        $this->log($this->level, $message, $context);
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {


        $level = match ($this->level) {
            'info' => Level::Info,
            'warning' => Level::Warning,
            'error' => Level::Error,
        };
        $this->logger->addRecord($level, $message, $context);
    }
}