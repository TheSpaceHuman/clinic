@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Все задачи</h3>
                    <div class="button-group">
                        <a href="{{route('task.create')}}" class="btn waves-effect waves-light btn-primary">Добавить задачу</a>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Все задачи</h4>
                    <div class="table-responsive m-t-40">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Поставденая задача</th>
                                <th>Отчет</th>
                                <th>Статус</th>
                                <th>Время постановки</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->getMessage()}}</td>
                                    <td>
                                        {{$task->getStatus()}}
                                        @if($task->status == '2')
                                            <span>{{ $task->getTimeFinishTask() }}</span>
                                        @endif
                                    </td>
                                    <td>{{$task->getTimeCreate()}}</td>
                                    <td>
                                        <a href="{{route('task.edit', ['id' => $task->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                        <form action="{{route('task.destroy', ['id' => $task->id])}}" method="POST" id="destroy-btn">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button  data-toggle="tooltip" data-original-title="Удалить" type="submit"> <i class="fas fa-window-close text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {!! $tasks->links() !!}
            </div>
        </div>
    </div>
@endsection