@extends('nav')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dialogs</title>
</head>
<body>
<h1>Dialogs</h1>

<div>
    <!-- Отображение всех сообщений -->
    @foreach($messages as $message)
        <p>From: {{ $message->sender_id }}, To: {{ $message->receiver_id }}</p>
        <p>{{ $message->content }}</p>
        <hr>
    @endforeach
</div>

<!-- Форма для отправки нового сообщения -->
<form action="{{ route('messages.send') }}" method="post">
    @csrf
    <!-- Поле для ввода содержания сообщения -->
    <input type="text" name="content" placeholder="Type your message">
    <!-- Кнопка "Send" для отправки сообщения -->
    <button type="submit">Send</button>
</form>

</body>
</html>
@endsection
