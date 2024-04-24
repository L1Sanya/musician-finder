<?php

namespace App\Services;

use Exception;
use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqService
{
    protected AMQPStreamConnection $connection;
    protected AbstractChannel|AMQPChannel $channel;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'user');
        $this->channel = $this->connection->channel();
    }

    public function sendMessage(string $queueName, string $message): void
    {
        $this->channel->queue_declare($queueName, false, false, false, false);

        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', $queueName);
    }

    public function receiveMessage(string $queueName, $callback): void
    {
        $this->channel->queue_declare($queueName, false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $this->channel->basic_consume($queueName, '', false, true, false, false, function ($message) use ($callback) {
            $callback($message);
        });

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    /**
     * @throws Exception
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}

