@extends('layouts.phonebook')


@section('content')
    <div class="content col-12 col-md-12" id="phonebook">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($categories as $categoryId => $category)
                <li class="nav-item">
                    <a class="nav-link {{ $categoryId == 0 ? 'active' : '' }}" data-toggle="tab" href="#category-{{$categoryId}}" role="tab">{{ $category }}
                        <br><span>нажми на меня</span></a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach($categories as $categoryId => $category)
                <div class="tab-pane fade {{ $categoryId == 0 ? 'show active' : '' }}" id="category-{{$categoryId}}" role="tabpanel">
                    <table class="table-responsive table table-custom" >
                        <thead>
                        <tr>
                            <th>ФИО / Служба</th>
                            <th>Контактная информация</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($phones as $phone)
                                @if($phone->category == $category)
                                    <tr style="text-align: left;">
                                        <td style="text-align: left;">{{ $phone->title }}</td>
                                        <td>{{ $phone->info }}</td>
                                        <td  style="text-align: left;">{{ $phone->description }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
       {{-- @foreach($categories as $category)
            <h2 style="font-size: 21px;font-weight: 700;text-align: center;margin: 35px 0;color: #ff6974;">{{ $category }}</h2>
            <table class="table-responsive table table-custom" >
                <thead>
                <tr>
                    <th>ФИО / Служба</th>
                    <th>Контактная информация</th>
                    <th>Описание</th>
                </tr>
                </thead>
                <tbody>
                @foreach($phones as $phone)
                    @if($phone->category == $category)
                        <tr style="text-align: left;">
                            <td>{{ $phone->title }}</td>
                            <td>{{ $phone->info }}</td>
                            <td>{{ $phone->description }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        @endforeach--}}
    </div>
@endsection