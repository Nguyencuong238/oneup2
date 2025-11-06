@extends('layouts.brand_master')

@section('meta')
    <meta name="description" content="Chi tiết chiến dịch OneUp - Giám sát và quản lý hiệu suất chiến dịch">
    <title>Chi tiết chiến dịch - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 0;
            background: #F8F9FA;
        }

        /* Top Bar */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .campaign-status {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-active {
            background: rgba(0, 102, 255, 0.1);
            color: var(--primary);
        }

        .status-pending {
            background: rgba(180, 16, 232, 0.1);
            color: #a900e0;
        }

        .status-draft {
            background: rgba(156, 163, 175, 0.1);
            color: var(--gray-600);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-paused {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Campaign Detail Content */
        .detail-content {
            padding: 2rem;
        }

        /* Campaign Header */
        .campaign-header-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .campaign-header-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .campaign-title-section {
            flex: 1;
        }

        .campaign-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .campaign-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            color: var(--gray-600);
            font-size: 14px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .campaign-actions {
            display: flex;
            gap: 0.75rem;
        }

        /* Progress Overview */
        .progress-overview {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .progress-title {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .progress-percentage {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .progress-bar-large {
            width: 100%;
            height: 12px;
            background: var(--gray-200);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .progress-fill-large {
            height: 100%;
            background: var(--gradient-blue);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .progress-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .progress-stat {
            text-align: center;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            margin-top: 0.25rem;
        }

        /* Metrics Cards */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .metric-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-lighter);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .metric-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .metric-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 14px;
        }

        .change-positive {
            color: var(--success);
        }

        .change-negative {
            color: var(--danger);
        }

        /* Content Tabs */
        .content-tabs-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .content-tabs {
            display: flex;
            gap: 2rem;
            padding: 0 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            overflow-x: auto;
        }

        .content-tab {
            white-space: nowrap;
            padding: 1rem 0;
            position: relative;
            color: var(--gray-600);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
        }

        .content-tab:hover {
            color: var(--primary);
        }

        .content-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-content {
            padding: 1.5rem;
            overflow: auto;
        }

        /* KOL Performance Table */
        .kol-performance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kol-performance-table th {
            text-align: left;
            padding: 12px;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        .kol-performance-table td {
            padding: 16px 12px;
            border-top: 1px solid var(--gray-100);
        }

        .kol-info-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .kol-avatar-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .kol-details {
            flex: 1;
        }

        .kol-name {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .kol-handle {
            font-size: 13px;
            color: var(--gray-600);
        }

        .performance-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .bar-container {
            width: 100px;
            height: 6px;
            background: var(--gray-200);
            border-radius: 3px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background: var(--gradient-blue);
            border-radius: 3px;
        }

        /* Content Feed */
        .content-feed {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .content-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .content-thumbnail {
            aspect-ratio: 9/16;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
        }

        .content-body {
            padding: 1rem;
        }

        .content-creator {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .creator-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .creator-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--dark-blue);
        }

        .content-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .content-stat {
            text-align: center;
            padding: 0.5rem;
            background: var(--gray-50);
            border-radius: 6px;
        }

        .content-stat-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .content-stat-label {
            font-size: 11px;
            color: var(--gray-600);
            margin-top: 0.25rem;
        }

        /* Timeline */
        .timeline-container {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-container::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--gray-200);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 2rem;
        }

        .timeline-marker {
            position: absolute;
            left: -24px;
            top: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--primary);
        }

        .timeline-content {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1rem;
        }

        .timeline-date {
            font-size: 12px;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }

        .timeline-title {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .timeline-description {
            font-size: 14px;
            color: var(--gray-700);
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .detail-content {
                padding: 1rem;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .progress-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-feed {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 480px) {
            .campaign-header-info {
                flex-direction: column-reverse;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <h1 class="page-title">Chi tiết chiến dịch</h1>
                @php
                    $statusText = [
                        'active' => 'Đang hoạt động',
                        'paused' => 'Tạm dừng',
                        'completed' => 'Đã hoàn thành',
                        'cancelled' => 'Đã hủy',
                        'draft' => 'Bản nháp',
                        'pending' => 'Chờ duyệt',
                    ];
                @endphp
                <span class="campaign-status status-{{ $campaign->status }}">{{ $statusText[$campaign->status] }}</span>
            </div>

            <div class="topbar-right">
                {{-- <button class="btn btn-secondary btn-small">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Xuất báo cáo
                </button> --}}

                <div class="menu-toggle" onclick="$('.sidebar').toggleClass('active');">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <!-- Campaign Detail Content -->
        <div class="detail-content">
            <!-- Campaign Header -->
            <div class="campaign-header-card">
                <div class="campaign-header-info">
                    <div class="campaign-title-section">
                        <h1 class="campaign-title">{{ $campaign->name ?? 'Không tên chiến dịch' }}</h1>
                        <div class="campaign-meta">
                            <div class="meta-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $campaign->start_date ? $campaign->start_date->format('d M Y') : '' }} -
                                    {{ $campaign->end_date ? $campaign->end_date->format('d M Y') : '' }}</span>
                            </div>
                            <div class="meta-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                <span>{{ $campaign->kols->count() }} nhà sáng tạo nội dung</span>
                            </div>
                            <div class="meta-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Ngân sách: ₫{{ number_format($totalBudget) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="campaign-actions">
                        @if (in_array($campaign->status, ['active', 'paused']))
                            <form action="{{ route('brand.campaign.changeStatus') }}" method="post" id="change-status-form">
                                @csrf
                                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                <input type="hidden" name="status"
                                    value="{{ $campaign->status == 'active' ? 'paused' : 'active' }}">

                                <button class="btn btn-secondary btn-small">
                                    {{ $campaign->status == 'active' ? 'Tạm dừng' : 'Tiếp tục' }}
                                </button>
                            </form>
                        @endif
                        <button class="btn btn-secondary btn-small"
                            onclick="window.location.href='{{ route('brand.campaign.planner', ['slug' => $campaign->slug, 'is_clone' => true]) }}'">Nhân
                            bản</button>
                    </div>
                </div>

                <!-- Progress Overview -->
                <div class="progress-overview">
                    <div class="progress-header">
                        <div>
                            <div class="progress-title">Tiến độ chiến dịch</div>
                            <div style="font-size: 14px; color: var(--gray-600); margin-top: 0.25rem;">Còn
                                {{ $remainingDays }} ngày
                            </div>
                        </div>
                        <div class="progress-percentage">{{ $progress }}%</div>
                    </div>
                    <div class="progress-bar-large">
                        <div class="progress-fill-large" style="width: 0%;"></div>
                    </div>
                    <div class="progress-stats">
                        <div class="progress-stat">
                            <div class="stat-value">{{ $durationDays ?? 'N/A' }} ngày</div>
                            <div class="stat-label">Thời lượng</div>
                        </div>
                        <div class="progress-stat">
                            <div class="stat-value">₫{{ number_format($spentBudget) }}</div>
                            <div class="stat-label">Đã chi</div>
                        </div>
                        <div class="progress-stat">
                            <div class="stat-value">{{ $contentPosted }}</div>
                            <div class="stat-label">Nội dung đã đăng</div>
                        </div>
                        <div class="progress-stat">
                            <div class="stat-value">{{ $currentRoi ? number_format($currentRoi, 2) . 'x' : 'N/A' }}</div>
                            <div class="stat-label">ROI hiện tại</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Grid -->
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-header">
                        <div>
                            <div class="metric-title">Tổng phạm vi tiếp cận</div>
                            <div class="metric-value">{{ $totalViews ? number_format($totalViews) : '0' }}</div>
                            {{-- <div class="metric-change change-positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+{{ isset($campaign->week_change_reach) ? number_format($campaign->week_change_reach) . ' tuần này' : '—' }}</span>
                            </div> --}}
                        </div>
                        <div class="metric-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div>
                            <div class="metric-title">Tỷ lệ tương tác</div>
                            <div class="metric-value">{{ $campaign->target_engagement }}%</div>
                            {{-- <div class="metric-change change-positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ isset($campaign->week_change_engagement) ? '+' . $campaign->week_change_engagement . '%' : '—' }}</span>
                            </div> --}}
                        </div>
                        <div class="metric-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div>
                            <div class="metric-title">Tổng chuyển đổi</div>
                            <div class="metric-value">{{ $campaign->target_conversions - 0 }}</div>
                            {{-- <div class="metric-change change-positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ isset($campaign->week_change_conversions) ? '+' . $campaign->week_change_conversions . ' mới' : '—' }}</span>
                            </div> --}}
                        </div>
                        <div class="metric-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div>
                            <div class="metric-title">Chi phí mỗi lượt xem</div>
                            <div class="metric-value">
                                {{ $totalViews ? '₫' . number_format($spentBudget / max(1, $totalViews), 2) : '0' }}</div>
                            {{-- <div class="metric-change change-negative">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                                    style="transform: rotate(180deg);">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ isset($campaign->week_change_cpv) ? '-₫' . number_format($campaign->week_change_cpv, 2) . ' giảm' : '—' }}</span>
                            </div> --}}
                        </div>
                        <div class="metric-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Tabs -->
            <div class="content-tabs-container">
                <div class="content-tabs">
                    <div class="content-tab active" data-tab="kols">Hiệu suất</div>
                    <div class="content-tab" data-tab="content">Nội dung</div>
                    <div class="content-tab" data-tab="timeline">Thời gian</div>
                    <div class="content-tab" data-tab="analytics">Phân tích</div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="kols-tab">
                    <table class="kol-performance-table">
                        <thead>
                            <tr>
                                <th>Nhà sáng tạo nội dung</th>
                                <th>Nội dung đã đăng</th>
                                <th>Tổng lượt xem</th>
                                <th>Tương tác</th>
                                <th>Chuyển đổi</th>
                                <th>Hiệu suất</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kolStats as $k)
                                @php
                                    $views = $k->views ?? 0;
                                    $eng = $k->engagement ?? 0;
                                    // Compute relative widths (cap at 100%) based on campaign totals
                                    $viewsWidth = $totalViews
                                        ? min(100, round(($views / max(1, $totalViews)) * 100))
                                        : 0;
                                    $engWidth = $campaign->target_engagement
                                        ? min(100, round(($eng / max(1, $campaign->target_engagement)) * 100))
                                        : min(100, $eng);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="kol-info-cell">
                                            <div class="kol-avatar-small">
                                                @if (!empty($k->avatar))
                                                    <img src="{{ $k->avatar }}" alt=""
                                                        style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                                @else
                                                    {{ strtoupper(substr($k->name ?? '', 0, 2)) }}
                                                @endif
                                            </div>
                                            <div class="kol-details">
                                                <div class="kol-name">{{ $k->name }}</div>
                                                <div class="kol-handle">{{ $k->handle ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="color-gray-700">{{ $k->content_posted ?? 0 }} nội dung</td>
                                    <td class="color-gray-700">
                                        <div class="performance-bar">
                                            <div class="bar-container">
                                                <div class="bar-fill" style="width: {{ $viewsWidth }}%;"></div>
                                            </div>
                                            <span>{{ number_format($views) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="performance-bar">
                                            <div class="bar-container">
                                                <div class="bar-fill" style="width: {{ $engWidth }}%;"></div>
                                            </div>
                                            <span class="color-gray-700">{{ is_numeric($eng) ? $eng . '%' : $eng }}</span>
                                        </div>
                                    </td>
                                    <td class="color-gray-700">{{ $k->conversions ?? 0 }}</td>
                                    <td>
                                        @if (($k->performance_label ?? '') == 'Good')
                                            <span style="color: var(--success); font-weight: 600;">Xuất sắc</span>
                                        @elseif(($k->performance_label ?? '') == 'Average')
                                            <span style="color: var(--primary); font-weight: 600;">Tốt</span>
                                        @elseif(($k->performance_label ?? '') == 'Poor')
                                            <span style="color: var(--danger); font-weight: 600;">Kém</span>
                                        @else
                                            <span style="color: var(--gray-600);">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Content Feed Tab (Hidden by default) -->
                <div class="tab-content" id="content-tab" style="display: none;">
                    <div class="content-feed">
                        @if (!empty($contents) && count($contents))
                            @foreach ($contents as $c)
                                <div class="content-card">
                                    <div class="content-thumbnail">{{ $c->type_icon ?? '🎬' }}</div>
                                    <div class="content-body">
                                        <div class="content-creator">
                                            <div class="creator-avatar">
                                                {{ strtoupper(substr($c->creator_name ?? ($c->creator_handle ?? 'C'), 0, 2)) }}
                                            </div>
                                            <span
                                                class="creator-name">{{ $c->creator_handle ?? ($c->creator_name ?? 'Unknown') }}</span>
                                        </div>
                                        <div class="content-stats">
                                            <div class="content-stat">
                                                <div class="content-stat-value">{{ number_format($c->views ?? 0) }}</div>
                                                <div class="content-stat-label">Lượt xem</div>
                                            </div>
                                            <div class="content-stat">
                                                <div class="content-stat-value">{{ number_format($c->likes ?? 0) }}</div>
                                                <div class="content-stat-label">Lượt thích</div>
                                            </div>
                                            <div class="content-stat">
                                                <div class="content-stat-value">{{ $c->engagement_rate ?? '0%' }}</div>
                                                <div class="content-stat-label">Tương tác</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="content-card">
                                <div class="content-thumbnail">🎬</div>
                                <div class="content-body">
                                    <div class="content-creator">
                                        <img class="creator-avatar"
                                            src="{{ $campaign->kols->first()->getFirstMediaUrl('media') }}">
                                        <span
                                            class="creator-name">{{ $campaign->kols->first()->handle ?? $campaign->kols->first()->display_name }}</span>
                                    </div>
                                    <div class="content-stats">
                                        <div class="content-stat">
                                            <div class="content-stat-value">{{ number_format($totalViews ?? 0) }}</div>
                                            <div class="content-stat-label">Lượt xem</div>
                                        </div>
                                        <div class="content-stat">
                                            <div class="content-stat-value">
                                                {{ number_format($kolStats->sum('likes') ?? 0) }}</div>
                                            <div class="content-stat-label">Lượt thích</div>
                                        </div>
                                        <div class="content-stat">
                                            <div class="content-stat-value">{{ $campaign->target_engagement ?? '0%' }}
                                            </div>
                                            <div class="content-stat-label">Tương tác</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline Tab (Hidden by default) -->
                <div class="tab-content" id="timeline-tab" style="display: none;">
                    <div class="timeline-container">
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">25 Tháng 7, 2024 - 14:30</div>
                                <div class="timeline-title">Mốc chiến dịch đạt được</div>
                                <div class="timeline-description">Chiến dịch đạt 10M lượt xem tổng cộng trên tất cả nội
                                    dung nhà sáng tạo nội dung
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">20 Tháng 7, 2024 - 11:15</div>
                                <div class="timeline-title">Đã đăng nội dung mới</div>
                                <div class="timeline-description">@linhnguyen_beauty đã đăng video giới thiệu bộ sưu tập
                                    mùa hè</div>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">15 Tháng 7, 2024 - 09:00</div>
                                <div class="timeline-title">Giữa chiến dịch</div>
                                <div class="timeline-description">50% thời lượng chiến dịch đã hoàn thành và đạt 65% mục
                                    tiêu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        jQuery(function($) {
            // Cache selectors
            const $tabs = $('.content-tab[data-tab]');
            const $tabContents = $('.tab-content');
            const $progressFill = $('.progress-fill-large');
            const progressValue = '{{ $progress }}';

            // Switch tab by element + name
            function switchTab(el, tab) {
                $tabContents.hide();
                $tabs.removeClass('active');
                $('#' + tab + '-tab').show();
                $(el).addClass('active');
            }

            // Bind delegated handler for tabs (in case tabs are dynamic)
            $(document).on('click', '.content-tab[data-tab]', function() {
                const tab = $(this).data('tab');
                switchTab(this, tab);
            });

            // Animate progress bar after a short delay
            setTimeout(() => {
                $progressFill.css('width', progressValue + '%');
            }, 300);

            // Animate metric values when visible using IntersectionObserver when available
            // Use requestAnimationFrame for smoother animations and reduce DOM thrashing
            function animateValue($el, start, end, duration, suffix) {
                const startTime = performance.now();
                const range = end - start;

                function step(now) {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const current = start + range * progress;

                    // Write only when necessary, avoid layout reads here
                    if (suffix === 'M') {
                        $el.text((current / 1000000).toFixed(1) + 'M');
                    } else if (suffix === '%') {
                        $el.text(current.toFixed(1) + '%');
                    } else if (suffix === '₫') {
                        $el.text('₫' + current.toFixed(2));
                    } else if (suffix === ',') {
                        $el.text(Math.round(current).toLocaleString());
                    }

                    if (progress < 1) {
                        requestAnimationFrame(step);
                    }
                }

                requestAnimationFrame(step);
            }

            function scheduleMetricAnimation($card) {
                const $metric = $card.find('.metric-value');
                if (!$metric.length || $metric[0].animated) return;
                $metric[0].animated = true;
                const finalValue = $metric.text().trim();

                if (!finalValue) return;

                if (finalValue.includes('M')) {
                    const num = parseFloat(finalValue) * 1000000;
                    animateValue($metric, 0, num, 1500, 'M');
                } else if (finalValue.includes('%')) {
                    const num = parseFloat(finalValue);
                    animateValue($metric, 0, num, 1500, '%');
                } else if (finalValue.includes('₫')) {
                    const num = parseFloat(finalValue.replace(/[^\d.-]/g, ''));
                    animateValue($metric, 0, num, 1500, '₫');
                } else {
                    // Try numeric parse with commas
                    const cleaned = finalValue.replace(/,/g, '');
                    const num = parseFloat(cleaned) || 0;
                    animateValue($metric, 0, num, 1500, ',');
                }
            }

            // Cache metric cards to avoid querying during observer callbacks
            const $metricCards = $('.metric-card');

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) scheduleMetricAnimation($(entry.target));
                    });
                }, { threshold: 0.2 });

                $metricCards.each(function() {
                    observer.observe(this);
                });
            } else {
                // Fallback: animate all immediately
                $metricCards.each(function() {
                    scheduleMetricAnimation($(this));
                });
            }

        });
    </script>
    <script>
        jQuery(function($) {
            $('#change-status-form').on('submit', function(e) {
                e.preventDefault();

                var status = $(this).find('input[name="status"]').val();
                var msg = '';

                if (status == 'active') {
                    msg = 'Bạn có chắc chắn muốn chuyển chiến dịch sang trạng thái hoạt động?';
                } else {
                    msg = 'Bạn có chắc chắn muốn tạm dừng chiến dịch?';
                }

                if (confirm(msg)) {
                    // submit bằng phương thức native để tránh kích hoạt lại handler jQuery
                    this.submit();
                }
                // nếu hủy, nothing to do (form đã bị preventDefault)
            });
        });
    </script>
@endsection
