@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin._error')
                    <h4 class="card-title">Создание услуги</h4>

                    <form class="form-material m-t-40" method="POST" action="{{route('service.update', $service->id)}}">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Название услуги</label>
                            <input type="text" class="form-control form-control-line" value="{{$service->title}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="code">Код услуги</label>
                            <input type="number" class="form-control form-control-line" id="code" name="code" value="{{$service->code}}">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id" class="form-control" data-placeholder="Выберите категорию">
                                <option value="" disabled>Выберите категорию</option>
                                @foreach($categories as $category_id => $category_title)
                                    <option value="{{ $category_id }}" {{ $service->category->id === $category_id ? 'selected' : '' }}>{{ $category_title }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="price">Цена услуги</label>
                            <input type="number" class="form-control form-control-line" id="price" name="price" value="{{ $service->price }}">
                        </div>

                        <div class="form-group">
                            <label>Слова синонимы (указывать через запятую)</label>
                            <textarea class="form-control" rows="5" name="words">{{ $service->words }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="status" name="status" class="filled-in chk-col-purple"  {{ $service->status == "1" ? 'checked' : ''}}>
                            <label for="status">В наличии</label>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('service.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-warning">Обновить услугу</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection