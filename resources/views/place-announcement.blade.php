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
        @foreach($skills as $skill)
            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
        @endforeach
    </select>

    <label for="location">Location:</label><br>
    <textarea id="location" name="location"></textarea><br>


    <button type="submit">Create</button>

</form>

<style>
    form {
        max-width: 600px; /* Увеличиваем максимальную ширину формы */
        margin: 0 auto; /* Центрируем форму по горизонтали */
        text-align: center; /* Центрируем содержимое формы */
    }

    label {
        display: block;
        margin-bottom: 15px; /* Увеличенный отступ между метками */
        text-align: left; /* Выравниваем метки по левому краю */
    }

    input[type="text"],
    textarea,
    select {
        width: calc(100% - 20px); /* Ширина поля ввода уменьшена на 20 пикселей для учета внешних отступов */
        padding: 10px; /* Увеличиваем внутренние отступы поля ввода */
        margin: 0 auto; /* Центрируем поля ввода по горизонтали */
        margin-bottom: 20px; /* Увеличенный отступ между полями ввода */
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 24px; /* Увеличиваем внутренние отступы кнопки */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
@endsection

