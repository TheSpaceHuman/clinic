@extends('layouts.doctors')


@section('content')
    <aside class="sidebar-left col-md-3 p-3">
        <ul class="list-items lvl-1">
            @foreach ($specs  as $spec)
                <li class="list-item dropdown {{ Request::is('doctors/spec/' . $spec->slug) ? 'active' : '' }}">
                    <a class="link-def" href="doctors/spec/{{$spec->slug}}"
                       aria-expanded="false" aria-controls="{{$spec->id}}">{{$spec->title}}</a>
                    <div class="collapse" id="{{$spec->id}}">
                        <ul class="list-items lvl-2">
                            @foreach ($spec->doctor  as $specDoctor)
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

        <div class="doctor-card-items">
            @foreach ($doctors  as $doctor)
                <div class="doctor-card">
                    <div class="doc_item_img doctor-card_img">
                        <a href="doctors/doctor/{{$doctor->slug}}"><img src="{{ $doctor->getImage() }}"></a>
                    </div>
                    <a href="doctors/doctor/{{$doctor->slug}}">
                        <h4 class="text-center doctor-card_title">{{ $doctor->name }}</h4>
                    </a>

                    <p class="text-center text-success doctor-card_desc">{{ $doctor->getSpecTitle() }}</p>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {!! $doctors->links() !!}
        </div>
    </div>



@endsection