@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Обновление статью</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('article.update', $article->id)}}">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control form-control-line" value="{{$article->title}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="author">Назначите на услугу</label>
                            {{Form::select('author[]',
                                  $services,
                                  $selectServices,
                                  ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите услугу'])
                             }}
                        </div>

                        <div class="form-group">
                            <label for="article_category_id">Назначить раздел</label>
                            <select name="article_category_id" id="article_category_id" data-placeholder="Назначте раздел" class="form-control select2">
                                <option value=""></option>
                                @foreach($article_categories as $category)
                                    <option value="{{$category['id']}}" {{ $article['article_category_id'] == $category['id'] ? 'selected' : '' }}>{{ $category['title']}}</option>
                                @endforeach
                            </select>
                            {{--{{Form::select('article_category_id',
                                 $article_categories,
                                 $select_article_category,
                                 ['class' => 'form-control select2', 'data-placeholder'=>'Назначте раздел'])
                            }}--}}
                        </div>

                        <div class="form-group">
                            <label for="introtext">Краткое описание</label>
                            <textarea rows="5" id="introtext" name="introtext" class="form-control">{{$article->introtext}}</textarea>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Контент</h4>
                                <div class="form-group">
                                    <textarea class="textarea_editor form-control" rows="15" placeholder="" name="content">{{ $article->content }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('article.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Обновить статью</button>
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