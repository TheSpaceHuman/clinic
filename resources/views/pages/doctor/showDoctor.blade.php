@extends('layouts.doctors')


@section('content')
    <aside class="sidebar-left col-md-3 p-3">
        <ul class="list-items lvl-1">
            @foreach ($specs  as $specMenu)
                <li class="list-item dropdown {{ Request::is('doctors/spec/' . $specMenu->slug) ? 'active' : '' }}">
                    <a class="link-def" href="doctors/spec/{{$specMenu->slug}}"
                       aria-expanded="false" aria-controls="{{$specMenu->id}}">{{$specMenu->title}}</a>
                    <div class="collapse" id="{{$specMenu->id}}">
                        <ul class="list-items lvl-2">
                            @foreach ($specMenu->doctor  as $specDoctor)
                                <li class="list-item {{ Request::is('doctors/spec/' . $specDoctor->slug) ? 'active' : '' }}">
                                    <a class="link-def" href="doctors/doctor/{{$specDoctor->slug}}">{{$specDoctor->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
    <div class="content col-12 col-md-9">
        <div class="row">
            <div class="col-4  d-flex justify-content-center align-items-start">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ $doctor->getImage() }}" alt="{{ $doctor->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $doctor->name }}</h5>
                        <div class="card-text my-3"> {{ $doctor->getDescription() }} </div>
                        @isset($doctor->link)
                            <a href="{{$doctor->link}}" class="card-link">Посмотреть на сайте</a>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="col-8">
                <table class="table-responsive table table-custom">
                    <thead>
                    <tr>
                        <th scope="col">Филиалы</th>
                        <th scope="col">Специализация</th>
                        <th scope="col">Выездной?</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr style="text-align: left;">

                        <td>{{ $doctor->getBranchTitle() }}</td>
                        <td>{{ $doctor->getSpecTitle() }}</td>
                        <td>{{ $doctor->getExit() }}</td>

                    </tr>

                    </tbody>
                </table>

                <table class="table-responsive table table-custom">
                    <thead>
                    <tr>
                        <th scope="col">Название услуги</th>
                        <th scope="col">Время выполнения услуги (мин.)</th>
                        <th scope="col">Возраст</th>
                        <th scope="col">Код услуги</th>
                        <th scope="col">Наличие услуги</th>
                    </tr>
                    </thead>

                    <tbody>

                    {{ $doctor->getServiceTitleTimeCode() }}
                    {{--<td>{{ $doctor-> }}</td>--}}
                    {{--<td>{{ $doctor->getServiceTitle() }}</td>--}}
                    {{--<td>{{ $doctor->getServiceTime() }}</td>--}}
                    {{--<td>{{ $doctor->getServiceCode() }}</td>--}}

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection