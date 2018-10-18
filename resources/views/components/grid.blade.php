@foreach ($items as $m)
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

@isset ($page)
<input class="current-page" type="hidden" name="" value="{{ $page }}">
@endisset