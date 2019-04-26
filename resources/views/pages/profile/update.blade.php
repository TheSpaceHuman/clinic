@extends('layouts.profile')

@section('content')
    <div class="content col-12 col-md-12">
        <div class="row">
            <div class="offset-3 col-9 py-4">
                @include('admin._error')
                <form action="{{ route('user.profile.update', ['id' => $user->id]) }}"  method="POST">
                    @method('PUT')
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Новый пароль</label>
                        <input type="password" class="form-control"  id="password" name="password" value="">
                    </div>

                    <div class="form-group py-5 d-flex justify-content-end">
                        <a href="{{ route('index') }}" class="btn btn-outline-secondary mx-2">Назад</a>
                        <button type="submit" class="btn btn-outline-primary">Редактировать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection