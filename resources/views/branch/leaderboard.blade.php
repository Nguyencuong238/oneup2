@extends('layouts.branch_master')

@section('meta')
    <meta name="description" content="OneUp Leaderboards - Top performing KOLs rankings">
    <title>Leaderboards - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Base styles from dashboard */
        body {
            background: #F8F9FA;
            min-height: 100vh;
        }

        .dashboard-layout {
            display: block;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        /* Sidebar */
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

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--gray-100);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-profile:hover {
            background: var(--gray-200);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--gray-500);
        }

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
            gap: 2rem;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .date-range-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 8px 16px;
            background: var(--gray-100);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .date-range-selector:hover {
            background: var(--gray-200);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Leaderboards Content */
        .leaderboards-content {
            padding: 2rem;
        }

        /* Category Tabs */
        .category-tabs {
            background: white;
            border-radius: 12px;
            padding: 0.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
        }

        .category-tab {
            padding: 10px 20px;
            background: transparent;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .category-tab:hover {
            background: var(--gray-100);
        }

        .category-tab.active {
            background: var(--primary);
            color: white;
        }

        /* Top 3 Podium */
        .podium-section {
            margin-bottom: 2rem;
        }

        .podium-container {
            display: grid;
            grid-template-columns: 1fr 1.2fr 1fr;
            gap: 1rem;
            align-items: flex-end;
        }

        .podium-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid var(--gray-200);
            transition: all 0.3s;
            position: relative;
        }

        .podium-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        }

        .podium-rank {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            color: white;
        }

        .rank-1 {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            width: 48px;
            height: 48px;
            font-size: 24px;
        }

        .rank-2 {
            background: linear-gradient(135deg, #C0C0C0 0%, #808080 100%);
        }

        .rank-3 {
            background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
        }

        .podium-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin: 1.5rem auto 1rem;
        }

        .podium-1 .podium-avatar {
            width: 96px;
            height: 96px;
            font-size: 32px;
        }

        .podium-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .podium-handle {
            font-size: 14px;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .podium-stats {
            display: flex;
            justify-content: space-around;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .podium-stat {
            text-align: center;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .stat-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.25rem;
        }

        /* Ranking Table */
        .ranking-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .ranking-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ranking-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-select {
            padding: 8px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .ranking-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ranking-table th {
            text-align: left;
            padding: 12px 1.5rem;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        .ranking-table td {
            padding: 16px 1.5rem;
            border-top: 1px solid var(--gray-100);
        }

        .ranking-table tr:hover {
            background: var(--gray-50);
        }

        .rank-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--gray-100);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 14px;
        }

        .rank-change {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin-left: 0.5rem;
            font-size: 12px;
        }

        .change-up {
            color: var(--success);
        }

        .change-down {
            color: var(--danger);
        }

        .change-same {
            color: var(--gray-500);
        }

        .kol-cell {
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
            font-weight: 500;
            color: var(--dark-blue);
        }

        .kol-category {
            font-size: 12px;
            color: var(--gray-600);
        }

        .score-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .bar-container {
            width: 120px;
            height: 8px;
            background: var(--gray-200);
            border-radius: 4px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background: var(--gradient-blue);
            border-radius: 4px;
        }

        .score-value {
            font-weight: 600;
            color: var(--dark-blue);
            min-width: 40px;
        }

        /* Stats Summary */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .summary-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-lighter);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .summary-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .summary-change {
            font-size: 14px;
            color: var(--gray-600);
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

            .podium-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .leaderboards-content {
                padding: 1rem;
            }

            .stats-summary {
                grid-template-columns: 1fr;
            }

            .category-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
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
                <h1 class="page-title">Bảng xếp hạng KOL</h1>
                <div class="date-range-selector">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>30 ngày qua</span>
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <div class="topbar-right">
                <button class="btn btn-secondary btn-small">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Lọc
                </button>
                <button class="btn btn-primary btn-small">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Xuất file xếp hạng
                </button>
            </div>
        </div>

        <!-- Leaderboards Content -->
        <div class="leaderboards-content">
            <!-- Stats Summary -->
            <div class="stats-summary">
                <div class="summary-card">
                    <div class="summary-header">
                        <div>
                            <div class="summary-title">Tổng số KOL được theo dõi</div>
                            <div class="summary-value">1,234</div>
                            <div class="summary-change">+123 mới trong tháng này</div>
                        </div>
                        <div class="summary-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-header">
                        <div>
                            <div class="summary-title">Mức độ tương tác trung bình</div>
                            <div class="summary-value">7.2%</div>
                            <div class="summary-change">+0,8% so với tháng trước</div>
                        </div>
                        <div class="summary-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-header">
                        <div>
                            <div class="summary-title">Danh mục hàng đầu</div>
                            <div class="summary-value">Thời trang</div>
                            <div class="summary-change">234 KOL đang hoạt động</div>
                        </div>
                        <div class="summary-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-header">
                        <div>
                            <div class="summary-title">Tổng phạm vi tiếp cận</div>
                            <div class="summary-value">458M</div>
                            <div class="summary-change">Người theo dõi kết hợp</div>
                        </div>
                        <div class="summary-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Tabs -->
            <div class="category-tabs">
                <button class="category-tab active">Tất cả danh mục</button>
                <button class="category-tab">Thời trang & Làm đẹp</button>
                <button class="category-tab">Phong cách sống</button>
                <button class="category-tab">Ẩm thực & Đồ uống</button>
                <button class="category-tab">Công nghệ</button>
                <button class="category-tab">Du lịch</button>
                <button class="category-tab">Chơi game</button>
                <button class="category-tab">Thể dục</button>
            </div>

            <!-- Top 3 Podium -->
            <div class="podium-section">
                <div class="podium-container">
                    <!-- 2nd Place -->
                    <div class="podium-card">
                        <div class="podium-rank rank-2">2</div>
                        <div class="podium-avatar" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">MT
                        </div>
                        <h3 class="podium-name">Minh Trần</h3>
                        <p class="podium-handle">@minhtran_lifestyle</p>
                        <div class="podium-stats">
                            <div class="podium-stat">
                                <div class="stat-value">1.8M</div>
                                <div class="stat-label">Người theo dõi</div>
                            </div>
                            <div class="podium-stat">
                                <div class="stat-value">9.2%</div>
                                <div class="stat-label">Lượt tương tác</div>
                            </div>
                            <div class="podium-stat">
                                <div class="stat-value">94</div>
                                <div class="stat-label">Điểm</div>
                            </div>
                        </div>
                    </div>

                    <!-- 1st Place -->
                    <div class="podium-card podium-1">
                        <div class="podium-rank rank-1">1</div>
                        <div class="podium-avatar">LN</div>
                        <h3 class="podium-name">Linh Nguyễn</h3>
                        <p class="podium-handle">@linhnguyen_beauty</p>
                        <div class="podium-stats">
                            <div class="podium-stat">
                                <div class="stat-value">2.3M</div>
                                <div class="stat-label">Người theo dõi</div>
                            </div>
                            <div class="podium-stat">
                                <div class="stat-value">10.5%</div>
                                <div class="stat-label">Lượt tương tác</div>
                            </div>
                            <div class="podium-stat">
                                <div class="stat-value">98</div>
                                <div class="stat-label">Điểm</div>
                            </div>
                        </div>
                    </div>

                    <!-- 3rd Place -->
                    <div class="podium-card">
                        <div class="podium-rank rank-3">3</div>
                        <div class="podium-avatar" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            AP</div>
                        <h3 class="podium-name">An Phạm</h3>
                        <p class="podium-handle">@anpham_food</p>
                        <div class="podium-stats">
                            <div class="podium-stat">
                                <div class="stat-value">987K</div>
                                <div class="stat-label">Người theo dõi</div>
                            </div>
                            <div class="podium-stat">
                                <div class="stat-value">11.2%</div>
                                <div class="stat-label">Lượt tương tác</div>
                            </div>
                            <div class="podium-stat">
                                <div class="stat-value">92</div>
                                <div class="stat-label">Điểm</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ranking Table -->
            <div class="ranking-container">
                <div class="ranking-header">
                    <h2 class="ranking-title">Xếp hạng đầy đủ</h2>
                    <div class="filter-controls">
                        <select class="filter-select">
                            <option>Sắp xếp theo: Tổng điểm</option>
                            <option>Sắp xếp theo: Phần trăm lượt tương tác</option>
                            <option>Sắp xếp theo: Người theo dõi</option>
                            <option>Sắp xếp theo: Tốc độ tăng trưởng</option>
                        </select>
                        <select class="filter-select">
                            <option>Tất cả các địa điểm</option>
                            <option>Vietnam</option>
                            <option>Singapore</option>
                            <option>Thailand</option>
                        </select>
                    </div>
                </div>

                <table class="ranking-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Thứ hạng</th>
                            <th>KOL</th>
                            <th>Người theo dõi</th>
                            <th>Lượt tương tác</th>
                            <th>Sự phát triển</th>
                            <th>Điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="rank-number">4</span>
                                <span class="rank-change change-up">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    2
                                </span>
                            </td>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">HV</div>
                                    <div class="kol-details">
                                        <div class="kol-name">Hoàng Vũ</div>
                                        <div class="kol-category">Công nghệ</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color: black">765K</td>
                            <td style="color: black">8.4%</td>
                            <td class="change-up">+15.2%</td>
                            <td>
                                <div class="score-bar">
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: 88%;"></div>
                                    </div>
                                    <span class="score-value">88</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="rank-number">5</span>
                                <span class="rank-change change-down">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"
                                        style="transform: rotate(180deg);">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    1
                                </span>
                            </td>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">TL</div>
                                    <div class="kol-details">
                                        <div class="kol-name">Thảo Lê</div>
                                        <div class="kol-category">Thể dục & Sức khỏe</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color: black">543K</td>
                            <td style="color: black">9.1%</td>
                            <td class="change-up">+8.7%</td>
                            <td>
                                <div class="score-bar">
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: 85%;"></div>
                                    </div>
                                    <span class="score-value">85</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="rank-number">6</span>
                                <span class="rank-change change-same">
                                    <span style="font-size: 16px;">—</span>
                                </span>
                            </td>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">DN</div>
                                    <div class="kol-details">
                                        <div class="kol-name">Đức Nguyễn</div>
                                        <div class="kol-category">Hài kịch & Giải trí</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color: black">3.1M</td>
                            <td style="color: black">6.2%</td>
                            <td class="change-up">+5.3%</td>
                            <td>
                                <div class="score-bar">
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: 82%;"></div>
                                    </div>
                                    <span class="score-value">82</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="rank-number">7</span>
                                <span class="rank-change change-up">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    3
                                </span>
                            </td>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">TH</div>
                                    <div class="kol-details">
                                        <div class="kol-name">Thu Hương</div>
                                        <div class="kol-category">Du lịch & Phong cách sống</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color: black">892K</td>
                            <td style="color: black">7.8%</td>
                            <td class="change-up">+12.1%</td>
                            <td>
                                <div class="score-bar">
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: 80%;"></div>
                                    </div>
                                    <span class="score-value">80</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="rank-number">8</span>
                                <span class="rank-change change-down">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"
                                        style="transform: rotate(180deg);">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    2
                                </span>
                            </td>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">NH</div>
                                    <div class="kol-details">
                                        <div class="kol-name">Nam Hoàng</div>
                                        <div class="kol-category">Gaming</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color: black">1.2M</td>
                            <td style="color: black">5.9%</td>
                            <td class="change-down">-2.1%</td>
                            <td>
                                <div class="score-bar">
                                    <div class="bar-container">
                                        <div class="bar-fill" style="width: 78%;"></div>
                                    </div>
                                    <span class="score-value">78</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Category tabs
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Filter leaderboard by category
                filterByCategory(this.textContent);
            });
        });

        function filterByCategory(category) {
            console.log('Filtering by category:', category);
            // Implement category filtering logic
        }

        // Animate score bars on load
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bars = entry.target.querySelectorAll('.bar-fill');
                        bars.forEach(bar => {
                            const width = bar.style.width;
                            bar.style.width = '0';
                            setTimeout(() => {
                                bar.style.transition = 'width 1s ease';
                                bar.style.width = width;
                            }, 100);
                        });
                    }
                });
            });

            document.querySelectorAll('.ranking-table').forEach(table => {
                observer.observe(table);
            });

            // Animate podium cards
            const podiumCards = document.querySelectorAll('.podium-card');
            podiumCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });

        // Filter controls
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                console.log('Filter changed:', this.value);
                // Implement filtering logic
            });
        });
    </script>
@endsection
