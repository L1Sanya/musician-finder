@extends("main")
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Responses</title>
</head>
<body>
<h1>All Responses</h1>
<ul>
    @if ($responses->isEmpty())
        <p>No private dialogs found.</p>
    @else
    @foreach($responses as $response)
        <li>
            <a href="{{ route('responses.show', $response->id) }}">
                Response {{ $response->id }}
            </a>
        </li>
    @endforeach
    @endif
</ul>
</body>
</html>
@endsection
