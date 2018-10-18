@extends('layouts.public')

@section('content')
    <div class="container mixes">
        <div class="row">
        	<div class="col-xs-12 mixes-title">
                <h2>{{ $title }}</h2>
            </div>
            <div class="col-xs-12">
                
                @include('components.params')
            </div>
            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-primary" form="paramsForm2">Подобрать</button>
            </div>
        </div>
    </div>
@endsection

@section('header')
    @include('components.header_links')
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $random_serial->image) }}@endsection