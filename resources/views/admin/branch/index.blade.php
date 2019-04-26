@extends('admin.layout')

@section('content')
    <div class="row">

        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Все анализы</h3>
                    <div class="button-group">
                        <a href="{{route('branch.create')}}" class="btn waves-effect waves-light btn-primary">Добавить филиал</a>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Таблица филиалов</h4>
                    <div class="table-responsive m-t-40">
                        <table  class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название филиала</th>
                                <th>Описание</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{$branch->id}}</td>
                                    <td>{{$branch->title}}</td>
                                    <td style="width: 700px">{{$branch->description}}</td>
                                    <td>
                                        <a href="{{route('branch.edit', ['id' => $branch->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                        <form action="{{route('branch.destroy', ['id' => $branch->id])}}" method="POST" id="destroy-btn">
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
                {!! $branches->links() !!}
            </div>
        </div>
    </div>
@endsection