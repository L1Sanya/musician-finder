@extends("main")
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
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
        .container h3 {
            color: #333;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .response {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .response h2 {
            color: #555;
        }
        .response p {
            color: #777;
        }
        .response ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        .response ul li {
            margin-bottom: 5px;
        }
        .response a {
            color: #007bff;
            text-decoration: none;
        }
        .response a:hover {
            text-decoration: underline;
        }
        .response h2 a{
            color: black;
        }
        .response a.blackname {
            color: black; /* Пример стиля для текста */
            font-weight: bold; /* Пример стиля для жирного шрифта */
            /* Другие свойства стилей */
        }
        .response a.dialog {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Responses to Announcements</h1>
    @foreach($responses as $response)
        <div class="response">
            <h2><a href="{{ route('announcements.show', ['announcement' => $response->announcement->id]) }}">{{$response->announcement->title}}</a></h2>
            <h3>Description:</h3>
            <p>{{ $response->announcement->description }}</p>
            @if($response->skills)
                <h3>Skills:</h3>
                <ul>
                    @foreach($response->skills as $skill)
                        <li>{{ $skill->name }}</li>
                    @endforeach
                </ul>
            @endif
            @if(Auth::user()->role->name == 'candidate')
                <h3>Published By:</h3>
                <p>{{ $response->announcement->creator->name }}</p>
            @elseif(Auth::user()->role->name == 'employer')
                <h3>Resume of Candidate:</h3>
                <a class='dialog' href="{{ route('resume.showResumeToEmployer', ['resumeId' => $response->resume->id]) }}">{{ $response->resume->user->name }}</a>

                <br>
            @endif
            <br>
            <a class='dialog' href="{{ route('responses.show', ['response' => $response->id]) }}">Go to dialog</a>
        </div>
    @endforeach
    <!-- Add more responses as needed -->
</div>
</body>
</html>
@endsection
