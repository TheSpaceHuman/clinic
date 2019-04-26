@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Aнализы</h3>
                            <div class="button-group">
                                <a href="{{route('analyze.create')}}" class="btn waves-effect waves-light btn-primary">Добавить анализ</a>
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <form action="{{ route('analyze.index') }}" method="get" class="row">
                                <div class="form-group col-9 m-0">
                                    <input type="text" name="s" class="form-control" placeholder="Введите название анализа или его стоимость" value="{{ isset($s) ? $s : '' }}">
                                </div>
                                <div class="form-group col-3 m-0">
                                    <button type="submit" class="btn waves-effect waves-light btn-success">Поиск</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Таблица анализов</h4>
                    <div class="table-responsive m-t-40">
                        <table  class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>3б,48 Рослаб</th>
                                <th>Статус Пн-сб/вск</th>
                                <th>Мытищи Пн-сб/вск</th>
                                <th>Щелково Пн-сб/вск</th>
                                <th>Пушкино</th>
                                <th>Материал</th>
                                <th width="150">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($analyzes as $analyze)
                                <tr>
                                    <td>{{$analyze->id}}</td>
                                    <td>{{ $analyze->title }}</td>
                                    <td>{{ $analyze->price }}</td>
                                    <td style="white-space: nowrap">{{ $analyze->branch_1 }}</td>
                                    <td style="white-space: nowrap">{{ $analyze->branch_2 }}</td>
                                    <td style="white-space: nowrap">{{ $analyze->branch_3 }}</td>
                                    <td style="white-space: nowrap">{{ $analyze->branch_4 }}</td>
                                    <td style="white-space: nowrap">{{ $analyze->branch_5 }}</td>
                                    <td>{{ $analyze->material }}</td>
                                    <td>
                                        <a href="{{route('analyze.edit', ['id' => $analyze->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                        <form action="{{route('article.switchShow', ['id' => $analyze->id])}}" method="POST" id="show-btn" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            @if( $analyze->show === '1')
                                            <button  data-toggle="tooltip" data-original-title="Активность" type="submit" style="background-color: transparent;border: none;">
                                                <i class="fas fa-eye" style="color: #000;"></i>
                                            </button>
                                            @else
                                            <button  data-toggle="tooltip" data-original-title="Активность" type="submit" style="background-color: transparent;border: none;">
                                                <i class="fas fa-eye" style="color: #ccc;"></i>
                                            </button>
                                            @endif
                                        </form>

                                        <form action="{{route('analyze.destroy', ['id' => $analyze->id])}}" method="POST" id="destroy-btn">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button  data-toggle="tooltip" data-original-title="Удалить" type="submit"> <i class="fas fa-window-close text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {!! $analyzes->appends(['s' => $s])->links() !!}
            </div>
        </div>
    </div>
@endsection