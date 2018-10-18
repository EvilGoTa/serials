@extends('layouts.public')

@section('content')
    <div class="container mixes">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('logout') }}" method="post">
                    {{ csrf_field() }}
                    <p>Вы вошли как <strong>{{ Auth::user()->name }}</strong></p>
                    <p>
                        <input type="submit" value="Выйти">
                    </p>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Избранное</h2>
            </div>
            @if (count($favorites) > 0)
            @foreach ($favorites as $m)
                <div class="col-lg-4 serial-title" style="background-image: url(/img/serials/{{ $m['image'] }})">
                    <a href="{{ route('serial_front', ['id' => $m['id']]) }}" title="{{ $m['title_ru'] }}">
                        <div class="header-tint"></div>
                        <h3>
                                {{ str_limit($m['title_ru'], $limit = 22, $end = '...') }}
                        </h3>
                        <p>{{ str_limit($m['description'], $limit = 200, $end = '...') }}</p>
                    </a>
                </div>
            @endforeach
            @else
                <div class="col-lg-12">
                    <p>Список избранного пуст!</p>
                </div>

            @endif
        </div>
    </div>
@endsection

@section('header')
    @include('components.header_links')
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $serial->image) }}@endsection