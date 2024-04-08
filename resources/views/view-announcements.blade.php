@extends('nav')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
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
            color: #333; /* Цвет текста списка навыков */
        }
        .announcement ul li {
            margin-bottom: 5px;
        }
        .announcement h3 {
            color: #333;
            margin-top: 10px;
        }
        .announcement p.location {
            color: #555; /* Темный цвет текста для Location */
        }
        .announcement a {
            color: #007bff;
            text-decoration: none;
        }
        .announcement a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Latest Announcements</h1>
    @foreach($announcements as $announcement)
        <div class="announcement">
            <h2>{{ $announcement->title }}</h2>
            <p>{{ $announcement->description }}</p>
            <h3>Skills:</h3>
            <ul>
                @foreach($announcement->skills as $skill)
                    <li>{{ $skill->name }}</li>
                @endforeach
            </ul>
            <h3>Location:</h3>
            <p class="location">{{ $announcement->location }}</p>
            <a href="{{ route('announcements.show', $announcement) }}">Read More</a>
        </div>
    @endforeach
</div>
</body>
</html>
@endsection
