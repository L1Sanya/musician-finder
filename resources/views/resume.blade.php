@extends('nav')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
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
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .resume h2 {
            color: #555;
            margin-bottom: 10px; /* добавленный отступ */
        }
        .resume h3 {
            color: #555;
            margin-bottom: 10px; /* добавленный отступ */
        }
        .resume p {
            color: #777;
            margin-bottom: 10px; /* добавленный отступ */
        }
        .resume a {
            color: #777;
            margin-bottom: 10px; /* добавленный отступ */
        }
        .resume ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
            color: #777;
        }
        .resume ul li {
            margin-bottom: 5px;
        }
        .error-message {
            color: red;
            text-align: center;
        }
        .button-group {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            resize: none;
        }
        button[type="submit"] {
            background-color: #000333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>My Resume</h1>
    <div class="resume">
        @if(isset($resume))
            <h2>{{ $resume->user->name }}</h2>
            <p>Email: {{ $resume->user->email }}</p>
            <h3>Skills:</h3>
            <ul>
                @foreach($resume->skills as $skill)
                    <li>{{ $skill->name }}</li>
                @endforeach
            </ul>
            <h3>Experience:</h3>
            <p>{{ $resume->experience }}</p>
            <h3>Info:</h3>
            <p>{{ $resume->info }}</p>
            <div class="button-group">
                <form action="{{ route('edit.resume', $resume->id) }}" method="GET">
                    <button type="submit">Edit Resume</button>
                </form>
                <form action="{{ route('delete.resume') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Resume</button>
                </form>
            </div>
        @else
            <p class="error-message">Resume not found.</p>
            <a href="{{ route('custom.resume') }}" class="custom-resume-btn">Custom Resume</a>
        @endif
    </div>
</div>
</body>
</html>
@endsection
