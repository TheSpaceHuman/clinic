@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Создание категории</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('news.update', $news)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Название новости</label>
                            <input type="text" class="form-control form-control-line" value="{{$news->title}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="content">Контент</label>
                            <div class="form-group">
                                <textarea class="textarea_editor form-control" rows="15" placeholder="" name="content" id="content">{{$news->content}}</textarea>
                            </div>
                        </div>
                       {{-- <div class="form-group">
                            <label for="image">Картинка новости</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename">{{ $news->image }}</span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" id="image"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a> </div>
                        </div>--}}

                        {{--<div class="form-group mb-5 pb-5">
                            <label for="category">Категория</label>
                            <select class="form-control" id="category" name="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{$news->category == $category ? 'selected' : ''}}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>--}}


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('news.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-warning">Обновить новость</button>
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