@extends('admin.layout')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
        function cointerInput() {
          var lengthWrapper = $('.copy-block').length;
          if(lengthWrapper > 0) {
            return lengthWrapper;
          }
          return 0;
        }
        var addCounter = cointerInput();


        $('.btn-add').click(function () {

          var CLASS_TITLE = "service["+ addCounter +"]" + "[service_id]";
          var CLASS_TIME = "service["+ addCounter +"]" + "[time]";
          var CLASS_OLD_MIN = "service["+ addCounter +"]" + "[old_min]";
          var CLASS_OLD_MAX = "service["+ addCounter +"]" + "[old_max]";
          var CLASS_SORT = "service["+ addCounter +"]" + "[sort]";
          var ID_SORT = "sort-"+ addCounter;
          var clone =  $('.copy-block').first().clone();


          clone.find('.f1').attr({
            name: CLASS_OLD_MIN,
            placeholder: 'От'
          }).val('0');

          clone.find('.f2').attr({
            name: CLASS_OLD_MAX,
            placeholder: 'До'
          }).val('99');

          clone.find('.f3').attr({
            name: CLASS_TIME,
            placeholder: 'Время'
          }).val('0');

          clone.find('.f4').attr({
            name: CLASS_TITLE,
            placeholder: 'Название услуги'
          });

          clone.find('.f5').attr({
            name: CLASS_SORT,
            id: ID_SORT
          });

          clone.find('.f5-label').attr({
            for: ID_SORT
          });

          clone.appendTo('.append');
          addCounter++;
         $('.append').last('.copy-block').find('.btn-close').click(function (e) {
           e.preventDefault();
           $(this).parents('.copy-block').remove();
         });
          $('.append').last('.copy-block').find('.select2').select2();
        });
        $('.btn-close').click(function (e) {
          e.preventDefault();
          $(this).parents('.copy-block').remove();
        });
      });
    </script>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin._error')
                    <h3 class="card-title">Создание доктора</h3>
                    <div class="button-group">
                        <a href="{{route('doctors.clone', $doctor)}}" class="btn waves-effect waves-light btn-outline-primary">Клонировать</a>
                    </div>

                    <form class="form-material m-t-40" method="POST" action="{{route('doctors.update', $doctor->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">ФИО</label>
                            <input type="text" class="form-control form-control-line" id="name" name="name" value="{{$doctor->name}}">
                        </div>

                        <div class="form-group">
                            <label class="card-title">Описание</label>
                            <div class="form-group">
                                <textarea class="textarea_editor form-control" rows="15" placeholder="" name="description">{{$doctor->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link">Ссылка на сайт z-clinic.ru (регалии)</label>
                            <input type="text" class="form-control form-control-line" value="{{$doctor->link}}" id="link" name="link">
                        </div>

                       {{-- <div class="form-group">
                            <label for="document">Прикрепить документ</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="document" id="document" value="{{$doctor->document}}"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a> </div>
                        </div>--}}

                        <div class="form-group">
                            <label for="image">Аватар доктора</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename">{{$doctor->image}}</span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" id="image" value="{{$doctor->image}}"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a> </div>
                        </div>

                        <div class="form-group">
                            <label for="category">Выберете категорию</label>
                            {{Form::select('category[]',
                                $categories,
                                $selectedCategory,
                                ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите категорию'])
                             }}
                        </div>


                        <div class="form-group append row">
                            <label class="card-title col-md-12">Добавление услуг</label>
                            <div class="form-group_header-items">
                                <h5 class="card-title header-service-name my-3">Название услуги</h5>
                                <h5 class="card-title header-lead-time my-3">Время выполнения (мин.)</h5>
                                <h5 class="card-title header-old-in my-3">Возраст ОТ</h5>
                                <h5 class="card-title header-old-to my-3">Возраст ДО</h5>
                                <h5 class="card-title header-priority-dictor my-3">Приоритет</h5>
                            </div>
                            @forelse ($doctor->service as $itemKey => $itemValue)
                                <div class="row copy-block">
                                    <div class="form-group col-md-5">
                                        {{--{{Form::select('service['. $itemKey .'][service_id]',
                                           $services,
                                           $itemValue->id,
                                           ['class' => 'form-control f4'])
                                        }}--}}
                                        <select name="service[{{ $itemKey }}][service_id]" id="service" class="form-control f4">
                                            <option value="" disabled>---Выберите услугу---</option>
                                            @foreach($categoriesObject as $category)
                                                <optgroup label="{{ $category->title }}">
                                                    @foreach($category->service as $service)
                                                        <option value="{{ $service->id }}" {{ $service->id === $itemValue->id ? 'selected' : '' }}>{{ $service->title }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        {{Form::text('service['. $itemKey .'][time]',
                                           $itemValue->pivot->time,
                                           ['class' => 'form-control f3', 'data-placeholder'=>'Время выполнения'])
                                        }}
                                    </div>

                                    <div class="form-group col-md-1">
                                        {{Form::text('service['. $itemKey .'][old_min]',
                                          $itemValue->pivot->old_min,
                                          ['class' => 'form-control f1', 'data-placeholder'=>'От'])
                                       }}
                                    </div>

                                    <div class="form-group col-md-1">
                                        {{Form::text('service['. $itemKey .'][old_max]',
                                          $itemValue->pivot->old_max,
                                          ['class' => 'form-control f2', 'data-placeholder'=>'До'])
                                       }}
                                    </div>

                                    <div class="form-group col-md-1">
                                        <input type="checkbox" id="sort-{{$itemKey}}" class="chk-col-red f5" name="service[{{$itemKey}}][sort]" value="1" {{  $itemValue->pivot->sort == "1" ? 'checked' : ''}}>
                                        <label for="sort-{{$itemKey}}" class="f5-label">Top</label>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-warning btn-circle btn-close" style="display: block;margin: 0 auto;"><i class="fa fa-times"></i> </button>
                                    </div>
                                </div>
                                @empty
                                <div class="row copy-block col-12">
                                        <div class="form-group col-md-5">
                                            <select name="service[0][service_id]" id="service" class="form-control f4">
                                                <option value="" disabled selected>---Выберите услугу---</option>
                                                @foreach($categoriesObject as $category)
                                                    <optgroup label="{{ $category->title }}">
                                                        @foreach($category->service as $service)
                                                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="number" class="form-control f3" name="service[0][time]" placeholder="Время выполнения">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <input type="number" class="form-control f1" name="service[0][old_min]" placeholder="От">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <input type="number" class="form-control f2" name="service[0][old_max]" placeholder="До">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <input type="checkbox" id="sort" class="chk-col-red f5" name="service[0][sort]" value="1">
                                            <label for="sort" class="f5-label">Top</label>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button type="button" class="btn btn-warning btn-circle btn-close" style="display: block;margin: 0 auto;"><i class="fa fa-times"></i> </button>
                                        </div>
                                    </div>
                            @endforelse

                        </div>
                        <div class="flex-wrapper" style="display: flex; justify-content: center; align-items: center;">
                            <button type="button" class="btn btn-info btn-add mb-4">
                                <i class="ti-plus text" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="service">Выберете филиал</label>

                            {{Form::select('branch[]',
                                 $branches,
                                 $selectedBranch,
                                 ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите филиал'])
                            }}

                        </div>

                        <div class="form-group">
                            <label for="service">Выберете специализацию врача</label>

                            {{Form::select('spec[]',
                                 $specs,
                                 $selectedSpec,
                                 ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите спецификаю'])
                            }}

                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="is_exit" class="filled-in chk-col-purple" name="is_exit"  {{ $doctor->is_exit == "1" ? 'checked' : ''}}>
                            <label for="is_exit">Выездной врач</label>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="button-group">
                                    <a href="{{route('doctors.index')}}" class="btn waves-effect waves-light btn-outline-secondary">Назад</a>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-warning">Обновить доктора</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection