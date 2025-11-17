@forelse ($kols as $item)
    <div class="kol-select-card" data-id="{{ $item->id }}">
        <div class="kol-info-box">
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
        </div>
        <div class="kol-price">
            <div class="price-label">Giá ước tính</div>
            <div class="price-value">₫{{ formatDisplayNumber($item->price_campaign, 2) }}</div>
        </div>
    </div>
@empty
    <p style="text-align: center; color: var(--gray-500); padding: 2rem;">Không tìm thấy KOL phù hợp.</p>
@endforelse
