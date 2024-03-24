<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dialog</title>
</head>
<body>
<h1>Dialog</h1>

<div>
    <!-- Отображение всех сообщений -->
    @foreach($messages as $message)
        <p>{{ $message->content }}</p>
        <small>From: {{ $message->sender->name }}, To: {{ $message->receiver->name }}</small>
        <hr>
    @endforeach
</div>

<!-- Форма для отправки нового сообщения -->
<form action="{{ route('messages.send') }}" method="post">
    @csrf
    <input type="text" name="message_content" placeholder="Type your message">
    <button type="submit">Send</button>
</form>
</body>
</html>
