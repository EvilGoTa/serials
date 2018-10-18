<div class="row home-header">
    <div class="col-xs-12">
    	<h2>{{ $random_serial->title_ru }}</h2>
    </div>
    <div class="col-xs-12">
        @foreach(\App\Serial::getTopAttrs($random_serial, 2) as $topAttr)
        <p class="top-attr">{{ $topAttr['name_ru'] }}: {{ $topAttr['value'] }}%</p>
        @endforeach
    </div>
    <div class="col-xs-12 ">
        <br>
        <a href="{{ route('serial_front', ['id' => $random_serial->id]) }}" class="button-gradient button_arrow-right">Подробнее</a>
    </div>
</div>