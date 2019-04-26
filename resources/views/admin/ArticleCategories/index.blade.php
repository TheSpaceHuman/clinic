@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Add Button -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-title">Разделы статей</h3>
                            <div class="button-group">
                                <a href="{{route('art-categories.create')}}" class="btn waves-effect waves-light btn-primary">Добавить новый раздел для статей</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Все статьи</h4>
                    <div class="table-responsive m-t-40">
                        <table  class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название раздела</th>
                                <th>Описание</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($ArtCategories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>{{$category->description}}</td>
                                        <td>
                                            <a href="{{route('art-categories.edit', ['id' => $category->id])}}" data-toggle="tooltip" data-original-title="Изменить"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>

                                            <form action="{{route('art-categories.destroy', ['id' => $category->id])}}" method="POST" id="destroy-btn">
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
        </div>
    </div>
@endsection