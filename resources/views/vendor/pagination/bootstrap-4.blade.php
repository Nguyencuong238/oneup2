@if ($paginator->hasPages())
    <div class="jeg_navigation jeg_pagination jeg_pagenav_1 jeg_aligncenter no_navtext no_pageinfo">
        @if ($paginator->onFirstPage())
            <a class="page_nav prev" href="javascript:void(0);">
                <span class="navtext">@lang('pagination.previous')</span>
            </a>
        @else
            <a class="page_nav prev" href="{{ $paginator->previousPageUrl() }}">
                <span class="navtext">@lang('pagination.previous')</span>
            </a>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="page_number active">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page_number active">{{ $page }}</span>
                    @else
                        <a class="page_number" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="page_nav next" href="{{ $paginator->nextPageUrl() }}">
                <span class="navtext">@lang('pagination.next')</span>
            </a>
        @else
            <a class="page_nav next" href="javascript:void(0);">
                <span class="navtext">@lang('pagination.next')</span>
            </a>
        @endif
    </div>
@endif
