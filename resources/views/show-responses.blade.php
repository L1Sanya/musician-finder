@extends("main")
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
</head>
<body>

<h2>Messages</h2>
@foreach($messages as $message)
    <div>
        <p>From: {{ $message->sender->name }}, To: {{ $message->receiver->name }}</p>
        <p>{{ $message->content }}</p>
        <hr>
    </div>
@endforeach

<!-- Форма отправки сообщения -->
<form action="{{ route('messages.send') }}" method="POST">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $message->receiver_id }}">
    <input type="hidden" name="response_id" value="{{ $message->receiver_id }}">
    <textarea name="content" placeholder="Enter your message"></textarea>
    <button type="submit">Send Message</button>
</form>

<!-- Форма для отклонения -->
<form action="{{ route('responses.reject') }}" method="POST">
    @csrf
    <button type="submit">Reject</button>
</form>

</body>
</html>
@endsection
