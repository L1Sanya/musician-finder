@extends("main")
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
    <style>
        /* Стили здесь */
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
