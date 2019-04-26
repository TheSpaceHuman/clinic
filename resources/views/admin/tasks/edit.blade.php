@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Обновление задачи</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('task.update', $task->id)}}">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Название задачи</label>
                            <input type="text" class="form-control form-control-line" value="{{ $task->title }}" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание задачи</label>
                            <textarea rows="5" id="description" name="description" class="form-control">{{ $task->description }}</textarea>
                        </div>

                        <div class="form-group py-4">
                            <label for="executor" class="control-label">Выберите кому назначить задачу</label>
                            <select class="form-control custom-select" name="executor" id="executor">
                                <option hidden selected disabled>Выберите нужного секретаря</option>
                                @foreach($executors as $secretary)
                                    <option value="{{ $secretary->id }}" {{ $task->executor_id == $secretary->id ? 'selected' : ''}}>{{ $secretary->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="revision" class="filled-in chk-col-purple" name="revision" >
                            <label for="revision">Вернуть на доработку</label>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('task.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Обновить задачу</button>
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