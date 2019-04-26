@extends('layouts.app')

@section('content')
    <div class="content col-12 col-md-12">

        <div class="news my-5">
            <div class="news_items d-flex flex-wrap justify-content-around">
                @foreach($newsItems as $news)
                    <div class="news_item p-3 d-flex align-items-stretch">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $news->getImage() }}" alt="{{ $news->title }}">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">{{ $news->title }}</h5>
                                <p class="card-text mb-3">{{ $news->getContent() }}</p>
                                <a href="{{ route('page.news.show', ['id' => $news->id]) }}" class="btn btn-primary d-block mt-auto">Подробно</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection