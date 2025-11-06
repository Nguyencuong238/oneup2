@extends('layouts.brand_master')

@section('meta')
    <meta name="description" content="Quản lý chiến dịch OneUp - Theo dõi và quản lý các chiến dịch KOL TikTok của bạn">
    <title>Chiến dịch - OneUp KOL Analytics</title>
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
            gap: 10px;
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

        /* Campaign Specific Styles */
        .campaigns-content {
            padding: 2rem;
        }

        /* Campaign Stats */
        .campaign-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-blue);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0;
            gap: 5px;
        }

        .stat-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-lighter);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 14px;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        /* Campaign Tabs */
        .campaign-tabs-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .campaign-tabs {
            display: flex;
            gap: 2rem;
            padding: 0 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .campaign-tab {
            padding: 1rem 0;
            position: relative;
            color: var(--gray-600);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 2px solid transparent;
        }

        .campaign-tab:hover {
            color: var(--primary);
        }

        .campaign-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-badge {
            display: inline-block;
            margin-left: 0.5rem;
            padding: 2px 8px;
            background: var(--gray-100);
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .campaign-tab.active .tab-badge {
            background: var(--primary);
            color: white;
        }

        /* Campaign Grid */
        .campaigns-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .campaign-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .campaign-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .campaign-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .campaign-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 0.75rem;
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

        .campaign-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .campaign-dates {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 13px;
            color: var(--gray-600);
        }

        .campaign-body {
            padding: 1.5rem;
        }

        .campaign-metrics {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .metric {
            display: flex;
            flex-direction: column;
        }

        .metric-label {
            font-size: 12px;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }

        .metric-value {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .campaign-progress {
            margin-bottom: 1rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 13px;
        }

        .progress-label {
            color: var(--gray-600);
        }

        .progress-value {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: var(--gray-200);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--gradient-blue);
            border-radius: 10px;
            transition: width 0.3s;
        }


        .progress-completed {
            background: var(--success);
        }

        .progress-draft {
            background: var(--gray-400);
        }

        .progress-paused {
            background: var(--warning);
        }

        .campaign-kols {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .kol-avatars {
            display: flex;
            margin-right: 0.5rem;
        }

        .kol-avatar-small {
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
            border: 2px solid white;
            margin-right: -8px;
        }

        .kol-count {
            font-size: 13px;
            color: var(--gray-600);
        }

        .campaign-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--gray-100);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .campaign-budget {
            font-size: 14px;
            color: var(--gray-600);
        }

        .budget-amount {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .campaign-actions {
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

        /* Campaign List View */
        .campaigns-list {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .list-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .list-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding: 8px 14px 8px 36px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            width: 250px;
            transition: all 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .empty-description {
            color: var(--gray-600);
            margin-bottom: 1.5rem;
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

            .campaigns-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .campaigns-content {
                padding: 1rem;
            }

            .campaign-stats {
                grid-template-columns: 1fr;
            }

            .campaigns-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 1rem;
            }

            .page-title {
                font-size: 20px;
            }

            .search-input {
                width: 180px;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 26px;
            }

            .campaign-tabs {
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
                gap: 1rem;
                padding: 0 0.75rem;
                white-space: nowrap;
            }

            /* thinner / auto-hide scrollbar for campaign-tabs */
            .campaign-tabs {
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                /* Firefox */
                scrollbar-color: rgba(0, 0, 0, 0.12) transparent;
            }

            /* WebKit browsers */
            .campaign-tabs::-webkit-scrollbar {
                height: 6px;
            }

            .campaign-tabs::-webkit-scrollbar-track {
                background: transparent;
            }

            .campaign-tabs::-webkit-scrollbar-thumb {
                background: rgba(0, 0, 0, 0.12);
                border-radius: 999px;
                transition: opacity .25s, background .25s;
                opacity: 0;
                /* hidden when not interacting */
            }

            /* Reveal scrollbar when user hovers, focuses, or drags */
            .campaign-tabs:hover::-webkit-scrollbar-thumb,
            .campaign-tabs:focus-within::-webkit-scrollbar-thumb,
            .campaign-tabs:active::-webkit-scrollbar-thumb {
                opacity: 1;
            }

            /* Firefox: make thumb appear only on hover */
            .campaign-tabs:not(:hover) {
                scrollbar-color: transparent transparent;
            }

            .campaign-tabs:hover {
                scrollbar-color: rgba(0, 0, 0, 0.12) transparent;
            }

            .campaign-tab {
                white-space: nowrap;
            }

            /* Optional: nicer thin scrollbar on webkit */
            .campaign-tabs::-webkit-scrollbar {
                height: 6px;
            }

            .campaign-tabs::-webkit-scrollbar-thumb {
                background: rgba(0, 0, 0, 0.12);
                border-radius: 3px;
            }
        }
        @media (max-width: 480px) {
            .campaign-metrics {
                grid-template-columns: 1fr;
            }
            .campaign-actions {
                width: 100%;
            }
            .campaign-budget {
                display: none;
            }
            .campaign-actions button {
                width: 100%;
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
                <h1 class="page-title">Quản lý chiến dịch</h1>
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

                <div class="menu-toggle" onclick="$('.sidebar').toggleClass('active');">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <!-- Campaigns Content -->
        <div class="campaigns-content">
            <a href="{{ route('brand.campaign.planner') }}" class="btn btn-primary btn-small mb-3">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Chiến dịch mới
                </a>
            <!-- Campaign Stats -->
            <div class="campaign-stats">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Chiến dịch đang hoạt động</div>
                            <div class="stat-value">{{ $activeCount }}</div>
                            {{-- <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+{{ $activeCount }} tuần này</span>
                            </div> --}}
                        </div>
                        <div class="stat-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 1 1 0 000 2H6a2 2 0 100 4h2a2 2 0 100-4h2a1 1 0 100-2 2 2 0 00-2 2v11a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2H6z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Tổng ngân sách</div>
                            <div class="stat-value">₫{{ round($totalBudget / 1000000, 2) }}M</div>
                            {{-- <div class="stat-change positive">
                                <span style="color: var(--gray-600);">Đã chi {{ numberFormat($spentBudget / 1000000, 3) }}
                                    triệu ₫</span>
                            </div> --}}
                        </div>
                        <div class="stat-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Nhà sáng tạo nội dung đã tham gia</div>
                            <div class="stat-value">{{ $totalKols }}</div>
                            {{-- <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+{{ $totalKols }} mới</span>
                            </div> --}}
                        </div>
                        <div class="stat-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">ROI trung bình</div>
                            <div class="stat-value">{{ round($avgRoi, 1) }}x</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+0.5x</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Campaign Tabs -->
            <div class="campaign-tabs-container">
                <div class="campaign-tabs">
                    <div class="campaign-tab active" data-tab="all">
                        Tất cả chiến dịch
                        <span class="tab-badge">{{ $totalCampaigns }}</span>
                    </div>
                    <div class="campaign-tab" data-tab="active">
                        Đang hoạt động
                        <span class="tab-badge">{{ $activeCount }}</span>
                    </div>
                    <div class="campaign-tab" data-tab="draft">
                        Bản nháp
                        <span class="tab-badge">{{ $draftCount }}</span>
                    </div>
                    <div class="campaign-tab" data-tab="completed">
                        Đã hoàn thành
                        <span class="tab-badge">{{ $completedCount }}</span>
                    </div>
                    <div class="campaign-tab" data-tab="paused">
                        Tạm dừng
                        <span class="tab-badge">{{ $pausedCount }}</span>
                    </div>
                </div>
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
                <!-- Campaigns Grid -->
                <div class="campaigns-grid" id="campaignsGrid">
                    @foreach ($campaigns as $campaign)
                        <div class="campaign-card campaign-{{ $campaign->status }}">
                            <div class="campaign-header">
                                <span class="campaign-status status-{{ $campaign->status }}">
                                    {{ @$statusText[$campaign->status] }}
                                </span>
                                <h3 class="campaign-name">{{ $campaign->name }}</h3>
                                <div class="campaign-dates">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $campaign->start_date ? $campaign->start_date->format('d/m/Y') : '' }} -
                                        {{ $campaign->end_date ? $campaign->end_date->format('d/m/Y') : '' }}</span>
                                </div>
                            </div>
                            <div class="campaign-body">
                                <div class="campaign-metrics">
                                    <div class="metric">
                                        <span class="metric-label">Phạm vi tiếp cận</span>
                                        <span
                                            class="metric-value">{{ formatDisplayNumber($campaign->target_reach) }}</span>
                                    </div>
                                    <div class="metric">
                                        <span class="metric-label">Tương tác</span>
                                        <span class="metric-value">{{ $campaign->target_engagement }}%</span>
                                    </div>
                                    <div class="metric">
                                        <span class="metric-label">Ngân sách</span>
                                        <span class="metric-value">
                                            ₫{{ formatDisplayNumber($campaign->budget_amount) }}
                                        </span>
                                    </div>
                                    <div class="metric">
                                        <span class="metric-label">ROI</span>
                                        <span class="metric-value">{{ numberFormat($campaign->roi, 1) }}x</span>
                                    </div>
                                </div>
                                <div class="campaign-progress">
                                    <div class="progress-header">
                                        <span class="progress-label">Tiến độ chiến dịch</span>
                                        <span class="progress-value">{{ $campaign->progress ?? '0' }}%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill progress-{{ $campaign->status }}"
                                            style="width: {{ $campaign->progress ?? 0 }}%"></div>
                                    </div>
                                </div>
                                <div class="campaign-kols">
                                    <div class="kol-avatars">
                                        @foreach ($campaign->kols->take(3) as $kol)
                                            <img class="kol-avatar-small" src="{{ $kol->getFirstMediaUrl('media') }}">
                                        @endforeach
                                        @if ($campaign->kols->count() > 3)
                                            <div class="kol-avatar-small"
                                                style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                                                +{{ $campaign->kols->count() - 3 }}</div>
                                        @endif
                                    </div>
                                    <span class="kol-count">{{ $campaign->kols->count() }} Nhà sáng tạo nội dung tham
                                        gia</span>
                                </div>
                            </div>
                            <div class="campaign-footer">
                                <div class="campaign-budget">
                                    Ngân sách:
                                    <span class="budget-amount">
                                        ₫{{ numberFormat($campaign->budget_amount / 1000000, 3) }}M
                                    </span>
                                </div>
                                <div class="campaign-actions">
                                    @if ($campaign->status == 'active')
                                        <button class="action-btn js-navigate"
                                            data-href="{{ route('brand.campaign.detail', ['slug' => $campaign->slug]) }}">
                                            Xem
                                        </button>
                                        <button class="action-btn primary js-navigate"
                                            data-href="{{ route('brand.campaign.tracker', ['slug' => $campaign->slug]) }}">
                                            Theo dõi
                                        </button>
                                    @endif

                                    @if ($campaign->status == 'draft')
                                        <button class="action-btn js-navigate"
                                            data-href="{{ route('brand.campaign.planner', ['slug' => $campaign->slug]) }}">
                                            Sửa
                                        </button>

                                        <form action="{{ route('brand.campaign.changeStatus') }}" method="post"
                                            class="change-status-form">
                                            @csrf
                                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                            <input type="hidden" name="status" value="active">

                                            <button class="action-btn primary">Khởi chạy</button>
                                        </form>
                                    @endif

                                    @if ($campaign->status == 'paused')
                                        <button class="action-btn js-navigate"
                                            data-href="{{ route('brand.campaign.detail', ['slug' => $campaign->slug]) }}">
                                            Xem
                                        </button>
                                        <form action="{{ route('brand.campaign.changeStatus') }}" method="post"
                                            class="change-status-form">
                                            @csrf
                                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                            <input type="hidden" name="status" value="active">

                                            <button class="action-btn primary">Tiếp tục</button>
                                        </form>
                                    @endif

                                    @if ($campaign->status == 'completed')
                                        <button class="action-btn">
                                            Báo cáo
                                        </button>
                                        <button class="action-btn primary js-navigate"
                                            data-href="{{ route('brand.campaign.planner', ['slug' => $campaign->slug, 'is_clone' => true]) }}">
                                            Nhân bản
                                        </button>
                                    @endif

                                    @if ($campaign->status == 'pending')
                                        <button class="action-btn js-navigate"
                                            data-href="{{ route('brand.campaign.planner', ['slug' => $campaign->slug]) }}">
                                            Sửa
                                        </button>
                                        <button class="action-btn primary">
                                            Chờ duyệt
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {

            // ====== Tab switching ======
            function switchTab(event, tab) {
                $('.campaign-tab').removeClass('active');
                $(event).addClass('active');

                if (tab == 'all') {
                    $('.campaign-card').removeClass('d-none');
                } else {
                    $(`.campaign-card:not(.campaign-${tab})`).addClass('d-none');
                    $('.campaign-' + tab).removeClass('d-none');
                }
            }

            // Gắn hàm vào global scope (để HTML có thể gọi)
            window.switchTab = switchTab;


            // ====== Animate stats on load ======
            function animateValue($element, start, end, duration) {
                const range = end - start;
                const increment = range / (duration / 10);
                let current = start;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= end) {
                        current = end;
                        clearInterval(timer);
                    }

                    const text = $element.text();
                    if (text.includes('M')) {
                        $element.text('₫' + current.toFixed(2) + 'M');
                    } else if (text.includes('x')) {
                        $element.text(current.toFixed(1) + 'x');
                    } else {
                        $element.text(Math.round(current));
                    }
                }, 10);
            }

            // Intersection Observer bằng jQuery (sử dụng window scroll detection)
            const $statCards = $('.stat-card');
            const animated = new WeakSet();

            function checkVisible() {
                $statCards.each(function() {
                    const $card = $(this);
                    const rect = this.getBoundingClientRect();

                    if (
                        rect.top >= 0 &&
                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
                    ) {
                        const $statValue = $card.find('.stat-value');
                        if ($statValue.length && !animated.has($statValue[0])) {
                            animated.add($statValue[0]);
                            const finalValue = $statValue.text();

                            if (finalValue.includes('₫')) {
                                const num = parseFloat(finalValue.replace(/[^\d.,]/g, ''));
                                animateValue($statValue, 0, num, 1000);
                            } else if (finalValue.includes('x')) {
                                const num = parseFloat(finalValue);
                                animateValue($statValue, 0, num, 1000);
                            } else {
                                const num = parseInt(finalValue);
                                animateValue($statValue, 0, num, 1000);
                            }
                        }
                    }
                });
            }

            $(window).on('scroll', checkVisible);
            checkVisible(); // chạy lần đầu khi load


            // ====== Animate progress bars ======
            setTimeout(() => {
                $('.progress-fill').each(function() {
                    const $bar = $(this);
                    const width = $bar.css('width');
                    $bar.css('width', '0');
                    setTimeout(() => {
                        $bar.css('width', width);
                    }, 100);
                });
            }, 300);


            // ====== Campaign card interactions ======
            $('.campaign-card').on('click', function(e) {
                if (!$(e.target).hasClass('action-btn')) {
                    console.log('Opening campaign details...');
                }
            });


            // ====== Mobile sidebar toggle ======
            window.toggleSidebar = function() {
                $('.sidebar').toggleClass('active');
            };

            // Delegated navigation for buttons using data-href
            $(document).on('click', '.js-navigate', function(e) {
                const href = $(this).data('href');
                if (href) {
                    window.location.href = href;
                }
            });

            // Delegated tab switching for elements with data-tab
            $(document).on('click', '.campaign-tab[data-tab]', function(e) {
                const tab = $(this).data('tab');
                switchTab(this, tab);
            });

        });
    </script>

    <script>
        $('.change-status-form').on('submit', function(e) {
            e.preventDefault();

            var status = $(this).find('input[name="status"]').val();
            var msg = '';

            if (status == 'active') {
                msg = 'Bạn có chắc chắn muốn chuyển chiến dịch sang trạng thái hoạt động?';
            } else {
                msg = 'Bạn có chắc chắn muốn tạm dừng chiến dịch?';
            }

            if (confirm(msg)) {
                this.submit();
            }

        });
    </script>
@endsection
