<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-small-cap">Административная панель</li>
        <li class="{{ Request::is('admin') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{url('/admin')}}"><i class="mdi mdi-gauge"></i><span
                        class="hide-menu">Приборная доска</span></a>
        </li>
        <li class="{{ Request::is('admin/doctors*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('doctors.index')}}"><i class="mdi mdi-account-card-details"></i><span
                        class="hide-menu">Доктора</span></a>
        </li>
        <li class="{{ Request::is('admin/category*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('category.index')}}"><i class="mdi mdi-cards-variant"></i><span
                        class="hide-menu">Категории</span></a>
        </li>
        <li class="{{ Request::is('admin/service*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('service.index')}}"><i class="mdi mdi-script"></i><span
                        class="hide-menu">Услуги</span></a>
        </li>
        <li class="{{ Request::is('admin/news*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('news.index')}}"><i class="mdi mdi-newspaper"></i><span
                        class="hide-menu">Новости</span></a>
        </li>
        <li class="{{ Request::is('admin/spec*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('spec.index')}}"><i class="mdi mdi-account-settings-variant"></i><span
                        class="hide-menu">Специализации</span></a>
        </li>
        <li class="{{ Request::is('admin/article*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('article.index')}}"><i class="mdi mdi-book-open-variant"></i><span
                        class="hide-menu">Статьи</span></a>
        </li>
        <li class="{{ Request::is('admin/art-categories*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('art-categories.index')}}"><i class="mdi mdi-bookmark"></i><span
                        class="hide-menu">Разделы статей</span></a>
        </li>
        <li class="{{ Request::is('admin/analyze*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('analyze.index')}}"><i class="mdi mdi-pulse"></i><span
                        class="hide-menu">Анализы</span></a>
        </li>
        <li  class="{{ Request::is('admin/branch*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('branch.index')}}"><i class="mdi mdi-home-outline"></i><span
                        class="hide-menu">Филиалы</span></a>
        </li>
        <li class="{{ Request::is('admin/phonebook*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('phonebook.index')}}"><i class="mdi mdi-phone-log"></i><span
                        class="hide-menu">Экстренные номера</span></a>
        </li>
        <li class="{{ Request::is('admin/task*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('task.index')}}"><i class="mdi mdi-calendar-check"></i><span
                        class="hide-menu">Задачи для секретаря</span></a>
        </li>
        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('users.index')}}"><i class="mdi mdi-account"></i><span
                        class="hide-menu">Пользователи</span></a>
        </li>
        <li class="{{ Request::is('admin/files*') ? 'active' : '' }}"> <a class="waves-effect waves-dark" href="{{route('files.index')}}"><i class="mdi mdi-cloud-download"></i><span
                        class="hide-menu">Файлы</span></a>
        </li>
    </ul>
</nav>