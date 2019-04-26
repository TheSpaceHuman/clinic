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
                            <input type="text" class="form-control form-control-line" value="{{$service->title}}" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="code">Код услуги</label>
                            <input type="number" class="form-control form-control-line" id="code" name="code" value="{{$service->code}}">
                        </div>
                        <div class="form-group">
                            <label for="time">Время выполнения услуги</label>
                            <input type="number" class="form-control form-control-line" id="time" name="time" value="{{$service->time}}">
                        </div>

                       {{-- <div class="form-group">
                            <label for="priority">Приоритетные врачи</label>

                            {{Form::select('priority[]',
                              $doctors,
                              $selectedDoctor,
                              ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите приоритетного'])
                            }}
                        </div>--}}

                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            {{Form::select('category_id',
                            $categories,
                            $selectedCategory,
                            ['class' => 'form-control','data-placeholder'=>'Выберите категорию'])
                         }}
                        </div>


                        <div class="form-group">
                            <label for="price">Цена услуги</label>
                            <input type="number" class="form-control form-control-line" id="price" name="price" value="{{$service->price}}">
                        </div>

                        <div class="form-group d-inline-block">
                            <label for="min_old">От</label>
                            <input type="number" class="form-control form-control-line" id="min_old" name="min_old" value="{{ $service->min_old }}">
                        </div>
                        <div class="form-group d-inline-block">
                            <label for="max_old">До</label>
                            <input type="number" class="form-control form-control-line" id="max_old" name="max_old" value="{{ $service->max_old }}">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="status" class="filled-in chk-col-purple" name="status" {{ $service->status == "1" ? 'checked' : ''}}>
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
