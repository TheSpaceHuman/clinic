@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Создание нового пользователя</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('users.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Имя пользователя</label>
                            <input type="text" class="form-control form-control-line" value="{{old('name')}}" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control-line" id="email" name="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="text" class="form-control form-control-line"  id="password" name="password" value="{{old('password')}}">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="is_admin" class="filled-in chk-col-red" name="is_admin">
                            <label for="is_admin">Администратор</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="is_secretary" class="filled-in chk-col-blue" name="is_secretary">
                            <label for="is_secretary">Секретарь</label>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('users.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать нового пользователя</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @include('admin._error')

                </div>
            </div>
        </div>
    </div>
@endsection