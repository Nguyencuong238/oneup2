<!-- Pagination -->
@if ($paginator->hasPages())
    <div class="pagination">        
        {{-- Nút Previous --}}
        @if ($paginator->onFirstPage())
            <button class="page-btn" disabled>«</button>
            <button class="page-btn" disabled>←</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><button class="page-btn">←</button></a>
            <a href="{{ $paginator->url(1) }}"><button class="page-btn">«</button></a>
        @endif

        {{-- Số trang --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <button class="page-btn" disabled>{{ $element }}</button>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="page-btn active">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}"><button class="page-btn">{{ $page }}</button></a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Nút Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><button class="page-btn">→</button></a>
            <a href="{{ $paginator->url($paginator->lastPage()) }}"><button class="page-btn">»</button></a>
        @else
            <button class="page-btn" disabled>→</button>
            <button class="page-btn" disabled>»</button>
        @endif
    </div>
@endif
