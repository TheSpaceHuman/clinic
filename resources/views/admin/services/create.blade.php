@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Создание услуги</h4>
                    <form class="form-material m-t-40" method="POST" action="{{route('service.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Название услуги</label>
                            <input type="text" class="form-control form-control-line" value="{{old('title')}}" id="title" name="title" >
                        </div>
                        <div class="form-group">
                            <label for="code">Код услуги</label>
                            <input type="number" class="form-control form-control-line" id="code" name="code" value="{{old('code', '0')}}">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            {{Form::select('category_id',
                            $categoriesToSelect,
                            null,
                            ['class' => 'form-control','data-placeholder'=>'Выберите приоритетного'])
                            }}
                        </div>

                        <div class="form-group">
                            <label for="price">Цена услуги</label>
                            <input type="number" class="form-control form-control-line" id="price" name="price" value="{{old('price', '0')}}">
                        </div>

                        <div class="form-group">
                            <label>Слова синонимы (указывать через запятую)</label>
                            <textarea class="form-control" rows="5" name="words"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="status" class="filled-in chk-col-purple" name="status" checked>
                            <label for="status">В наличии</label>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('service.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать услугу</button>
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
