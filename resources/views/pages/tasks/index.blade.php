@extends('layouts.task')


@section('content')
    <div class="content col-12">
        <div class="tasks">
            @forelse ($tasks as $task)
                <div class="tasks-item">
                    <form action="{{ route('page.task.update', ['id' =>  $task->id]) }}" class="tasks-item_form">
                        @method('PUT')
                        {{ csrf_field() }}
                        <h4 class="tasks-item_title">Название задачи</h4>
                        <p class="tasks-item_title-content">{{ $task->title }}</p>

                        <h4 class="tasks-item_description">Описание задачи</h4>
                        <p class="tasks-item_description-content">{{ $task->description }}</p>

                        <h4 class="tasks-item_status">Статус задачи</h4>

                        <div class="d-flex align-items-center">
                            <div class="form-check p-3">
                                <input class="form-check-input" type="radio" name="status" id="task-{{  $task->id }}-status-1" value="0" {{ $task->Status0() ? 'checked' : '' }}>
                                <label class="form-check-label" for="task-{{  $task->id }}-status-1">Поставлена</label>
                            </div>
                            <div class="form-check p-3">
                                <input class="form-check-input" type="radio" name="status" id="task-{{  $task->id }}-status-2" value="1" {{ $task->Status1() ? 'checked' : '' }}>
                                <label class="form-check-label" for="task-{{  $task->id }}-status-2">В работе</label>
                            </div>
                            <div class="form-check p-3">
                                <input class="form-check-input" type="radio" name="status" id="task-{{  $task->id }}-status-3" value="2" {{ $task->Status2() ? 'checked' : '' }}>
                                <label class="form-check-label" for="task-{{  $task->id }}-status-3">Выполнена</label>
                            </div>
                        </div>

                        <h4 class="tasks-item_message">Отчет выполнения задачи</h4>
                        <div class="tasks-item_message-content">
                            <textarea rows="5" class="form-control" name="message">{{ $task->getMessage() }}</textarea>
                        </div>
                        <div class="d-flex justify-content-center py-4">
                            <button type="submit" class="btn btn-outline-success">Отправить</button>
                        </div>

                    </form>
                </div>
            @empty
                <p class="py-5 text-center">У вас нет новых задач</p>
            @endforelse
        </div>
    </div>
@endsection