<h1>Create Announcement</h1>

<form method="POST" action="custom-skill">
    @csrf

    <label for="skill_name">Skill name:</label><br>
    <input type="text" id="skill_name" name="skill_name"><br>

    <button type="submit">Create</button>
</form>
