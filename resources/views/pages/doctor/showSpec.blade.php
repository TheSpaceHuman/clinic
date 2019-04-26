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
        <form action="{{route('page.doctor.search')}}" method="get" class="row">
            <div class="form-group col-5">
                <input type="text" class="form-control" placeholder="Введите имя доктора" name="s" value="{{ isset($s) ? $s : '' }}">
            </div>
            <div class="form-group col-5">
                <input type="text" class="form-control" placeholder="Введите возраст" name="age" value="{{ isset($age) ? $age : '' }}">
            </div>
            <div class="form-group col-2">
                <button class="btn btn-success">Искать</button>
            </div>
        </form>
        <table class="table-responsive table table-custom">
            <thead>
            <tr>
                <th scope="col">Аватар</th>
                <th scope="col">Фио врача</th>
                <th scope="col">Филиалы</th>
                <th scope="col">Специализация</th>
                <th scope="col">Выездной?</th>
                <th scope="col" class="d-none">Услуги</th>
                <th scope="col" class="d-none">Возраст</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($spec->doctor  as $doctor)
                <tr style="text-align: left;">
                    <td>
                        <div class="doc_item_img">
                            <a href="doctors/doctor/{{$doctor->slug}}"><img src="{{ $doctor->getImage() }}"></a>
                        </div>
                    </td>
                    <td><a href="doctors/doctor/{{$doctor->slug}}">{{ $doctor->name }}</a></td>
                    <td>{{ $doctor->getBranchTitle() }}</td>
                    <td>{{ $doctor->getSpecTitle() }}</td>
                    <td>{{ $doctor->getExit() }}</td>

                    <td class="d-none">
                        {{ $doctor->getServiceTitle() }}
                    </td>
                    <td class="d-none">
                        {{ $doctor->getServiceOldRange() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
       {{-- <div class="d-flex justify-content-center">
            {!! $spec->links() !!}
        </div>--}}
    </div>
@endsection