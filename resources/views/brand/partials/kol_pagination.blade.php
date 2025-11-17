<div class="kol-pagination" style="display: flex; gap: 0.5rem; margin-top: 1.5rem; justify-content: center; align-items: center;">
    @if($kols->onFirstPage())
        <button type="button" class="btn btn-sm btn-secondary" disabled>← Trước</button>
    @else
        <button type="button" class="btn btn-sm btn-secondary kol-prev-page" data-page="{{ $kols->currentPage() - 1 }}">← Trước</button>
    @endif

    <div style="display: flex; gap: 0.25rem; align-items: center;">
        @for($i = 1; $i <= $kols->lastPage(); $i++)
            @if($i == $kols->currentPage())
                <button type="button" class="btn btn-sm btn-primary" disabled>{{ $i }}</button>
            @elseif($i <= 5 || $i > $kols->lastPage() - 2)
                <button type="button" class="btn btn-sm btn-outline-secondary kol-goto-page" data-page="{{ $i }}">{{ $i }}</button>
            @elseif($i == 6)
                <span style="padding: 0.5rem 0.25rem;">...</span>
            @endif
        @endfor
    </div>

    @if($kols->hasMorePages())
        <button type="button" class="btn btn-sm btn-secondary kol-next-page" data-page="{{ $kols->currentPage() + 1 }}">Tiếp →</button>
    @else
        <button type="button" class="btn btn-sm btn-secondary" disabled>Tiếp →</button>
    @endif

    <span style="margin-left: 1rem; font-size: 12px; color: var(--gray-600);">
        Trang {{ $kols->currentPage() }} / {{ $kols->lastPage() }} (Tổng: {{ $kols->total() }} KOL)
    </span>
</div>
