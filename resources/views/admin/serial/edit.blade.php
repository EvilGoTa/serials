@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        <div class="card">
            <div class="card-header card-header-primary">
                @if ($serial->id)
                <h4 class="card-title">#{{ $serial->id }} {{ $serial->title_ru }} <a target="_blank" href="{{ route('serial_front', [$serial->id]) }}" title="Посмотреть на фронте" style="float: right"><i class="material-icons">launch</i></a></h4>
                <p class="card-category">{{ $serial->title_original }}, {{ $serial->year_launch }} - {{ $serial->year_last or 'наши дни' }}</p>
                @else
                <h4 class="card-title">Новый сериал</h4>
                @endif
            </div>
            <div class="card-body">
                @if ($serial->id)
                <form action="{{ route('admin::serials.update', ['id' => $serial->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                <form action="{{ route('admin::serials.store') }}" method="POST" enctype="multipart/form-data">
                @endif
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Название</label>
                                <input type="text" class="form-control" value="{{ $serial->title_ru }}" name="title_ru">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Год запуска</label>
                                <input type="number" class="form-control" value="{{ $serial->year_launch }}" name="year_launch">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Год окончания</label>
                                <input type="number" class="form-control" value="{{ $serial->year_last }}" name="year_last">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check form-group bmd-form-group">
                                <label class="form-check-label">
                                    <input type="hidden" name="ended" value="0" name="ended">
                                    <input class="form-check-input" type="checkbox" value="1" name="ended" {{ $serial->ended?"checked":"" }}>
                                    Сериал завершен
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Оригинальное название</label>
                                <input type="text" class="form-control" value="{{ $serial->title_original }}" name="title_original">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Страна</label>
                                <input type="text" class="form-control" value="{{ $serial->country }}" name="country">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Время эпизода</label>
                                <input type="number" class="form-control" value="{{ $serial->episode_time }}" name="episode_time">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Количество сезонов</label>
                                <input type="number" class="form-control" value="{{ $serial->seasons }}" name="seasons">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="margin-top: 30px">Параметры</label>
                        </div>
                        @foreach (App\SerialComparer::getAttributes() as $attr_en => $attr_ru)
                        <div class="col-md-2">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">{{ $attr_ru }}</label>
                                <input type="number" class="form-control" value="{{ $serial->{$attr_en} }}" name="{{ $attr_en }}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="margin-top: 30px">Дополнительно</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Трейлер (Youtube)</label>
                                <input type="text" class="form-control" value="{{ $serial->trailer_link }}" name="trailer_link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Дата создания</label>
                                <input type="text" class="form-control" value="{{ $serial->created_at }}" disabled="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Дата изменения</label>
                                <input type="text" class="form-control" value="{{ $serial->updated_at }}" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Описание</label>
                                    <textarea class="form-control" rows="5" name="description">{{ $serial->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Изображение</label>
                            @isset($serial->image)
                                <p>{{ $serial->image }}</p>
                                <img src="/img/serials/{{ $serial->image }}" alt="" class="img-responsive img-rounded">
                            @endisset
                                <input type="file" name="image" style="margin-top: 20px">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection