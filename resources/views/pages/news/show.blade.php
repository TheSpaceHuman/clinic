@extends('layouts.app')

@section('content')
    <div class="content col-12 col-md-12">
        <div class="jumbotron" style="background-color: transparent;">
            <h1 class="display-4">{{ $news->title }}</h1>
            <div class="lead">
                {!! $news->content !!}
            </div>
            <hr class="my-4">
            <div class="lead">{{ $news->getData() }}</div>
        </div>

    </div>
@endsection