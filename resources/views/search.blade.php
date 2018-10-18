@extends('layouts.public')

@section('content')
    <div class="container mixes">
        <div class="row">
            @if ($result->count() > 0)
                <div class="col-lg-12 mixes-title">
                    <h2>Результаты поиска по запросу "{{ $query }}" ({{ $founded }})</h2>
                </div>
        </div>
        <div class="row" id="search-content">
                @include('components.grid', ['items' => $result, 'page' => $page])
            @else
                <div class="col-lg-12 mixes-title">
                    <h2>По запросу "{{ $query }}" ничего не найдено</h2>
                </div>
            @endif
        </div>
        @if ($pages > 1)
        <div class="row">
            <div class="col-lg-12">
                <a id="search_loadMode" href="" data-pages="{{ $pages }}" data-query="{{ $query }}">Загрузить еще...</a>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('header')
    @include('components.header_links')
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $random_serial->image) }}@endsection

@push('scripts')
    <script>
        $(window).scroll(function()
        {
            if  ($(window).scrollTop() == $(document).height() - $(window).height())
            {
                $('#search_loadMode').trigger('click');
            }
        });
    </script>
@endpush