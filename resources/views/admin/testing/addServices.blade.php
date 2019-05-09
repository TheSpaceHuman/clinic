@extends('admin.layout')

@section('content')
    <div class="row" id="app">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin._error')
                    <h3 class="card-title">Создание доктора</h3>
                    <form class="form-material m-t-40" method="POST" action="{{route('doctors.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">ФИО</label>
                            <input type="text" class="form-control form-control-line" value="" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label class="card-title">Описание</label>
                            <div class="form-group">
                                <textarea class="textarea_editor form-control" rows="15" placeholder="" name="description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link">Ссылка на сайт z-clinic.ru (регалии)</label>
                            <input type="text" class="form-control form-control-line" value="" id="link" name="link">
                        </div>

                        {{-- <div class="form-group">
                             <label for="document">Прикрепить документ</label>
                             <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                 <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                             <input type="file" name="document" id="document"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a> </div>
                         </div>--}}

                        <div class="form-group">
                            <label for="image">Аватар доктора</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" id="image"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a> </div>
                        </div>

                        <div class="form-group">
                            <label for="category">Выберете категорию</label>
                            {{Form::select('category[]',
                                $categories,
                                null,
                                ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите категорию'])
                           }}
                        </div>

                        <dinamyc-services services-arr="{{ $services }}"></dinamyc-services>


                        <div class="form-group">
                            <label for="service">Выберете филиал</label>

                            {{Form::select('branch[]',
                                 $branches,
                                 null,
                                 ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите филиал'])
                            }}

                        </div>

                        <div class="form-group">
                            <label for="service">Выберете специализацию врача</label>

                            {{Form::select('spec[]',
                                 $specs,
                                 null,
                                 ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите спецификаю'])
                            }}

                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="is_exit" class="filled-in chk-col-purple" name="is_exit">
                            <label for="is_exit">Выездной врач</label>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('doctors.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info">Создать доктора</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
@endsection