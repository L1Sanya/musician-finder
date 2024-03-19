@extends('nav')
@section('content')
<h1>Create Announcement</h1>

<form method="POST" action="customAnnouncement">
    @csrf
    <input type="hidden" value="{{Auth::id()}}" name="user_id" required>

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>

    <label for="skills">Skills:</label>
    <select name="skills[]" id="skills" multiple>
        <option>Choose your skill</option>
        @foreach($skills as $skill)
            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
    </select>

    <label for="location">Location:</label><br>
    <textarea id="location" name="location"></textarea><br>


    <button type="submit">Create</button>

</form>
@endsection

