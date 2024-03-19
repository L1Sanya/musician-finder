@extends('nav')
@section('content')
<h1>All Announcements</h1>
@if($announcements->isEmpty())
    <p>No announcements found.</p>
@else
    <ul>
        @foreach($announcements as $announcement)
            <li>
                <h2>{{ $announcement->title }}</h2>
                <p>{{ $announcement->description }}</p>
                <p>{{ $announcementSkill->skill()->name }}</p>
                <p>Location: {{ $announcement->location }}</p>
            </li>
        @endforeach
    </ul>


@endif
@endsection
