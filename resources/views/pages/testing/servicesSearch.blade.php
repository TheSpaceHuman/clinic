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
        <form action="{{route('page.service.search')}}" method="get" class="row">
            <div class="form-group col-4">
                <select class="service-select2 w-100" name="s" value="{{ isset($s) ? $s : '' }}">
                    <option></option>
                    @foreach($services as $service_id => $service)
                        <option value="{{ $service_id }}" {{  $s == $service_id ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-3">
                <input type="text" class="form-control" placeholder="Введите возраст" name="age" value="{{ isset($age) ? $age : '' }}">
            </div>
            <div class="form-group col-3">
                <select name="branch" class="form-control" value="{{ isset($branch) ? $branch : '' }}">
                    <option value="" selected disabled hidden>Выберите филиал</option>
                    @foreach($branches as $branch_id => $branch_title)
                        <option value="{{ $branch_id }}" {{ $branch == $branch_id ? 'selected' : '' }}>{{ $branch_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-2">
                <button class="btn btn-success">Искать</button>
            </div>
        </form>

        @isset($s)
            <div class="recommend-article">
                <h4 class="recommend__title">Рекомендовыные статьи</h4>
                <ol class="recommend-article__list">
                    @forelse($articles as $article)
                        <li class="article__item">
                            <a href="{{ route('page.article.show', ['slug' => $article->slug]) }}" class="article__item_link" target="_blank">{{ $article->title }}</a>
                        </li>
                    @empty
                        <p class="text-center">Статей не найдено</p>
                    @endforelse
                </ol>
            </div>
        @endisset

        <table class="table-responsive table table-custom" >
            <thead>
            <tr>
                <th scope="col">Аватар</th>
                <th scope="col">Фио врача</th>
                <th scope="col">Филиалы</th>
                <th scope="col">Специализация</th>
                <th scope="col" class="d-none">Услуги</th>
                <th scope="col" class="d-none">Возраст</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($doctors as $doctor)
                <tr style="text-align: left;{{ $doctor->getServiceSort($s) === '1' ? 'background-color: #ff6974;' : '' }}">
                    <td>
                        <div class="doc_item_img">
                            <a href="doctors/doctor/{{$doctor->slug}}"><img src="{{ $doctor->getImage() }}"></a>
                            <p class="text-white text-center">{{ $doctor->getServiceSort($s) === '1' ? 'Приоритетный врач' : '' }}</p>
                        </div>
                    </td>
                    <td class="{{ $doctor->getServiceSort($s) === '1' ? 'text-white' : '' }}"><a href="doctors/doctor/{{$doctor->slug}}">{{ $doctor->name }}</a></td>
                    <td class="{{ $doctor->getServiceSort($s) === '1' ? 'text-white' : '' }}">{{ $doctor->getBranchTitle() }}</td>
                    <td class="{{ $doctor->getServiceSort($s) === '1' ? 'text-white' : '' }}">{{ $doctor->getSpecTitle() }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $doctors->appends(['s' => $s, 'age' => $age, 'branch' => $branch])->links() !!}
        </div>
    </div>
@endsection