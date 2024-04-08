@extends('nav')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1E262D;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }
        form {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 15px;
            text-align: left;
            color: #ccc;
        }
        .label-for-skills {
            display: block;
            margin-bottom: 15px;
            text-align: left;
            color: black;
        }
        input[type="text"],
        textarea,
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 0 auto 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #fff;
            color: #333;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Create Announcement</h1>
    <form method="POST" action="/customAnnouncement">
        @csrf
        <input type="hidden" value="{{Auth::id()}}" name="user_id" required>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title">

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>

        <label for="skills">Skills:</label>
        <div id="skills" style="width: calc(100% - 20px); padding: 10px; margin: 0 auto 20px;border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; background-color: #fff;">
            <!-- Список скиллов -->
            @foreach($skills as $skill)
                <label class="label-for-skills"  style="display: block; margin-bottom: 5px; cursor: pointer;">
                    <input type="checkbox" name="skills[]" value="{{ $skill->id }}" style="margin-right: 5px;">
                    {{ $skill->name }}
                </label>
            @endforeach
        </div>

        <label for="location">Location:</label>
        <textarea id="location" name="location"></textarea>

        <button type="submit">Create</button>
    </form>
</div>
</body>
</html>
@endsection

