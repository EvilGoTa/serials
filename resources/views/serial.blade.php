@extends('layouts.public')

@section('content')
    <div class="container serial-entity">
        <div class="row">
            <div class="col-lg-8 serail_attrs_wrapper">
                <h2 class="page-header">Оценка сериала <img src="/img/round-help-button.svg" class="tooltipster" title="Показывает в порядке убывания наиболее характерные черты сериала (например, в нем много драмы и много юмора)" alt="" style="height: 20px; width: auto; filter: invert(40%);"></h2>
                <ul class="serial_attrs">
                    @foreach($max_attrs as $attr) 
                    <li>
                        <div class="attr-bar before-loaded {{ $attr['attribute'] }}"
                             style="width: {{ ($attr['value']) }}%;">
                            <div style="background-size: {{ 100 + (100 - ($attr['value'])) }}%"></div>
                        </div>
                        <div class="attr-data">{{ $attributes[$attr['attribute']] }} - {{ ($attr['value']) }}%</div>
                    </li>
                    @endforeach
                </ul>
                <br>
                @if(Auth::check())
                <a href="#" id="rateSerial" class="button-gradient button_thumbs-up" data-toggle="modal" data-target="#markModalCenter">
                    Оценить сериал!
                    {{-- <img src="/img/rate.png" alt=""> --}}
                </a>
                @else
                <a href="{{ route('login') }}" class="button-gradient button_thumbs-up">
                    Войти и оценить!
                </a>
                @endif
                <br><br>
                <p class="rate-descr">
                    Помогите другим найти сериал по вкусу, оценив этот сериал
                </p>
            </div>
            <div class="col-lg-4">
                <h2 class="page-header">Информация</h2>
                <ul class="information">
                    <li>
                        <div class="name">Сезонов</div>
                        <div class="placeholder"> </div>
                        <div class="value">{{ $serial->seasons }}</div>
                    </li>
                    <li>
                        <div class="name">Год выпуска</div>
                        <div class="placeholder"></div>
                        <div class="value">{{ $serial->year_launch }}</div>
                    </li>
                    <li><div class="name">Страна</div>
                        <div class="placeholder"></div>
                        <div class="value">{{ $serial->country }}</div>
                    </li>
                    <li><div class="name">Сериал завершен</div>
                        <div class="placeholder"></div>
                        <div class="value">{{ $serial->ended == 0 ? "Нет" : "Да" }}</div>
                    </li>
                </ul>
                @if ($serial->trailer_link)
                <div class="trailer">
                    <a href="{{ str_replace('https://youtu.be/', 'https://www.youtube.com/watch?v=', $serial->trailer_link) }}" class="button-gradient-dark button_arrow-right" style="font-size: 1.3em" target="_blank" data-toggle="modal" data-target="#trailerModal">

                        Смотреть трейлер
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
    <div class="container mixes">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Похожие сериалы <img src="/img/round-help-button.svg" class="tooltipster" title="Сериалы, похожие на «{{ $serial->title_ru }}» по наиболее характерным чертам (например, в них много драмы и много юмора)" alt="" style="height: 20px; width: auto; filter: invert(40%);"></h2>
            </div>
            @foreach ($similar_data as $m)
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
    </div>

    <div class="modal fade bd-example-modal-lg" id="markModalCenter" tabindex="-1" role="dialog" aria-labelledby="markModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content mark-dialog">
                <div class="modal-header">
                    <h5 class="modal-title mark-title" id="markModalLongTitle">
                        {{ $serial->title_ru }}</h5>
                    <button type="button" class="close mark-close" data-dismiss="modal" aria-label="Close" style="opacity: 1">
                        <span aria-hidden="true" class="bordered_button "><span>Закрыть</span></span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="mark_csrf" value="{{ csrf_token() }}">                    
                    <div class="mark-slider" data-title="{{ $serial->title_ru }}">
                        <div class="title"></div>
                        <div id="uiSlider" class="slider-comp" style="padding: 0px 20px; margin-top: 10px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div id="slider-val" class="mark-progress-wrapper">
                                <div class="mark-progress-text"></div>
                                <div class="mark-progress-bar-wrapper">
                                    <div class="mark-progress-bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 mark-buttons-wrapper">
                            <button type="button" class="btn btn-secondary marks-back">
                                <span class="bordered_button "><span>&nbsp;Назад&nbsp;</span></span></button>
                            <button type="button" class="btn btn-primary marks-accept">
                                <span class="bordered_button "><span>Ок!</span></span></button>
                            <button type="button" class="btn btn-secondary marks-skip" >
                                <span class="bordered_button "><span>&nbsp;Пропустить&nbsp;</span></span></button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="trailerModal" tabindex="-1" role="dialog" aria-labelledby="trailerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Трейлер сериала {{ $serial->title_ru }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0">
                    <iframe class="yt-iframe" width="100%" height="315" src="{{ str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $serial->trailer_link) }}?rel=0&amp;controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.serial_usermarks = {
        @foreach ($user_marks as $um)
            '{{ $um['question_id'] }}': {{ $um['mark_value'] }},
        @endforeach
        }
        window.serial_attributes = {
            @foreach ($attributes as $en => $ru)
            '{{ $en }}': '{{ $ru }}',
            @endforeach
        }
    </script>
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12 serial-title">
            <h1>{{ $serial->title_ru }} 
                @if(Auth::check())
                <img class="addToFav {{ $favorite }}" 
                    src="/img/favorites.svg" 
                    alt="Добавить в избранное" 
                    data-serial="{{ $serial->id }}"
                    data-token="{{ csrf_token() }}"
                >
                    @if(Auth::user()->isAdmin)
                        <a target="_blank" href="{{ route('admin::serials.edit', [$serial->id]) }}">редактировать</a>
                    @endif
                @endif
            </h1>
            <h3>{{ $serial->description }}</h3>
        </div>
    </div>
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $serial->image) }}@endsection