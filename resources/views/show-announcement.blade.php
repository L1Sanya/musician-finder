@extends('main')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .announcement {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .announcement h2 {
            color: #555;
        }
        .announcement p {
            color: #777;
        }
        .announcement ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        .announcement ul li {
            margin-bottom: 5px;
        }
        .announcement a {
            color: #007bff;
            text-decoration: none;
        }
        .announcement a:hover {
            text-decoration: underline;
        }
        .reply-form {
            margin-top: 20px;
        }
        .reply-form input[type="text"] {
            width: calc(100% - 120px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .reply-form button {
            width: 100px;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .reply-form button:hover {
            background-color: #0056b3;
        }

        /* Добавленные стили */
        .skills-heading, .location-heading {
            color: #555;
            margin-top: 10px;
        }

        .skill-item, .location-item {
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="announcement">
        <h1>{{ $announcement->title }}</h1>
        <p>{{ $announcement->description }}</p>
        <h3 class="skills-heading">Skills:</h3>
        <ul>
            @foreach($announcement->skills as $skill)
                <li class="skill-item">{{ $skill->name }}</li>
            @endforeach
        </ul>
        <h3 class="location-heading">Location:</h3>
        <p class="location-item">{{ $announcement->location }}</p>
    </div>
    @if (auth()->user()->role->name == 'candidate')
    <!-- Форма для отправки отклика -->
    <div class="reply-form">
        <form action="{{ route('announcements.reply', $announcement) }}" method="post">
            @csrf
            <input type="text" name="message_content" placeholder="Type your message">
            <button type="submit">Reply</button>
        </form>
    </div>
    @endif
</div>
</body>
</html>
@endsection



