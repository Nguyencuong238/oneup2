@extends('layouts.user')

@section('meta')
    <meta name="description" content="OneUp KOL Explorer - Find and analyze TikTok influencers">
    <title>Khám phá KOL - OneUp KOL Analytics</title>
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

        .nav-badge {
            margin-left: auto;
            padding: 2px 8px;
            background: var(--danger);
            color: white;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
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

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .topbar-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid white;
        }

        /* KOL Explorer Specific Styles */
        .explorer-content {
            padding: 2rem;
        }

        .explorer-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 1.5rem;
        }

        /* Filter Sidebar */
        .filter-sidebar {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            height: fit-content;
            position: sticky;
            top: 24px;
            border: 1px solid var(--gray-200);
        }

        .filter-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .filter-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }

        .filter-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .filter-checkbox label {
            font-size: 14px;
            color: var(--gray-700);
            cursor: pointer;
            flex: 1;
        }

        .filter-count {
            font-size: 12px;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 2px 8px;
            border-radius: 10px;
        }

        .range-slider {
            margin-top: 1rem;
        }

        .range-input {
            width: 100%;
            accent-color: var(--primary);
        }

        .range-values {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--gray-600);
            margin-top: 0.5rem;
        }

        /* KOL List Container */
        .kol-list-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .results-info {
            font-size: 14px;
            color: var(--gray-600);
        }

        .results-count {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 16px;
        }

        .view-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .sort-dropdown {
            padding: 8px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            color: var(--gray-700);
            background: white;
            cursor: pointer;
            transition: all 0.2s;
        }

        .sort-dropdown:hover {
            border-color: var(--primary);
        }

        .view-toggle {
            display: flex;
            gap: 4px;
            background: var(--gray-100);
            padding: 4px;
            border-radius: 8px;
        }

        .view-btn {
            padding: 6px 10px;
            background: transparent;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            transition: all 0.2s;
        }

        .view-btn.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* KOL Cards Grid */
        .kol-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .kol-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .kol-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .kol-header {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .kol-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .kol-info {
            flex: 1;
        }

        .kol-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .kol-handle {
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }

        .kol-categories {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .category-tag {
            padding: 3px 8px;
            background: var(--gray-100);
            border-radius: 4px;
            font-size: 11px;
            color: var(--gray-700);
            font-weight: 500;
        }

        .kol-metrics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem 0;
            border-top: 1px solid var(--gray-100);
            border-bottom: 1px solid var(--gray-100);
        }

        .metric-item {
            text-align: center;
        }

        .metric-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .metric-label {
            font-size: 11px;
            color: var(--gray-600);
            margin-top: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .kol-engagement {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .engagement-rate {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rate-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .rate-excellent {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .rate-good {
            background: rgba(0, 102, 255, 0.1);
            color: var(--primary);
        }

        .rate-average {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .kol-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-700);
        }

        .action-btn:hover {
            background: var(--gray-50);
        }

        .action-btn.primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .action-btn.primary:hover {
            background: var(--primary-dark);
        }

        /* Table View */
        .kol-table-container {
            overflow-x: auto;
        }

        .kol-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kol-table th {
            text-align: left;
            padding: 12px 1.5rem;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        .kol-table td {
            padding: 16px 1.5rem;
            border-top: 1px solid var(--gray-100);
        }

        .kol-table tr:hover {
            background: var(--gray-50);
        }

        .table-kol-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .table-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .trend-up {
            color: var(--success);
        }

        .trend-down {
            color: var(--danger);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-btn {
            padding: 8px 12px;
            border: 1px solid var(--gray-200);
            background: white;
            border-radius: 6px;
            color: var(--gray-700);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn:hover {
            background: var(--gray-50);
            border-color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Compare Drawer */
        .compare-drawer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 2px solid var(--primary);
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
            max-height: 400px;
        }

        .compare-drawer.active {
            transform: translateY(0);
        }

        .drawer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .drawer-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .selected-count {
            background: var(--primary);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 14px;
            margin-left: 0.5rem;
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

            .explorer-container {
                grid-template-columns: 1fr;
            }

            .filter-sidebar {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .explorer-content {
                padding: 1rem;
            }

            .kol-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 1rem;
            }

            .page-title {
                font-size: 20px;
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
                <h1 class="page-title">Khám phá KOL</h1>
            </div>

            <div class="topbar-right">
                <button class="topbar-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <button class="topbar-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="notification-dot"></span>
                </button>

                <button class="btn btn-primary btn-small" onclick="openCompareDrawer()">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                    </svg>
                    So sánh KOL
                </button>
            </div>
        </div>

        <!-- Explorer Content -->
        <div class="explorer-content">
            <div class="explorer-container">
                <!-- Filter Sidebar -->
                <form class="filter-sidebar" id="filter-form">
                    <div class="filter-section">
                        <h3 class="filter-title">Danh mục</h3>
                        <div class="filter-group">
                            @foreach ($categories as $c)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="categories[]" id="cat-{{ $c->id }}"
                                        value="{{ $c->id }}" @if (in_array($c->id, request('categories', []))) checked @endif>
                                    <label for="cat-{{ $c->id }}">{{ $c->name }}</label>
                                    {{-- <span class="filter-count">{{ $c->kols()->count() }}</span> --}}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3 class="filter-title">Người theo dõi</h3>
                        <div class="range-slider">
                            <input type="range" name="followers" class="range-input" min="0" max="10000000"
                                step="100000" value="{{ request()->followers ?? 0 }}">
                            <div class="range-values">
                                <span class="min-value">0</span>
                                <span class="current-value">{{ formatDisplayNumber(request()->followers ?? 0) }}</span>
                                <span class="max-value">10M+</span>
                            </div>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3 class="filter-title">Tỷ lệ tương tác</h3>
                        <div class="filter-group">
                            <div class="filter-checkbox">
                                <input type="checkbox" name="engagement" id="eng-excellent"
                                    @if (request()->engagement >= 8) checked @endif>
                                <label for="eng-excellent">Xuất sắc (8%+)</label>
                                {{-- <span class="filter-count">45</span> --}}
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="engagement" id="eng-good"
                                    @if (request()->engagement >= 5) checked @endif>
                                <label for="eng-good">Tốt (5-8%)</label>
                                {{-- <span class="filter-count">112</span> --}}
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="engagement" id="eng-average"
                                    @if (request()->engagement >= 2.5) checked @endif>
                                <label for="eng-average">Trung bình (2-5%)</label>
                                {{-- <span class="filter-count">234</span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3 class="filter-title">Quốc gia</h3>
                        <div class="filter-group">
                            <div class="filter-checkbox">
                                <input type="checkbox" id="loc-vn">
                                <label for="loc-vn">Vietnam</label>
                                {{-- <span class="filter-count">567</span> --}}
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" id="loc-sg">
                                <label for="loc-sg">Singapore</label>
                                {{-- <span class="filter-count">89</span> --}}
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" id="loc-th">
                                <label for="loc-th">Thailand</label>
                                {{-- <span class="filter-count">123</span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3 class="filter-title">Điểm uy tín</h3>
                        <div class="range-slider">
                            <input type="range" name="trust_score" class="range-input" min="0" max="100"
                                value="{{ request()->trust_score ?? 0 }}">
                            <div class="range-values">
                                <span class="min-value">0</span>
                                <span class="current-value">{{ request()->trust_score - 0 }}</span>
                                <span class="max-value">100</span>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary justify-center" style="width: 100%; margin-top: 1rem;">
                        Áp dụng
                    </button>
                    <button type="button" class="btn btn-secondary justify-center"
                        style="width: 100%; margin-top: 0.5rem;"
                        onclick="window.location.href='{{ request()->url('') }}'">
                        Đặt lại
                    </button>
                </form>

                <!-- KOL List -->
                <div class="kol-list-container">
                    <div class="list-header">
                        <div class="results-info">
                            Đang hiển thị <span class="results-count">{{ $kols->count() }}</span> KOL
                        </div>

                        <div class="view-controls">
                            <select class="sort-dropdown" id="sortBy">
                                <option>-- Sắp xếp --</option>
                                <option value="engagement">Tỷ lệ tương tác</option>
                                <option value="followers">Lượt theo dõi</option>
                                <option value="trust_score">Điểm uy tín</option>
                            </select>

                            <div class="view-toggle">
                                <button class="view-btn active" onclick="switchView('grid')">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
                                    </svg>
                                </button>
                                <button class="view-btn" onclick="switchView('table')">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- KOL Grid -->
                    <div class="kol-grid" id="kolGrid">
                        <!-- KOL Cards -->
                        @foreach ($kols as $kol)
                            <div class="kol-card">
                                <div class="kol-header">
                                    {{-- <div class="kol-avatar">{{getFirstCharacter($kol->display_name)}}</div> --}}

                                    <img class="kol-avatar" src="{{ $kol->getFirstMediaUrl('media') }}">
                                    <div class="kol-info">
                                        <div class="kol-name">{{ $kol->display_name }}</div>
                                        <div class="kol-handle">{{ '@' . trim($kol->username, '@') }}</div>
                                        <div class="kol-categories">
                                            @foreach ($kol->categories as $kc)
                                                <span class="category-tag">{{ $kc->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="kol-metrics">
                                    <div class="metric-item">
                                        <div class="metric-value">{{ formatDisplayNumber($kol->followers) }}</div>
                                        <div class="metric-label">Người theo dõi</div>
                                    </div>
                                    <div class="metric-item">
                                        <div class="metric-value">{{ $kol->engagement - 0 }}%</div>
                                        <div class="metric-label">Tham gia</div>
                                    </div>
                                    <div class="metric-item">
                                        <div class="metric-value">{{ $kol->trust_score - 0 }}</div>
                                        <div class="metric-label">Điểm uy tín</div>
                                    </div>
                                </div>

                                @php
                                    $rankTexts = [
                                        'excellent' => 'Xuất sắc',
                                        'good' => 'Tốt',
                                        'average' => 'Trung bình',
                                    ];

                                    if ($kol->engagement < 2.5) {
                                        $rateRanking = null;
                                    } elseif ($kol->engagement >= 8) {
                                        $rateRanking = 'excellent';
                                    } elseif ($kol->engagement >= 5) {
                                        $rateRanking = 'good';
                                    } else {
                                        $rateRanking = 'average';
                                    }
                                @endphp

                                <div class="kol-engagement">
                                    <div class="engagement-rate">
                                        <span class="rate-badge rate-{{ $rateRanking }} text-transform-capitalize">
                                            {{ @$rankTexts[$rateRanking] }}
                                        </span>
                                    </div>
                                    <div class="kol-actions">
                                        <button class="action-btn"
                                            onclick="window.location.href='{{ route('user.kolProfile', $kol->id) }}'">Chi
                                            tiết</button>
                                        <button class="action-btn primary">Chọn</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- Add more KOL cards as needed -->
                    </div>

                    <!-- Table View (Hidden by default) -->
                    <div class="kol-table-container" id="kolTable" style="display: none;">
                        <table class="kol-table">
                            <thead>
                                <tr>
                                    <th>KOL</th>
                                    <th>Danh mục</th>
                                    <th>Người theo dõi</th>
                                    <th>Tham gia</th>
                                    <th>Điểm uy tín</th>
                                    <th>Tăng trưởng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kols as $kol)
                                    <tr>
                                        <td>
                                            <div class="table-kol-info">
                                                {{-- <div class="table-avatar">LN</div> --}}
                                                <img class="table-avatar" src="{{ $kol->getFirstMediaUrl('media') }}">
                                                <div>
                                                    <div class="kol-name">{{ $kol->display_name }}</div>
                                                    <div class="kol-handle">{{ '@' . trim($kol->username, '@') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kol-categories">
                                                @foreach ($kol->categories as $kc)
                                                    <span class="category-tag">{{ $kc->name }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="color-gray-700">{{ formatDisplayNumber($kol->followers) }}</td>
                                        <td><span class="rate-badge rate-excellent">{{ $kol->engagement - 0 }}%</span>
                                        </td>
                                        <td class="color-gray-700">{{ $kol->trust_score - 0 }}</td>
                                        <td class="trend-up">+12.3%</td>
                                        <td>
                                            <div class="kol-actions">
                                                <button class="action-btn">Xem</button>
                                                <button class="action-btn primary">Chọn</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $kols->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </main>
    <!-- Compare Drawer -->
    <div class="compare-drawer" id="compareDrawer">
        <div class="drawer-header">
            <div>
                <span class="drawer-title">So sánh KOL</span>
                <span class="selected-count">0</span>
            </div>
            <div style="display: flex; gap: 1rem;">
                <button class="btn btn-primary btn-small">Bắt đầu so sánh</button>
                <button class="btn btn-secondary btn-small" onclick="closeCompareDrawer()">Đóng</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        // View switcher
        function switchView(view) {
            const $gridView = $('#kolGrid');
            const $tableView = $('#kolTable');
            const $viewBtns = $('.view-btn');

            if (view === 'grid') {
                $gridView.css('display', 'grid');
                $tableView.hide();
                $viewBtns.eq(0).addClass('active');
                $viewBtns.eq(1).removeClass('active');
            } else {
                $gridView.hide();
                $tableView.show();
                $viewBtns.eq(0).removeClass('active');
                $viewBtns.eq(1).addClass('active');
            }
        }

        // Compare drawer
        function openCompareDrawer() {
            $('#compareDrawer').addClass('active');
        }

        function closeCompareDrawer() {
            $('#compareDrawer').removeClass('active');
        }

        // KOL selection
        $('.action-btn.primary').on('click', function(e) {
            e.stopPropagation();

            const $btn = $(this);
            const isSelected = $btn.hasClass('selected');

            $btn.toggleClass('selected');
            $btn.text(isSelected ? 'Chọn' : 'Đã chọn');

            // Update compare drawer count
            const selectedCount = $('.action-btn.selected').length;
            $('.selected-count').text(selectedCount);
        });

        $('#sortBy').on('change', function() {
            let val = $(this).val();

            let currentUrl = new URL(window.location.href);

            currentUrl.searchParams.set('sortBy', val);

            window.location.href = currentUrl.toString();
        })
    </script>


    <script>
        $(document).ready(function() {
            // Áp dụng cho tất cả range sliders
            $('.range-slider').each(function() {
                var $slider = $(this).find('.range-input');
                var $currentValue = $(this).find('.current-value');

                // Hiển thị giá trị ban đầu
                //$currentValue.text(formatNumber($slider.val()));

                // Khi kéo slider
                $slider.on('input', function() {
                    $currentValue.text(formatNumber($(this).val()));
                });
            });

            // Hàm định dạng số
            function formatNumber(num) {
                num = parseInt(num);
                if (num >= 1000000) {
                    return (num / 1000000).toFixed(1) + 'M';
                } else if (num >= 1000) {
                    return (num / 1000).toFixed(0) + 'K';
                } else {
                    return num;
                }
            }
        });
    </script>
@endsection
