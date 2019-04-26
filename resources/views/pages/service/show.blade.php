@extends('layouts.services')

@section('content')
    <aside class="sidebar-left col-md-3 p-3">
        <ul class="list-items lvl-1">
            @foreach ($categories  as $categoryAside)
                <li class="list-item dropdown {{ Request::is('services/category/' . $categoryAside->slug) ? 'active' : '' }}">
                    <a class="link-def" href="services/category/{{$categoryAside->slug}}"
                       aria-expanded="false" aria-controls="collapseExample{{$categoryAside->id}}">{{$categoryAside->title}}</a>
                    <div class="collapse" id="collapseExample{{$categoryAside->id}}">
                        <ul class="list-items lvl-2">
                            @foreach ($categoryAside->service  as $serviceAside)
                                <li class="list-item {{ Request::is('services/service/' . $serviceAside->slug) ? 'active' : '' }}">
                                    <a class="link-def" href="services/service/{{$serviceAside->slug}}">{{$serviceAside->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
    <div class="content col-12 col-md-9">
        <table class="table-responsive table table-custom" id="myTable">
            <thead>
            <tr>
                <th scope="col">Аватар</th>
                <th scope="col">Фио врача</th>
                <th scope="col">Специализация врача</th>
                <th scope="col">Услуги | Код услуги | Возраст</th>
                <th scope="col">Место работы</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($category->doctor as $doctor)
                <tr>
                    <td><div class="doc_item_img"><img src="{{ $doctor->getImage() }}"></div></td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>
                        @foreach($doctor->service as $service)
                            {{ $service->title }} |  {{ $service->code }} | {{ $service->old ? $service->old : '0+'}} <br>
                        @endforeach
                    </td>
                    <td>{{ $doctor->city }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection