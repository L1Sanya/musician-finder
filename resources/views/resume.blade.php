@extends('nav')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col"></div>
            <div class="col-sm-7 col-md-9 col-lg-9">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h1 class="text-center"><i class="fa fa-briefcase icon1" aria-hidden="true"></i> Candidate Resume</h1>
                        <hr class="style13">
                        <div class="resume-info">
                            <h3>Experience:</h3>
                            <p>{{ $resume->experience }}</p>

                            <h3>Skills:</h3>
                            <ul>
                                @foreach($resume->skills as $skill)
                                    <li>{{ $skill->name }}</li>
                                @endforeach
                            </ul>

                            <h3>Info:</h3>
                            <p>{{ $resume->info }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
