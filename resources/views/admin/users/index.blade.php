@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            @if(session('admin.protected'))
                <div class="alert alert-warning text-center">
                    {{ session('admin.protected') }}
                </div>
            @endif
            @if(session('user.update.protected'))
                <div class="alert alert-warning text-center">
                    {{ session('user.update.protected') }}
                </div>
            @endif
            <!-- Top card -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Пользователи</h3>
                            <div class="button-group">
                                <a href="{{route('users.create')}}" class="btn waves-effect waves-light btn-primary">Добавить пользователя</a>
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <form action="{{ route('users.index') }}" method="get" class="row">
                                <div class="form-group col-9 m-0">
                                    <input type="text" name="s" class="form-control" placeholder="Введите имя или email пользователя" value="{{ isset($s) ? $s : '' }}">
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
                    <h3 class="card-title">Таблица пользователей</h3>
                    <div class="table-responsive m-t-40">
                        <table  class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Роль</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <span class="badge badge-primary">User</span>
                                            {!! $user->is_admin == 1 ? '<span class="badge badge-danger">Admin</span>' : '' !!}
                                            {!! $user->is_secretary == 1 ? '<span class="badge badge-success">Secretary</span>' : '' !!}
                                        </td>
                                        <td>
                                            <a href="{{route('users.edit', ['id' => $user->id])}}" data-toggle="tooltip" data-original-title="Edit"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                            <form action="{{route('users.destroy', ['id' => $user->id])}}" method="POST" id="destroy-btn">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button  data-toggle="tooltip" data-original-title="Close" type="submit"> <i class="fas fa-window-close text-danger"></i></button>
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
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection