@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin._error')

                    <h3 class="card-title">Создание статьи</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('article.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control form-control-line" value="{{old('title')}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="author">Назначить на услугу</label>
                            {{Form::select('author[]',
                                 $services,
                                 null,
                                 ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Назначте услугу'])
                            }}
                        </div>

                        <div class="form-group">
                            <label for="article_category_id">Назначить раздел</label>
                            {{Form::select('article_category_id',
                                 $article_categories,
                                 null,
                                 ['class' => 'form-control select2', 'data-placeholder'=>'Назначте раздел'])
                            }}
                        </div>

                        <div class="form-group">
                            <label for="introtext">Краткое описание</label>
                            <textarea rows="5" id="introtext" name="introtext" class="form-control">{{old('introtext')}}</textarea>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Контент</h4>
                                <div class="form-group">
                                    <textarea class="textarea_editor form-control" rows="15" placeholder="" name="content"></textarea>
                                </div>
                            </div>
                        </div>

{{--                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Test</h4>
                                <div class="form-group">
                                    <form method="post">
                                        <textarea id="summernote" name="editordata"></textarea>
                                    </form>
                                </div>
                            </div>
                        </div>--}}


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('article.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать статью</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection