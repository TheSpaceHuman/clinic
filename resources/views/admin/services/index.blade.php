@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Услуги</h3>
                            <div class="button-group">
                                <a href="{{route('service.create')}}" class="btn waves-effect waves-light btn-primary">Добавить услугу</a>
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <form action="{{ route('service.index') }}" method="get" class="row">
                                <div class="form-group col-9 m-0">
                                    <input type="text" name="s" class="form-control" placeholder="Введите название услуги или код услуги" value="{{ isset($s) ? $s : '' }}">
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
                    <h4 class="card-title">Таблица услуг</h4>
                    <div class="table-responsive m-t-40">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Код</th>
                                <th class="d-none">Стоимость</th>
                                <th>Наличие</th>
                                <th>Назначеные доктора</th>
                                <th>Категория</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->id}}</td>
                                    <td>{{$service->title}}</td>
                                    <td>{{$service->code}}</td>
                                    <td class="d-none">{{$service->price}}</td>
                                    <td class="text-center">{{$service->checkStatus()}}</td>
                                    <td style="white-space: nowrap;">
                                        {{$service->getDoctorsTitle()}}
                                    </td>
                                    <td>{{$service->getCategoryTitle()}}</td>
                                    <td>
                                        <a href="{{route('service.edit', ['id' => $service->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                        <form action="{{route('service.destroy', ['id' => $service->id])}}" method="POST" id="destroy-btn">
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
                {!! $services->appends(['s' => $s])->links() !!}
            </div>
        </div>
    </div>
@endsection