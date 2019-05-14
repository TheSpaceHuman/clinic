@extends('admin.layout')

@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-12 col-lg-6 col-md-6 offset-lg-3 offset-md-3">
            <div class="card card-inverse card-warning">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                             <h1 class="text-white">
                                 <i class="fas fa-exclamation-circle"></i>
                             </h1>
                         </div>
                        <div>
                            <h1 class="card-title mb-3">Напоминание</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 align-self-center">
                            <h3 class="font-light text-white">
                               Обновление excel файла "График Администраторов" производиться в разделе "Файлы" - schedule
                            </h3>
                        </div>
                        <div class="screenshot">
                            <img src="image/screenshots/1.jpg" alt="screenshot-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection