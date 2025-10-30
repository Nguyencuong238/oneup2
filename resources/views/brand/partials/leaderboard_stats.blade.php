<div class="stats-summary" id="leaderboard-stats">
    <div class="summary-card">
        <div class="summary-header">
            <div>
                <div class="summary-title">Tổng số KOL được theo dõi</div>
                <div class="summary-value">{{ $totalKols }}</div>
            </div>
            <div class="summary-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-header">
            <div>
                <div class="summary-title">Mức độ tương tác trung bình</div>
                <div class="summary-value">{{ round($avgEngagement, 2) }}%</div>
            </div>
            <div class="summary-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-header">
            <div>
                <div class="summary-title">Danh mục hàng đầu</div>
                <div class="summary-value">{{ $topCategory->name }}</div>
                <div class="summary-change">{{ formatDisplayNumber($topCategory->kols_count) }} KOL đang hoạt động</div>
            </div>
            <div class="summary-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-header">
            <div>
                <div class="summary-title">Tổng phạm vi tiếp cận</div>
                <div class="summary-value">{{ formatDisplayNumber($totalTargetReach) }}</div>
                <div class="summary-change">Người theo dõi kết hợp</div>
            </div>
            <div class="summary-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
</div>
