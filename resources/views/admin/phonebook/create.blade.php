@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Добавление номера в справочник телефонов</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('phonebook.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">ФИО / Служба</label>
                            <input type="text" class="form-control form-control-line" value="{{old('title')}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="info">Контактная информация</label>
                            <textarea class="form-control form-control-line" id="info" name="info" rows="5">{{old('info')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control form-control-line" id="description" name="description" rows="5">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group mb-5">
                            <label for="category">Категория</label>
                            <select name="category" id="category" class="form-control form-control-line">
                                <option value="" disabled selected>Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('phonebook.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать номер</button>
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