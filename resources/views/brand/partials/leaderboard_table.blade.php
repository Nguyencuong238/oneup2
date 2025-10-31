<div class="ranking-container" id="leaderboard-table">
    <div class="ranking-header d-none">
        <h2 class="ranking-title">Xếp hạng đầy đủ</h2>
    </div>

    <table class="ranking-table">
        <thead>
            <tr>
                <th style="width: 80px;">Thứ hạng</th>
                <th>KOL</th>
                <th>Người theo dõi</th>
                <th>Tỷ lệ tham gia</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topKols as $index => $kol)
                @continue($index < 3)
                <tr>
                    <td>
                        <span class="rank-number">{{ $index + 1 }}</span>
                    </td>
                    <td>
                        <div class="kol-cell">
                            <img class="kol-avatar-small" src="{{ $kol->getFirstMediaUrl('media') }}"
                                alt="{{ $kol->display_name }}">
                            <div class="kol-details">
                                <div class="kol-name">
                                    <a href="{{ route('brand.profile', ['username' => trim($kol->username, '@')]) }}"
                                        class="color-dark-blue">
                                        {{ $kol->display_name }}
                                    </a>
                                </div>
                                <div class="kol-category">{{ $kol->categories->first()?->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="color: black">{{ formatDisplayNumber($kol->followers) }}</td>
                    <td style="color: black">{{ $kol->engagement }}%</td>
                    <td>
                        <div class="score-bar">
                            <div class="bar-container">
                                <div class="bar-fill" style="width: {{ $kol->engagement }}%;"></div>
                            </div>
                            <span class="score-value">{{ $kol->engagement }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
