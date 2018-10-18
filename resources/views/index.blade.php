@extends('layouts.public')

@section('content')
    <div class="container mixes" id="mixes">
        @foreach ($mixes as $title => $mix)
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $title }}</h2>
            </div>
            @foreach ($mix as $m)
                <div class="col-lg-4 serial-title" style="background-image: url(/img/serials/{{ str_replace(' ', '%20', $m['image']) }})">
                    <a href="{{ route('serial_front', ['id' => $m['id']]) }}" title="{{ $m['title_ru'] }}">
                        <div class="header-tint"></div>
                        <h3>
                            {{ str_limit($m['title_ru'], $limit = 22, $end = '...') }}
                        </h3>
                        <p>{{ str_limit($m['description'], $limit = 200, $end = '...') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection

@section('header')
    @include('components.header_links')
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $random_serial->image) }}@endsection