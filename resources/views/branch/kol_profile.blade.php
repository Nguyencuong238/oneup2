@extends('layouts.branch_master')

@section('meta')
    <meta name="description" content="Hồ sơ KOL - Bảng điều khiển phân tích OneUp">
    <title>{{ $kol->display_name }} - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Profile Specific Styles */
        body {
            background: #F8F9FA;
            min-height: 100vh;
        }

        .dashboard-layout {
            display: block;
            min-height: 100vh;
        }

        /* Reuse sidebar styles from dashboard */
        .sidebar {
            background: white;
            border-right: 1px solid var(--gray-200);
            padding: 1.5rem 0;
            position: fixed;
            height: 100vh;
            width: 260px;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 1rem;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-logo-icon {
            width: 42px;
            height: 42px;
            background: var(--gradient-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .sidebar-logo-text {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 4px;
            border-radius: 10px;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
        }

        .nav-item:hover {
            background: var(--gray-100);
            color: var(--primary);
        }

        .nav-item.active {
            background: var(--primary-lighter);
            color: var(--primary);
            font-weight: 500;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .main-content {
            margin-left: 260px;
            padding: 0;
            background: #F8F9FA;
        }

        /* Profile Header */
        .profile-header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem;
        }

        .profile-header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: 700;
            flex-shrink: 0;
            position: relative;
        }

        .profile-avatar.verified::after {
            content: '✓';
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 30px;
            height: 30px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            border: 3px solid white;
        }

        .profile-info {
            flex: 1;
        }
        .score-value {
            font-weight: 600;
        }
        .score-value.green {
            color: #16a34a; /* xanh lá */
        }
        .score-value.yellow {
            color: #eab308; /* vàng */
        }
        .score-value.red {
            color: #dc2626; /* đỏ */
        }

        .profile-top-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .profile-badges {
            display: flex;
            gap: 0.5rem;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-verified {
            background: var(--success);
            color: white;
        }

        .badge-tier {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .profile-handle {
            font-size: 16px;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .profile-bio {
            color: var(--gray-700);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .profile-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            padding: 6px 14px;
            background: var(--gray-100);
            border-radius: 20px;
            font-size: 13px;
            color: var(--gray-700);
        }

        .profile-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-action {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Profile Stats */
        .profile-stats {
            display: flex;
            gap: 3rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-200);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .stat-label {
            font-size: 13px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.25rem;
        }

        .stat-change {
            font-size: 12px;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        /* Tabs */
        .profile-tabs {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .tabs-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            gap: 2rem;
        }

        .tab {
            padding: 1rem 0;
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.2s;
            outline: none !important;
        }

        .tab:hover {
            color: var(--primary);
        }

        .tab.active {
            color: var(--primary);
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
        }

        /* Content Area */
        .profile-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Engagement Metrics */
        .metric-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .metric-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .metric-period {
            font-size: 13px;
            color: var(--gray-500);
        }

        .engagement-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .engagement-item {
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 8px;
        }

        .engagement-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-lighter);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .engagement-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .engagement-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Audience Demographics */
        .demo-section {
            margin-bottom: 1.5rem;
        }

        .demo-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 1rem;
        }

        .demo-bars {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .demo-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .demo-label {
            font-size: 13px;
            color: var(--gray-600);
            width: 80px;
        }

        .demo-progress {
            flex: 1;
            height: 24px;
            background: var(--gray-100);
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .demo-fill {
            height: 100%;
            background: var(--gradient-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 8px;
            color: white;
            font-size: 11px;
            font-weight: 600;
        }

        /* Recent Content */
        .content-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .content-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .content-item:hover {
            background: var(--gray-100);
            transform: translateX(4px);
        }

        .content-thumbnail {
            width: 80px;
            height: 80px;
            background: var(--gradient-blue);
            border-radius: 8px;
            flex-shrink: 0;
        }

        .content-details {
            flex: 1;
        }

        .content-title {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .content-stats {
            display: flex;
            gap: 1rem;
            font-size: 12px;
            color: var(--gray-600);
        }

        .content-stat {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Trust Score */
        .trust-score-container {
            text-align: center;
            padding: 2rem;
        }

        .trust-score-circle {
            width: 150px;
            height: 150px;
            margin: 0 auto 1rem;
            position: relative;
        }

        .trust-score-svg {
            transform: rotate(-90deg);
        }

        .trust-score-bg {
            fill: none;
            stroke: var(--gray-200);
            stroke-width: 10;
        }

        .trust-score-fill {
            fill: none;
            stroke: var(--success);
            stroke-width: 10;
            stroke-linecap: round;
            transition: stroke-dashoffset 1s ease;
        }

        .trust-score-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 36px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .trust-factors {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            text-align: left;
        }

        .trust-factor {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem;
            background: var(--gray-50);
            border-radius: 6px;
            font-size: 13px;
        }

        .trust-factor-label {
            color: var(--gray-700);
        }

        .trust-factor-value {
            font-weight: 600;
        }

        .trust-factor-value.good {
            color: var(--success);
        }

        .trust-factor-value.warning {
            color: var(--warning);
        }

        .trust-factor-value.danger {
            color: var(--danger);
        }

        /* Pricing Table */
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pricing-table th {
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        .pricing-table td {
            padding: 16px 12px;
            border-bottom: 1px solid var(--gray-100);
        }

        .pricing-table tr:last-child td {
            border-bottom: none;
        }

        .price-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .price-note {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }

        .trust-factor{
            color: #475569;
        }

        /* Responsive */
        @media (max-width: 1024px) {
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

            .trust-factor{
                color: #475569;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-header-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .trust-factor{
                color: #475569;
            }

            .profile-stats {
                justify-content: space-around;
            }

            .profile-actions {
                justify-content: center;
            }

            .engagement-grid {
                grid-template-columns: 1fr;
            }

            .tabs-container {
                overflow-x: auto;
                gap: 1rem;
            }

            .tab {
                white-space: nowrap;
            }
        }
    </style>
    <style>
    .tiktok-video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }

    .tiktok-video-item {
        position: relative;
    }

    .video-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .video-thumb {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
        filter: brightness(0.8);
        transition: all 0.3s ease;
    }

    .video-thumb:hover {
        transform: scale(1.05);
        filter: brightness(1);
    }

    .video-overlay-text {
        position: absolute;
        bottom: 12px;
        left: 12px;
        right: 12px;
        color: white;
        font-size: 17px; /* tăng cỡ chữ */
        line-height: 1.4;
        font-weight: 600;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
        display: -webkit-box;
        -webkit-line-clamp: 2; /* chỉ hiển thị 2 dòng */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
    }

    .pinned-tag {
        position: absolute;
        top: 8px;
        left: 8px;
        background-color: #ff3355;
        color: white;
        font-size: 12px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .video-stats {
        position: absolute;
        bottom: 8px;
        left: 10px;
        color: white;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 4px;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
    }
    </style>

@endsection

@section('page')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-header-content">
                <div class="profile-avatar verified">
                {{-- <div class="profile-avatar verified">NT</div> --}}
                <img class="profile-avatar verified" src="{{ $kol->getFirstMediaUrl('media') }}">
                </div>
                <div class="profile-info">
                    <div class="profile-top-row">
                        <h1 class="profile-name">{{ $kol->display_name }}</h1>
                        <div class="profile-badges">
                            @if ($kol->is_verified)
                                <span class="badge badge-verified">Đã xác minh</span>
                            @endif
                            {{-- <span class="badge badge-tier">Hạng Diamond</span> --}}
                        </div>
                    </div>

                    <div class="profile-handle">{{ '@' . trim($kol->username, '@') }}</div>

                    <div class="profile-bio">
                        {{ $kol->bio }}
                    </div>

                    <div class="profile-tags">
                        @foreach ($kol->categories as $kc)
                            <span class="tag">{{ $kc->name }}</span>
                        @endforeach
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ formatDisplayNumber($kol->followers) }}</div>
                            <div class="stat-label">Người theo dõi</div>
                            {{-- <div class="stat-change positive">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+12.5% (30d)</span>
                            </div> --}}
                        </div>

                        <div class="stat-item">
                            <div class="stat-value">{{ $kol->engagement - 0 }}%</div>
                            <div class="stat-label">Tỷ lệ tương tác</div>
                            {{-- <div class="stat-change positive">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+0.8% (7d)</span>
                            </div> --}}
                        </div>

                        <div class="stat-item">
                            <div class="stat-value">{{ $totalPosts }}</div>
                            <div class="stat-label">Bài đăng</div>
                            {{-- <div class="stat-change">
                                <span style="color: var(--gray-600);">3.2 bài viết/tuần</span>
                            </div> --}}
                        </div>

                        <div class="stat-item">
                            <div class="stat-value">{{ formatDisplayNumber($totalViews) }}</div>
                            <div class="stat-label">Lượt xem</div>
                            {{-- <div class="stat-change positive">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+28% (30d)</span>
                            </div> --}}
                        </div>
                    </div>
                </div>

                {{-- <div class="profile-actions">
                    <button class="btn-action btn-primary">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Thêm vào chiến dịch
                    </button>
                    <button class="btn-action btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Lưu
                    </button>
                    <button class="btn-action btn-secondary">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>
                        Chia sẻ
                    </button>
                </div> --}}
            </div>
        </div>

        <!-- Tabs -->
        <div class="profile-tabs">
            <div class="tabs-container">
                <a href="#overview" class="tab active">Tổng quan</a>
                <a href="#audience" class="tab">Khán giả</a>
                <a href="#content" class="tab">Nội dung</a>
                <a href="#performance" class="tab">Hiệu suất</a>
                <a href="#pricing" class="tab">Bảng giá</a>
                <a href="#history" class="tab">Lịch sử chiến dịch</a>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <div class="content-grid">
                <!-- Left Column -->
                <div>
                    <!-- Engagement Metrics -->
                    <div class="metric-card">
                            <div class="metric-header">
                                <h2 class="metric-title">Chỉ số Tương tác</h2>
                                <span class="metric-period">30 ngày gần đây</span>
                            </div>

                        <div class="engagement-grid">
                            <div class="engagement-item">
                                <div class="engagement-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="engagement-value">{{ $avgLikesText }}</div>
                                <div class="engagement-label">TB Lượt thích</div>
                            </div>

                            <div class="engagement-item">
                                <div class="engagement-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="engagement-value">{{ $avgLikesText }}</div>
                                <div class="engagement-label">TB Bình luận</div>
                            </div>

                            <div class="engagement-item">
                                <div class="engagement-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                    </svg>
                                </div>
                                <div class="engagement-value">{{ $avgSharesText }}</div>
                                <div class="engagement-label">TB Chia sẻ</div>
                            </div>

                            <div class="engagement-item">
                                <div class="engagement-icon">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="engagement-value">{{ $avgViewsText }}</div>
                                <div class="engagement-label">TB Lượt xem</div>
                            </div>
                        </div>
                    </div>

                    <!-- Audience Demographics -->
                    {{-- <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header">
                            <h2 class="metric-title">Nhân khẩu học của khán giả</h2>
                        </div>

                        <div class="demo-section">
                            <div class="demo-title">Giới tính</div>
                            <div class="demo-bars">
                                <div class="demo-bar">
                                    <span class="demo-label">Nữ</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 72%;">72%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">Nam</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 28%; background: var(--gray-600);">28%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="demo-section">
                            <div class="demo-title">Độ tuổi trung bình</div>
                            <div class="demo-bars">
                                <div class="demo-bar">
                                    <span class="demo-label">13-17</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 15%;">15%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">18-24</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 45%;">45%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">25-34</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 28%;">28%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">35+</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 12%;">12%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="demo-section">
                            <div class="demo-title">Khu vực hàng đầu</div>
                            <div class="demo-bars">
                                <div class="demo-bar">
                                    <span class="demo-label">TP HCM</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 42%;">42%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">Hanoi</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 28%;">28%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">Da Nang</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 15%;">15%</div>
                                    </div>
                                </div>
                                <div class="demo-bar">
                                    <span class="demo-label">khác</span>
                                    <div class="demo-progress">
                                        <div class="demo-fill" style="width: 15%;">15%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Recent Content -->
                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h2 class="metric-title" style="font-weight: bold; font-size: 20px;">Nội dung gần đây</h2>
                            <a href="#" style="color: var(--primary); font-size: 14px; text-decoration: none;">Xem tất cả →</a>
                        </div>

                        <div class="tiktok-video-grid">
                            @foreach($videos as $v)
                                <div class="tiktok-video-item">
                                    <div class="video-wrapper">
                                        <a href="https://www.tiktok.com/@ {{ $kol->username }}/video/{{ $v->platform_post_id }}"
                                            target="_blank" rel="noopener">
                                            <img src="{{ $v->thumbnail_url }}" alt="video thumbnail" class="video-thumb">
                                            @if($v->is_pinned ?? false)
                                                <span class="pinned-tag">Đã ghim</span>
                                            @endif
                                            <div class="video-overlay-text">
                                                {{ $v->title }}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="video-stats">
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ formatDisplayNumber($v->views_count) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Right Column -->
                <div>
                    <!-- Trust Score -->
                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header">
                            <h2 class="metric-title">Điểm uy tín</h2>
                        </div>

                        <div class="trust-score-container">
                            <div class="trust-score-circle">
                                <svg width="150" height="150">
                                    <circle cx="75" cy="75" r="60" class="trust-score-bg"></circle>
                                    <circle cx="75" cy="75" r="60" class="trust-score-fill"
                                        stroke-dasharray="377"
                                        stroke-dashoffset="{{ 377 - (377 * $trustScore / 100) }}"></circle>
                                </svg>
                                <div class="trust-score-text">{{ $trustScore }}</div>
                            </div>

                            <div class="trust-factors space-y-1">
                                <div class="trust-factor flex justify-between">
                                    <span>Người theo dõi thật</span>
                                    <span class="score-value @if($realFollowersScore >= 80) green 
                                                @elseif($realFollowersScore >= 50) yellow  
                                                @else red @endif">
                                        {{ $realFollowersScore }}%
                                    </span>
                                </div>
                                <div class="trust-factor flex justify-between">
                                    <span>Chất lượng tương tác</span>
                                    <span class="score-value @if($engagementQuality >= 80) green 
                                                @elseif($engagementQuality >= 50) yellow 
                                                @else red @endif">
                                        {{ $engagementQuality }}%
                                    </span>
                                </div>
                                <div class="trust-factor flex justify-between">
                                    <span>Tính xác thực bình luận</span>
                                    <span class="score-value @if($authenticComments >= 80) green 
                                                @elseif($authenticComments >= 50) yellow 
                                                @else red @endif">
                                        {{ $authenticComments }}%
                                    </span>
                                </div>
                                <div class="trust-factor flex justify-between">
                                    <span>Độ ổn định tăng trưởng</span>
                                    <span class="score-value @if($growthStability >= 80) green 
                                                @elseif($growthStability >= 50) yellow 
                                                @else red @endif">
                                        {{ $growthStability }}%
                                    </span>
                                </div>
                                <div class="trust-factor flex justify-between">
                                    <span>Chất lượng nội dung</span>
                                    <span class="score-value @if($contentQuality >= 80) green 
                                                @elseif($contentQuality >= 50) yellow 
                                                @else red @endif">
                                        {{ $contentQuality }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header">
                            <h2 class="metric-title">Giá ước tính</h2>
                        </div>

                        <table class="pricing-table">
                            <thead>
                                <tr>
                                    <th>Loại nội dung</th>
                                    <th>Khoảng giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="color: black">TikTok Video</td>
                                    <td>
                                        <div class="price-value">{{ numberFormat($kol->price_tiktok) }}</div>
                                        <div class="price-note">Cho mỗi bài đăng</div>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td style="color: black">Instagram Post</td>
                                    <td>
                                        <div class="price-value">₫15M - 20M</div>
                                        <div class="price-note">Bài đăng feed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: black">Instagram Story</td>
                                    <td>
                                        <div class="price-value">₫8M - 12M</div>
                                        <div class="price-note">24 giờ</div>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td style="color: black">Campaign Package</td>
                                    <td>
                                        <div class="price-value">{{ numberFormat($kol->price_campaign) }}</div>
                                        <div class="price-note">3 bài đăng + 3 story</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div
                            style="margin-top: 1rem; padding: 1rem; background: var(--primary-lighter); border-radius: 8px;">
                            <div
                                style="display: flex; align-items: center; gap: 0.5rem; color: var(--primary); font-size: 14px;">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Giá ước tính dựa trên phân tích thị trường</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header">
                            <h2 class="metric-title">Chỉ số hiệu suất</h2>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            {{-- <div style="padding: 1rem; background: var(--gray-50); border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--gray-600);">Tỷ lệ hoàn thành TB</span>
                                    <span style="font-size: 18px; font-weight: 600; color: var(--dark-blue);">
                                        {{ round($avgCompletionRate, 1) }}%
                                    </span>
                                </div>
                            </div> --}}

                            <div style="padding: 1rem; background: var(--gray-50); border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--gray-600);">Bài/tuần</span>
                                    <span style="font-size: 18px; font-weight: 600; color: var(--dark-blue);">
                                        {{ $postsPerWeek }}
                                    </span>
                                </div>
                            </div>

                            <div style="padding: 1rem; background: var(--gray-50); border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--gray-600);">Tỷ lệ phản hồi</span>
                                    <span style="font-size: 18px; font-weight: 600; color: var(--dark-blue);">
                                        {{ round($avgEngagementRate, 1) }}%
                                    </span>
                                </div>
                            </div>

                            <div style="padding: 1rem; background: var(--gray-50); border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 13px; color: var(--gray-600);">Điểm an toàn thương hiệu</span>
                                    <span style="font-size: 18px; font-weight: 600; color: var(--success);">
                                        {{ $brandSafetyScore }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        // Tab switching
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Animate Trust Score on scroll
            const animateTrustScore = () => {
                const scoreCircle = document.querySelector('.trust-score-fill');
                if (scoreCircle) {
                    const score = 87;
                    const circumference = 2 * Math.PI * 60;
                    const offset = circumference - (score / 100) * circumference;
                    scoreCircle.style.strokeDashoffset = offset;
                }
            };

            // Intersection Observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('trust-score-circle')) {
                            animateTrustScore();
                        }
                    }
                });
            });

            const trustScoreElement = document.querySelector('.trust-score-circle');
            if (trustScoreElement) {
                observer.observe(trustScoreElement);
            }

            // Content item hover effect
            document.querySelectorAll('.content-item').forEach(item => {
                item.addEventListener('click', function() {
                    console.log('Mở chi tiết nội dung...');
                });
            });

            // Action buttons
            document.querySelectorAll('.btn-action').forEach(btn => {
                btn.addEventListener('click', function() {
                    const action = this.textContent.trim();
                    console.log(`Đã nhấn hành động: ${action}`);
                });
            });
        });
    </script>
@endsection
