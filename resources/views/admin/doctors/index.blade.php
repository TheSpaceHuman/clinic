@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Доктора</h3>
                            <div class="button-group">
                                <a href="{{route('doctors.create')}}" class="btn waves-effect waves-light btn-primary">Добавить доктора</a>
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <form action="{{ route('doctors.index') }}" method="get" class="row">
                                <div class="form-group col-9 m-0">
                                    <input type="text" name="s" class="form-control" placeholder="Введите имя доктора" value="{{ isset($s) ? $s : '' }}">
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
                    <h4 class="card-title">Таблица докторов</h4>
                    <div class="table-responsive m-t-40">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Аватар</th>
                                <th>ФИО</th>
                                <th>Категория</th>
                                <th>Услуга</th>
                                <th>Филиалы</th>
                                <th>Специализация</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                    <tr>
                                        <td>{{$doctor->id}}</td>
                                        <td><img src="{{$doctor->getImage()}}" class="circle-img" alt="{{$doctor->name}}"></td>
                                        <td>{{$doctor->name}}</td>
                                        <td>{{$doctor->getCategoryTitle()}}</td>
                                        <td>
                                            {{$doctor->getServiceTitle()}}
                                        </td>
                                        <td>{{$doctor->getBranchTitle()}}</td>
                                        <td>{{$doctor->getSpecTitle()}}</td>
                                        <td>
                                            <a href="{{route('doctors.edit', ['id' => $doctor->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                            <form action="{{route('doctors.destroy', ['id' => $doctor->id])}}" method="POST" id="destroy-btn">
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
                {!! $doctors->appends(['s' => $s])->links() !!}
            </div>
        </div>
    </div>
@endsection