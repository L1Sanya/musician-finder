<?php

namespace App\Services;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqService
{
    public function __construct() {

    }

    public function sendMessage()
    {
        try {
            $connection = new AMQPStreamConnection('rabbitmq', 5672, 'rmuser', 'rmpassword');
        } catch (Exception $e) {
        }
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello');

        echo " [x] Sent 'Hello World!'\n";

        $channel->close();
        $connection->close();
    }

    public function receiveMessage()
    {
        try {
            $connection = new AMQPStreamConnection('rabbitmq', 5672, 'rmuser', 'rmpassword');
        } catch (Exception $e) {
        }
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}

