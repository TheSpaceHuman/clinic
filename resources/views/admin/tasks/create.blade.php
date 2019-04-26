@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Создание задачи</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('task.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Название задачи</label>
                            <input type="text" class="form-control form-control-line" value="{{old('title')}}" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание задачи</label>
                            <textarea rows="5" id="description" name="description" class="form-control">{{old('description')}}</textarea>
                        </div>

                        <div class="form-group py-4">
                            <label for="executor" class="control-label">Выберите кому назначить задачу</label>
                            <select class="form-control custom-select" name="executor" id="executor">
                                <option hidden selected disabled>Выберите нужного секретаря</option>
                                @foreach($executors as $secretary)
                                    <option value="{{ $secretary->id }}">{{ $secretary->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('task.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать задачу</button>
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