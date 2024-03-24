<h1>{{ $announcement->title }}</h1>
<p>{{ $announcement->description }}</p>
<h3>Skills:</h3>
<ul>
    @foreach($announcement->skills as $skill)
        <li>{{ $skill->name }}</li>
    @endforeach
</ul>
<p>Location: {{ $announcement->location }}</p>

<!-- Форма для отправки отклика -->
<form action="{{ route('announcements.reply', $announcement) }}" method="post">
    @csrf
    <input type="text" name="message_content" placeholder="Type your message">
    <button type="submit" class="btn btn-primary">Откликнуться</button>
</form>



