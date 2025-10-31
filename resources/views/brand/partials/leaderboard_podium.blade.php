<div class="podium-section" id="leaderboard-podium">
    <div class="podium-container">
        @foreach ([1, 0, 2] as $i)
            @php
                $kol = $topKols[$i] ?? null;
            @endphp
            @if ($kol)
                <div class="podium-card">
                    <div class="podium-rank rank-{{ $i + 1 }}">{{ $i + 1 }}</div>
                    <img class="podium-avatar" src="{{ $kol->getFirstMediaUrl('media') }}" alt="{{ $kol->display_name }}">
                    <h3 class="podium-name">
                        <a href="{{ route('brand.profile', ['username' => trim($kol->username, '@')]) }}"
                            class="color-dark-blue">
                            {{ $kol->display_name }}
                        </a>
                    </h3>
                    <p class="podium-handle">{{ '@' . trim($kol->username, '@') }}</p>
                    <div class="podium-stats">
                        <div class="podium-stat">
                            <div class="stat-value">{{ formatDisplayNumber($kol->followers) }}</div>
                            <div class="stat-label">Người theo dõi</div>
                        </div>
                        <div class="podium-stat">
                            <div class="stat-value">{{ $kol->engagement }}%</div>
                            <div class="stat-label">Tỷ lệ tham gia</div>
                        </div>
                        <div class="podium-stat">
                            <div class="stat-value">{{ $kol->trust_score }}</div>
                            <div class="stat-label">Điểm</div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
