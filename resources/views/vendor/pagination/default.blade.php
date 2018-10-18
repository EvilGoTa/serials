@if ($paginator->hasPages())
    <ul class="pagination nav-tabs card-gradient" style="">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled nav-item"><a class="nav-link">&laquo;</a></li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled nav-item"><a class="nav-link ">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active nav-item"><a class="nav-link active">{{ $page }}</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="nav-item"><a class="nav-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled nav-item"><a class="nav-link">&raquo;</a></li>
        @endif
    </ul>
@endif
