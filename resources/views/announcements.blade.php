@extends('nav')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <style>
        /* Ваши стили здесь */
        .body {
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
            text-transform: none;
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
        .filter-form {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .filter-form label {
            display: block;
            margin-bottom: 10px;
        }
        .filter-form select {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .filter-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Добавлено для отступа от предыдущего элемента */
        }
        .filter-form button:hover {
            background-color: #0056b3;
        }
        input[type="text"] {
            width: calc(100% - 100px); /* Ширина поля ввода, учитывая размер кнопки поиска */
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Announcements</h1>
    <br>
    <form action="{{ route('announcements.view') }}" method="GET" style="display: flex;">
        <input type="text" name="query" id="search" placeholder="Enter search term" autofocus style="flex: 1; padding: 10px; border-radius: 4px 0 0 4px; border: 1px solid #ccc;">
        <button type="submit" style="background-color: #007bff; color: #fff; border: none; border-radius: 0 4px 4px 0; padding: 10px 20px; cursor: pointer;">Search</button>
    </form>

    <div class="filter-form">
        <form action="{{ route('announcements.view') }}" method="GET">
            <label for="skill">Filter by Skill:</label>
            <select name="skill" id="skill">
                <option value="">Select Skill</option>
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                @endforeach
            </select>

            <label for="location">Filter by Location:</label>
            <select name="location" id="location">
                <option value="">Select Location</option>
                @foreach($locations as $location)
                    <option value="{{ $location }}">{{ $location }}</option>
                @endforeach
            </select>
            <br>
            <br>
            <button type="submit">Apply Filters</button>
        </form>
    </div>

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
