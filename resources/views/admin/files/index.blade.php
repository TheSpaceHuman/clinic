@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-title">Файлы</h3>
                            <p>Пожалуйста, не удаляйте файл "schedule" - этот документ отвечает за График администраторов.</p>
                            <div class="button-group">
                                <a href="{{route('files.create')}}" class="btn waves-effect waves-light btn-primary">Добавить новый файл</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Таблица услуг</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Файл</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{$file->id}}</td>
                                <td>{{$file->title}}</td>
                                <td>{{$file->link}}</td>
                                <td>
                                    <a href="{{route('files.edit', ['id' => $file->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                    <a href="{{$file->link}}" data-toggle="tooltip" data-original-title="Скачать"><i class="mdi mdi-download" style="font-size: 23px;"></i> </a>

                                    <form action="{{route('files.destroy', ['id' => $file->id])}}" method="POST" id="destroy-btn">
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
    </div>
@endsection