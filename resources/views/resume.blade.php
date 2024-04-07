@extends('nav')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
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
        .resume {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .resume h2 {
            color: #555;
        }
        .resume p {
            color: #777;
        }
        .resume ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        .resume ul li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>My Resume</h1>
    <div class="resume">
        <h2>John Doe</h2>
        <p>Email: john@example.com</p>
        <p>Phone: 123-456-7890</p>
        <h3>Skills:</h3>
        <ul>
            <li>HTML</li>
            <li>CSS</li>
            <li>JavaScript</li>
            <li>PHP</li>
        </ul>
        <h3>Experience:</h3>
        <p>Frontend Developer at XYZ Company (2018 - Present)</p>
        <p>Backend Developer at ABC Inc. (2015 - 2018)</p>
        <h3>Education:</h3>
        <p>Bachelor's Degree in Computer Science, University of Example (2011 - 2015)</p>
    </div>
</div>
</body>
</html>
@endsection
