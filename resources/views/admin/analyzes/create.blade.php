@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Создание анализа</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('analyze.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Название услуги</label>
                            <input type="text" class="form-control form-control-line" value="{{old('title')}}" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input type="number" class="form-control form-control-line" value="{{old('price', '0')}}" id="price" name="price">
                        </div>

                        <div class="form-group">
                            <label for="branch_1">3б,48 Рослаб</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_1')}}" id="branch_1" name="branch_1">
                        </div>

                        <div class="form-group">
                            <label for="branch_2">Статус Пн-сб/вск</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_2')}}" id="branch_2" name="branch_2">
                        </div>
                        <div class="form-group">
                            <label for="branch_3">Мытищи Пн-сб/вск</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_3')}}" id="branch_3" name="branch_3">
                        </div>
                        <div class="form-group">
                            <label for="branch_4">Щелково Пн-сб/вск</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_4')}}" id="branch_4" name="branch_4">
                        </div>
                        <div class="form-group">
                            <label for="branch_5">Пушкино</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_5')}}" id="branch_5" name="branch_5">
                        </div>
                        <div class="form-group d-none">
                            <label for="branch_6">Филиал 6</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_6')}}" id="branch_6" name="branch_6">
                        </div>
                        <div class="form-group d-none">
                            <label for="branch_7">Филиал 7</label>
                            <input type="text" class="form-control form-control-line" value="{{old('branch_7')}}" id="branch_7" name="branch_7">
                        </div>

                        <div class="form-group">
                            <label for="material">Материал</label>
                            <input type="text" class="form-control form-control-line" value="{{old('material')}}" id="material" name="material">
                        </div>

                        <div class="form-group">
                            <label for="article_id">Назначить статью</label>
                            <select id="article_id" name="article_id" class="form-control select2" data-placeholder="Выберите статью">
                                <option value=""></option>
                                @foreach($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->title }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('analyze.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать анализ</button>
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