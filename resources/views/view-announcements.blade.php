@extends('nav')

@section('content')

    <h1>All Announcements</h1>
    @if($announcements->isEmpty())
        <p>No announcements found.</p>
    @else
        <ul>
            @foreach($announcements as $announcement)
                <li>
                    <a href="{{ route('announcements.show', $announcement) }}">
                        <h2>{{ $announcement->title }}</h2>
                    </a>
                    <p>{{ $announcement->description }}</p>
                    <h3>Skills:</h3>
                    <ul>
                        @foreach($announcement->skills as $skill)
                            <li>{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                    <p>Location: {{ $announcement->location }}</p>
                </li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('announcements.responses', ['announcement' => $announcement->id]) }}">View Responses</a>
@endsection
