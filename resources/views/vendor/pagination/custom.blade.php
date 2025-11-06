<!-- Pagination -->
@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $linkLimit = 5;
        $half = floor($linkLimit / 2);
        $from = $currentPage - $half;
        $to = $currentPage + $half;

        // Điều chỉnh nếu ở đầu
        if ($from < 1) {
            $to += abs($from) + 1;
            $from = 1;
        }

        // Điều chỉnh nếu ở cuối
        if ($to > $lastPage) {
            $from -= $to - $lastPage;
            $to = $lastPage;
            if ($from < 1) {
                $from = 1;
            }
        }
    @endphp
    <div class="pagination">
        {{-- Nút Previous --}}
        @if ($paginator->onFirstPage())
            <button class="page-btn" disabled>«</button>
            <button class="page-btn" disabled>←</button>
        @else
            <a href="{{ $paginator->url(1) }}"><button class="page-btn">«</button></a>
            <a href="{{ $paginator->previousPageUrl() }}"><button class="page-btn">←</button></a>
        @endif

        {{-- Số trang --}}
        @for ($page = $from; $page <= $to; $page++)
            @if ($page == $paginator->currentPage())
                <button class="page-btn active">{{ $page }}</button>
            @else
                <a href="{{ $paginator->url($page) }}"><button class="page-btn">{{ $page }}</button></a>
            @endif
        @endfor

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
