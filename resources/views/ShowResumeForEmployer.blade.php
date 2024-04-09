@extends('nav')
    @section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Details</title>
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
        .resume-details {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .resume-details h2 {
            color: black;
            margin-bottom: 10px;
        }
        .resume-details p, .resume-details a {
            color: black;
            margin-bottom: 10px;
        }
        .resume-details ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
            color: black;
        }
        .resume-details ul li {
            margin-bottom: 5px;
            color: black;
        }
        .resume-details h3 {
            margin-bottom: 5px;
            color: black;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Resume Details</h1>
    <div class="resume-details">
        @if(isset($resume))
            <h2>{{ $resume->user->name }}</h2>
            <h3>Skills:</h3>
            <ul>
                @foreach($resume->skills as $skill)
                    <li>{{ $skill->name }}</li>
                @endforeach
            </ul>
            <h3>Experience:</h3>
            <p>{{ $resume->experience }}</p>
        @else
            <p class="error-message">Resume not found.</p>
        @endif
    </div>
</div>
</body>
</html>
@endsection
