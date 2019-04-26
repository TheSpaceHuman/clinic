<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="/">
    <title>@yield('title', 'CRM Z-clinic')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
     
</head>
<body>
    <a class="back-to-index {{ Request::is('/') ? 'd-none' : ''  }}" href="/" title="Вернуться на главную страницу">
        <i class="fas fa-home"></i>
    </a>
    <header class="header-index">
        <section class="header">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="d-flex justify-content-between w-100">
                        <a class="navbar-bran" href="/"><img src="image/index/logo.png"></a>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $user->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if($user->is_admin)
                                    <a class="dropdown-item" href="/admin">Администрирование</a>
                                @endif
                                <button type="button" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#new-task">Поставить новую задачу</button>
                                <a href="{{ route('user.profile') }}" class="dropdown-item">Профиль</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                            </div>
                        </div>
                    </div>


                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="list-item dropdown"><a class="link-def" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Все категории</a></li>
                            <div class="collapse" id="collapseExample">
                                <ul class="list-items lvl-2">
                                    <li class="list-item"><a class="link-def" href="{{ url('services') }}">Услуги</a></li>
                                    <li class="list-item"><a class="link-def" href="{{ url('doctors') }}">Врачи</a></li>
                                    <li class="list-item"><a class="link-def" href="{{ url('articles') }}">Справочник</a></li>
                                    <li class="list-item"><a class="link-def" href="{{ url('analyzes') }}">Анализы</a></li>
                                    <li class="list-item"><a class="link-def" href="{{ route('page.phonebook.index') }}">Экстренные телефоны</a></li>
                                    <li class="list-item"><a class="link-def" href="{{ url('tasks') }}">Задачи</a></li>
                                    <li class="list-item"><a class="link-def" href="{{ $scheduleFile->office_link }}" target="_blank">График администраторов</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </nav>
                <div class="row">
                    <div class="express col-12 col-md-3 px-0">
                        <div class="express_items">
                            <a class="express_item pink flex-100" href="{{ route('page.phonebook.index') }}">Экстренные телефоны</a>
                            <a class="express_item blue" href="{{ url('tasks') }}">Задача секретарю</a>
                            <a class="express_item dark-blue"  href="{{ $scheduleFile->office_link }}" target="_blank">График администраторов</a>
                        </div>
                    </div>
                    <nav class="col-12 col-md-9 tabs">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  services-color" id="nav-services-tab"  href="{{ url('services') }}"  aria-controls="nav-services" aria-selected="false">Услуги</a>
                            <a class="nav-item nav-link doctors-color" id="nav-doctors-tab"  href="{{ url('doctors') }}" aria-controls="nav-doctors" aria-selected="false">Врачи</a>
                            <a class="nav-item nav-link directory-color" id="nav-directory-tab" href="{{ url('articles') }}"  aria-controls="nav-directory" aria-selected="false">Справочник</a>
                            <a class="nav-item nav-link analyzes-color m-0" id="nav-analyzes-tab" href="{{ url('analyzes') }}" aria-controls="nav-analyzes" aria-selected="false">Анализы</a>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            @yield('top-nav-active')
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </header>

        <main class="py-4 main-index">
            <section class="main">
                <div class="container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </section>
        </main>

    <footer class="footer-index">
        <section class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="navbar-brand"><a href="/"><img src="image/index/logo-footer.png"></a></div>
                    </div>
                    <div class="col-4 offset-5 footer_info">
                        <div class="footer_info_items">
                            <div class="footer_info_item">
                                <p class="text">Служба поддержки:</p>
                            </div>
                            <div class="footer_info_item"><a class="email link-def" href="mailto:info@burodizayna.ru">info@burodizayna.ru</a></div>
                            <div class="footer_info_item"><a class="phone link-def" href="tel:+74957403312">+7 495 740 33 12</a></div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="allmodals" class="modals-block">
            <!-- Modal new Task -->
            <div class="modal fade" id="new-task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form class="modal-content" method="POST" action="{{route('page.task.new')}}">
                        <div class="modal-header">
                            <h5 class="modal-title" style="margin: 0 auto;">Новая задача</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div  class="col-12 text-center">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="title">Название задачи</label>
                                            <input type="text" class="form-control" value="{{old('title')}}" id="title" name="title">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Описание задачи</label>
                                            <textarea rows="5" id="description" name="description" class="form-control">{{old('description')}}</textarea>
                                        </div>

                                        <div class="form-group py-4">
                                            <label for="executor" class="control-label w-100">Выберите кому назначить задачу</label>
                                            <select class="secretary-select2" name="executor" id="executor">
                                                <option hidden selected disabled>Выберите нужного секретаря</option>
                                                @foreach($executors as $secretary)
                                                    <option value="{{ $secretary->id }}">{{ $secretary->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-bottom: 20px;display: flex;justify-content: center;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Назначить</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/front.js') }}"></script>
</body>
</html>
