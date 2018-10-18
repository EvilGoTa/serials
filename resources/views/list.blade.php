@extends('layouts.public')

@section('content')
    <div class="container mixes">
        <div class="row">
        	<div class="col-lg-12 mixes-title">
                <h2>{{ $title }}</h2>
            </div>
            @if ($result->count() > 0)
                @include('components.grid', ['items' => $result])
            @else
                <div class="col-lg-12 mixes-title">
                    <h2>Ничего не найдено :(</h2>
                    @if (count($data) == 0)
                    <p>Вы не выбрали ниодного параметра</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

@section('header')
    @include('components.header_links')
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $random_serial->image) }}@endsection