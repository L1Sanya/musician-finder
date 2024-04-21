<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

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


