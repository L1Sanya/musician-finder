@extends("main")
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <style>
        .body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 2000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .message-container {
            max-height: 600px;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse;
            align-items: flex-start;
        }
        .message {
            max-width: 50%;
            margin-bottom: 20px;
            padding: 10px 20px;
            border-radius: 20px;
            position: relative;
        }
        .sent {
            align-self: flex-end;
            background-color: #e5e5ea;
            color: #333;
        }
        .received {
            align-self: flex-start;
            background-color: #e5e5ea;
            color: #333;
        }
        .message p {
            color: black;
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 16px;
        }
        .message hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }
        .message-form {
            position: absolute;
            bottom: 1px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: calc(100%);
        }
        textarea {
            width: calc(100% - 24px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .username {
            color: deeppink;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <br>

        <h2>
            Dialog
        </h2>

    <br> <br>
    <div class="message-container" id="message-container">
        @foreach($messages->reverse() as $message)
            <div class="message {{ Auth::id() == $message->sender_id ? 'sent' : 'received' }}">
                <p><span class="username">{{ Auth::id() == $message->sender_id ? 'You' : $message->sender->name }}</span></p>
                <hr>
                <p>{{ $message->content }}</p>
                <br>
                <hr>
                <span class="timestamp">{{ $message->created_at }}</span>
            </div>
        @endforeach
    </div>
</div>

<div class="message-form">
    <form action="{{ route('messages.send') }}" method="POST">
        @csrf
        <input type="hidden" name="sender_id" value="{{ $sender_id }}">
        <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
        <input type="hidden" name="response_id" value="{{ $response_id }}">
        <textarea name="content" placeholder="Enter your message"></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var textarea = document.querySelector('textarea[name="content"]');
        textarea.addEventListener('keydown', function(event) {
            if (event.keyCode === 13 && !event.shiftKey) {
                event.preventDefault(); // Предотвращаем перенос строки
                sendMessage(); // Вызываем функцию отправки сообщения
            }
        });

        function sendMessage() {
            var form = document.querySelector('form[action="{{ route('messages.send') }}"]');
            form.submit(); // Отправляем форму
        }
    });
</script>
</body>
</html>
@endsection
