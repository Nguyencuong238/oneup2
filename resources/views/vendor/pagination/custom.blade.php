<!-- Pagination -->
@if ($paginator->hasPages())
    <div class="pagination">        
        {{-- Nút Previous --}}
        @if ($paginator->onFirstPage())
            <button disabled>«</button>
            <button disabled>←</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><button>←</button></a>
            <a href="{{ $paginator->url(1) }}"><button>«</button></a>
        @endif

        {{-- Số trang --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <button disabled>{{ $element }}</button>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="active">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}"><button>{{ $page }}</button></a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Nút Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><button>→</button></a>
            <a href="{{ $paginator->url($paginator->lastPage()) }}"><button>»</button></a>
        @else
            <button disabled>→</button>
            <button disabled>»</button>
        @endif
    </div>
@endif
