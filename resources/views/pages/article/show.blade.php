@extends('layouts.articles')


@section('content')
    <div class="content col-12 article-content">
        <h3 class="article-content_title">{{ $article->title }}</h3>

        <div class="article-content_content">
            {{ $article->getContent() }}
        </div>

    </div>
@endsection