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
        @if($resume)
            <form action="{{ route('resume.delete') }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Resume</button>
            </form>
        @endif
    </div>
    <style>
        .container {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
            background-color: #f8f9fa; /* Светлый серый цвет */
        }

        .card-body {
            padding: 20px;
        }

        .resume-info {
            margin-bottom: 20px;
        }

        /* Заголовки */
        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff; /* Синий цвет */
        }

        h3 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #28a745; /* Зелёный цвет */
        }

        /* Список навыков */
        .resume-info ul {
            list-style-type: none;
            padding-left: 0;
        }

        .resume-info li {
            display: inline; /* Отображать элементы в одну строку */
            margin-right: 10px; /* Добавить небольшое расстояние между навыками */
            color: #6c757d; /* Серый цвет */
        }

        .resume-info li:not(:last-child) {
            border-right: 1px solid #6c757d; /* Добавляем разделитель между навыками */
            padding-right: 5px; /* Небольшое расстояние между навыками и разделителем */
        }

        /* Задаем цвет и стиль разделителя для последнего элемента */
        .resume-info li:last-child {
            border-right: none; /* Убираем разделитель у последнего навыка */
        }

        /* Кнопка удаления резюме */
        .btn-danger {
            margin-top: 20px;
            background-color: #dc3545; /* Красный цвет */
            border-color: #dc3545; /* Красный цвет */
            color: #fff; /* Белый цвет */
        }

        /* Линия-разделитель */
        hr.style13 {
            height: 10px;
            border: 0;
            background-color: #ffc107; /* Жёлтый цвет */
        }
    </style>
@endsection
