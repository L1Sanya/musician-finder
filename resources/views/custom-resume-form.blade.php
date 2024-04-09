@extends('nav')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Resume</title>
    <style>
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
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        select {
            height: 35px;
        }
        .skill-checkbox {
            margin-right: 10px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block; /* Добавлено */
            text-align: center; /* Добавлено */
            text-decoration: none; /* Добавлено */
            font-size: 16px; /* Добавлено */
            font-weight: bold; /* Добавлено */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Добавлено */
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Create Custom Resume</h1>
    <!-- Форма для отправки резюме -->
    <form action="{{ route('custom.resume') }}" method="post">
        @csrf
        <label for="experience">Experience:</label>
        <textarea id="experience" name="experience" required></textarea>

        <label for="info">Info:</label>
        <textarea id="info" name="info" required></textarea>

        <label for="skills">Skills:</label>
        <div id="skills">
            <!-- Список скиллов -->
            @foreach($skills as $skill)
                <label class="skill-checkbox"><input type="checkbox" name="skills[]" value="{{ $skill->id }}"> {{ $skill->name }}</label>
            @endforeach
        </div>
        <br>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
@endsection
