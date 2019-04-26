@extends('layouts.news')

@section('content')
    <div class="content col-12 col-md-12">
        <div class="accordion row" id="accordionExample">
            @foreach($newsItems as $news)
                <div class="col-4">
                    <div class="card bg-light" style="border-radius: 0; margin-bottom: 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
                    <div class="card-header">
                        <h2 class="mb-0 text-center text-uppercase">
                            <button class="btn btn-link text-dark" style="font-size: 1.4rem;" type="button" data-toggle="collapse" data-target="#{{$news->slug}}">
                                {{ $news->title }}
                            </button>
                        </h2>
                    </div>
                    <div id="{{$news->slug}}" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body" style="font-size: 16px;">{!! $news->content !!}</div>
                        <div class="d-flex my-1 justify-content-end">
                            <p class="px-4">{{ $news->getData() }}</p>
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection