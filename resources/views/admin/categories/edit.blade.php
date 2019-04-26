@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Создание категории</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('category.update', $category->id)}}">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Название категории</label>
                            <input type="text" class="form-control form-control-line" value="{{$category->title}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание категории</label>
                            <input type="text" class="form-control form-control-line" id="description" name="description" value="{{$category->description}}">
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('category.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-warning">Обновить категорию</button>
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