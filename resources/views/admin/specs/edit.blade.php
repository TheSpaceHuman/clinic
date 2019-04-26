@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Обновление специалиации</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('spec.update', $spec->id)}}">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control form-control-line" value="{{$spec->title}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea type="text" class="form-control form-control-line" id="description" name="description">{{$spec->description}}</textarea>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('spec.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Обновить специализацию</button>
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