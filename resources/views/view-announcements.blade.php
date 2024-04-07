@extends('nav')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .announcement {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .announcement h2 {
            color: #555;
        }
        .announcement p {
            color: #777;
        }
        .announcement ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        .announcement ul li {
            margin-bottom: 5px;
        }
        .announcement a {
            color: #007bff;
            text-decoration: none;
        }
        .announcement a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Latest Announcements</h1>
    <div class="announcement">
        <h2>Title of Announcement 1</h2>
        <p>Description of Announcement 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <h3>Skills:</h3>
        <ul>
            <li>Skill 1</li>
            <li>Skill 2</li>
            <li>Skill 3</li>
        </ul>
        <p>Location: City, Country</p>
        <a href="#">Read More</a>
    </div>
    <div class="announcement">
        <h2>Title of Announcement 2</h2>
        <p>Description of Announcement 2. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <h3>Skills:</h3>
        <ul>
            <li>Skill A</li>
            <li>Skill B</li>
            <li>Skill C</li>
        </ul>
        <p>Location: City, Country</p>
        <a href="#">Read More</a>
    </div>
    <!-- Add more announcements as needed -->
</div>
</body>
</html>
@endsection
