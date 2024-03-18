<h1>Create Announcement</h1>

<form method="POST" action="customAnnouncement">
    @csrf
    <input type="hidden" value="{{Auth::id()}}" name="user_id" required>

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>

    <h2>Skills:</h2>
    <ul>
        @foreach($announcement->skills as $skill)
            <li>{{ $skill->name }}</li>
        @endforeach
    </ul>
    
    <label for="location">Location:</label><br>
    <textarea id="location" name="location"></textarea><br>


    <button type="submit">Create</button>

</form>

