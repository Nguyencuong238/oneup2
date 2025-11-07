@foreach ($kols as $item)
    <div class="kol-select-card" data-id="{{ $item->id }}">
        <input type="checkbox" class="kol-checkbox" name="kols[]" value="{{ $item->id }}">
        <img class="kol-avatar" src="{{ $item->getFirstMediaUrl('media') }}">
        <div class="kol-info">
            <div class="kol-name">{{ $item->display_name }}</div>
            <div class="kol-stats">
                <span>{{ formatDisplayNumber($item->followers, 3) }} người theo dõi</span>
                <span>•</span>
                <span>{{ $item->engagement }}% tương tác</span>
            </div>
        </div>
        <div class="kol-price">
            <div class="price-label">Giá ước tính</div>
            <div class="price-value">₫{{ formatDisplayNumber($item->price_campaign, 2) }}</div>
        </div>
    </div>
@endforeach
@if ($kols->isEmpty())
    <p>Không tìm thấy KOL phù hợp.</p>
@endif
