@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin._error')

                    <h3 class="card-title">Создание раздела</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('art-categories.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control form-control-line" value="{{old('title')}}" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="description">Краткое описание</label>
                            <textarea rows="5" id="description" name="description" class="form-control">{{old('description')}}</textarea>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('art-categories.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать раздел</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection