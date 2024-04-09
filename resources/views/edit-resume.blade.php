@extends('nav')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume</title>
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
        .resume {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 20px);
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            height: auto; /* Автоматическая высота */
            min-height: 200px; /* Минимальная высота */
            resize: none; /* Запрет на изменение размера */
            overflow: hidden; /* Скрытие лишнего текста */
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Resume</h1>
    <div class="resume">
        <form action="{{ route('update.resume', $resume->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="experience">Experience:</label>
            <textarea id="experience" name="experience" required>{{ $resume->experience }}</textarea>
            <label for="info">Info:</label>
            <textarea id="info" name="info">{{ $resume->info }}</textarea>

            <label for="skills">Skills:</label>
            <div id="skills">
                <!-- Список скиллов -->
                @foreach($skills as $skill)
                    <label class="skill-checkbox">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, $resume->skills->pluck('id')->toArray()) ? 'checked' : '' }}>
                        {{ $skill->name }}
                    </label>
                @endforeach
            </div>

            <button type="submit">Update Resume</button>
        </form>
    </div>
</div>
</body>
</html>
@endsection
