@extends('layouts.analyzes')

@section('content')
    <div class="content col-12">
        <form action="{{route('page.analyze.index')}}" method="get" class="row">
            <div class="col-8">
                <p>Красным выделенные анализы, которых нет в наличии на данный момент!</p>
            </div>
            <div class="form-group col-3">
                <input type="text" class="form-control" placeholder="Введите название услуги" name="s" value="{{ isset($s) ? $s : '' }}">
            </div>
            <div class="form-group col-1">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success">Поиск</button>
                </div>
            </div>
        </form>
        <table class="table-responsive table table-custom">
            <thead>
            <tr>
                <th scope="col">Наименование услуги</th>
                <th scope="col">Цена</th>
                <th scope="col">3б,48 Рослаб</th>
                <th scope="col">Статус Пн-сб/вск</th>
                <th scope="col">Мытищи Пн-сб/вск</th>
                <th scope="col">Щелково Пн-сб/вск</th>
                <th scope="col">Пушкино</th>
                <th scope="col">Материал</th>
                <th scope="col">Статья</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($analyzes  as $analyze)

                <tr style="text-align: left; position: relative; {{ $analyze->show === '0' ? 'background-color: #ff6974;' : ''}}">
                    <td>{{ $analyze->title }}</td>
                    <td>{{ $analyze->price }}</td>
                    <td style="white-space: nowrap">{{ $analyze->branch_1 }}</td>
                    <td style="white-space: nowrap">{{ $analyze->branch_2 }}</td>
                    <td style="white-space: nowrap">{{ $analyze->branch_3 }}</td>
                    <td style="white-space: nowrap">{{ $analyze->branch_4 }}</td>
                    <td style="white-space: nowrap">{{ $analyze->branch_5 }}</td>
                    <td>{{ $analyze->material }}</td>
                    <td class="analyze_article-img-wrapper">{{ $analyze->showArticle() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $analyzes->links() !!}
        </div>
    </div>
@endsection