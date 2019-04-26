<aside class="sidebar-left col-md-3 p-3">
    <ul class="list-items lvl-1">
        @foreach ($categories  as $category)
            <li class="list-item dropdown {{ Request::is('category/' . $category->slug) ? 'active' : '' }}">
                <a class="link-def" href="category/{{$category->slug}}"
                   aria-expanded="false" aria-controls="collapseExample{{$category->id}}">{{$category->title}}</a>
                <div class="collapse" id="collapseExample{{$category->id}}">
                    <ul class="list-items lvl-2">
                        @foreach ($category->service  as $service)
                            <li class="list-item {{ Request::is('service/' . $service->slug) ? 'active' : '' }}"><a class="link-def" href="service/{{$service->slug}}">{{$service->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>
</aside>