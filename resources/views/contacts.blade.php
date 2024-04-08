@extends('main')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
        .contact-info {
            margin-top: 20px;
        }
        .contact-info p {
            margin-bottom: 10px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Contact</h1>
    <div class="contact-info">
        <p><strong>Email:</strong> lolkekw@gmail.com </p>
        <p><strong>Phone:</strong> +3186662281337</p>
        <p><strong>Address:</strong> Moscow</p>
    </div>
</div>
</body>
</html>
@endsection
