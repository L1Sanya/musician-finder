<?php

namespace App\Console\Commands;

use App\Services\RabbitMqService;
use Illuminate\Console\Command;

class ReceiveMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:receive-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to RabbitMQ and process incoming messages';

    /**
     * RabbitMqService instance.
     *
     * @var RabbitMqService
     */
    protected RabbitMqService $rabbitMqService;

    /**
     * Create a new command instance.
     *
     * @param  RabbitMqService  $rabbitMqService
     * @return void
     */
    public function __construct(RabbitMqService $rabbitMqService)
    {
        parent::__construct();
        $this->rabbitMqService = $rabbitMqService;
    }

    public function handle(): void
    {
        $callback = function ($message) {
            $this->info('Received message: ' . $message->body);
        };

        $this->info('Waiting for messages. To exit press CTRL+C');
        $this->rabbitMqService->receiveMessage('response', $callback);
    }
}
