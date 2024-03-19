@extends('nav')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
          crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Resume Form</title>

    <script src="index.js">

    </script>
</head>
<body>

<div class="container mt-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-sm-7 col-md-9 col-lg-9" >
            <div class="card shadow border-0">
                <div class="card-body" >

                    <h1 class="text-center"><i class="fa fa-briefcase icon1" aria-hidden="true" ></i>    Candidate Resume</h1>
                    <hr class="style13">
                    <form action="custom-resume" method="post" enctype="multipart/form-data">

                        <!-- starting of curriculum vitae and cover letter section -->

                        <!-- end of curriculum vitae and cover letter section -->
                        @csrf
                        <input type="hidden" value="{{Auth::id()}}" name="user_id" required>

                        <br>

                        <hr class="style13">

                        <!-- start of working preference -->

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="skills" class="extraeffect">Skills</label>
                                <select class="form-control" name="skills[]" id="skills" multiple>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="experience" class="extraeffect"> Experience</label>
                                <input type="text" class="form-control" placeholder="experience" id="experience" name="experience">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info"> <i class="fa fa-plus icon2" aria-hidden="true"></i> Add More</button>
                        <!-- end of working preference -->

                        <br>
                        <hr class="style13">

                        <!-- start of experience -->
                        <hr>


                        <div class="form-group">
                            <label for="info" class="extraeffect">Info</label>
                            <textarea name="info" class="form-control" id="info" cols="30" rows="4">123123</textarea>
                        </div>


                        <!-- end of experience -->
                        <!-- end of skill -->

                        <br>
                        <hr class="style13">


                        <!-- submit and edit button -->

                        <div class="wrapper">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check icon2" aria-hidden="true"></i></i> Submit</button>
                            <button type="submit" class="btn btn-danger" style="width: 110px;"> <i class="fa fa-id-badge" aria-hidden="true" ></i> Edit </button>

                        </div>

                    </form>


                </div>
            </div>
        </div>
        <div class="col"> </div>
    </div>
</div>

</body>
</html>

<style>
    body
    {
        background: #f5f5f5 !important;
        font-family: "PT Sans", sans-serif;
        margin-bottom: 60px;
    }

    select
    {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0;
        font-weight: 500;
    }

    .icon1
    {
        font-size: 39px;
        display: inline;
        color: brown;
    }

    .icon2
    {
        font-size: 15px;
    }

    hr.style13
    {
        height: 10px;
        border: 0;
        box-shadow: 0 10px 10px -10px #8c8b8b inset;
    }

    .custom-file-label
    {
        font-family: Arial, Helvetica, sans-serif;
    }


    ::placeholder
    {
        font-weight: 500;
    }


    .extraeffect
    {
        font-weight: 700;
        color: #495677;
    }


    .wrapper
    {
        text-align: center;
    }
</style>

<script>
    $(document).ready(function(){

        /*! Fades in page on load */
        $('body').css('display', 'none');
        $('body').fadeIn(4000);

    });
</script>
@endsection
