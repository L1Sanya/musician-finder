@extends('nav')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musician Finder</title>
    <style>
        .body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;

        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 48px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome to Musician Finder</h1>
</header>

<div class="container">
    <div class="card">
        <h2>About Us</h2>
        <p>Musician Finder is the premier platform for connecting musicians with opportunities and each other. Whether you're a solo artist, part of a band, or looking to collaborate, we've got you covered.</p>
    </div>

    <div class="card">
        <h2>Find Musicians</h2>
        <p>Discover talented musicians in your area or worldwide. Search by instrument, genre, skill level, and more. Connect with fellow artists and start making music together.</p>
    </div>

    <div class="card">
        <h2>Get Discovered</h2>
        <p>Showcase your talent to the world. Create a profile, upload your music, and let opportunities find you. Whether you're looking for gigs, collaborations, or just exposure, Musician Finder is your stage.</p>
    </div>

    <div class="card">
        <h2>Join the Community</h2>
        <p>Connect with like-minded musicians, share your experiences, and learn from others. Our community is supportive, diverse, and passionate about music. Join us today and be part of something special.</p>
    </div>
</div>

</body>
</html>
@endsection
