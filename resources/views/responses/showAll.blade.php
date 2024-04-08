@extends("main")
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
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
    </style>
</head>
<body>
<div class="container">
    <h1>Responses to Announcements</h1>
    @foreach($responses as $response)
        <div class="response">
            <h2>Response {{ $response->id }}</h2>
            <p>Description of Response {{ $response->id }}. {{ $response->description }}</p>
            @if($response->skills)
                <h3>Skills:</h3>
                <ul>
                    @foreach($response->skills as $skill)
                        <li>{{ $skill->name }}</li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('responses.show', ['response' => $response->id]) }}">Read More</a>
        </div>
    @endforeach
    <!-- Add more responses as needed -->
</div>
</body>
</html>
@endsection
