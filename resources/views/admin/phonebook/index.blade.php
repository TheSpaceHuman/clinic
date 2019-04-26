@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Экстренные телефоны</h3>
                            <div class="button-group">
                                <a href="{{route('phonebook.create')}}" class="btn waves-effect waves-light btn-primary">Добавить телефон</a>
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <form action="{{ route('phonebook.index') }}" method="get" class="row">
                                <div class="form-group col-9 m-0">
                                    <input type="text" name="s" class="form-control" placeholder="Введите название, контактную информацию или категорию" value="{{ isset($s) ? $s : '' }}">
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
                    <h3 class="card-title">Таблица категорий</h3>
                    <div class="table-responsive m-t-40">
                        <table  class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ФИО / Служба</th>
                                    <th>Контактная информация</th>
                                    <th>Описание</th>
                                    <th>Категория</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phones as $phone)
                                    <tr>
                                        <td>{{ $phone->id }}</td>
                                        <td>{{ $phone->title }}</td>
                                        <td>{{ $phone->info }}</td>
                                        <td>{{ $phone->description}}</td>
                                        <td>{{ $phone->category}}</td>
                                        <td>
                                            <a href="{{route('phonebook.edit', $phone)}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                            <form action="{{route('phonebook.destroy', $phone)}}" method="POST" id="destroy-btn">
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
                {!! $phones->appends(['s' => $s])->links() !!}
            </div>
        </div>
    </div>
@endsection