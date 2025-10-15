@extends('layouts.user')

@section('meta')
    <meta name="description" content="OneUp Campaign Management - Track and manage your TikTok KOL campaigns">
    <title>Chiến dịch - Phân tích KOL OneUp</title>
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
            margin-bottom: 1rem;
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
            margin-bottom: 0.5rem;
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
            margin-bottom: -1px;
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
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-draft {
            background: rgba(156, 163, 175, 0.1);
            color: var(--gray-600);
        }

        .status-completed {
            background: rgba(0, 102, 255, 0.1);
            color: var(--primary);
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

                <button class="btn btn-primary btn-small" onclick="createNewCampaign()">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Chiến dịch mới
                </button>
            </div>
        </div>

        <!-- Campaigns Content -->
        <div class="campaigns-content">
            <!-- Campaign Stats -->
            <div class="campaign-stats">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Chiến dịch đang hoạt động</div>
                            <div class="stat-value">12</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+3 tuần này</span>
                            </div>
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
                            <div class="stat-value">₫450M</div>
                            <div class="stat-change positive">
                                <span style="color: var(--gray-600);">Đã chi 285 triệu ₫</span>
                            </div>
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
                            <div class="stat-title">KOLs tham gia</div>
                            <div class="stat-value">68</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+12 mới</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">ROI trung bình</div>
                            <div class="stat-value">3.8x</div>
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
                </div>
            </div>

            <!-- Campaign Tabs -->
            <div class="campaign-tabs-container">
                <div class="campaign-tabs">
                    <div class="campaign-tab active" onclick="switchTab('all')">
                        Tất cả các chiến dịch
                        <span class="tab-badge">18</span>
                    </div>
                    <div class="campaign-tab" onclick="switchTab('active')">
                        Hoạt động
                        <span class="tab-badge">12</span>
                    </div>
                    <div class="campaign-tab" onclick="switchTab('draft')">
                        Bản nháp
                        <span class="tab-badge">3</span>
                    </div>
                    <div class="campaign-tab" onclick="switchTab('completed')">
                        Đã hoàn thành
                        <span class="tab-badge">2</span>
                    </div>
                    <div class="campaign-tab" onclick="switchTab('paused')">
                        Đã tạm dừng
                        <span class="tab-badge">1</span>
                    </div>
                </div>

                <!-- Campaigns Grid -->
                <div class="campaigns-grid" id="campaignsGrid">
                    <!-- Campaign Card 1 - Active -->
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <span class="campaign-status status-active">Hoạt động</span>
                            <h3 class="campaign-name">Thời trang mùa hè 2024</h3>
                            <div class="campaign-dates">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>15 tháng 6 - 30 tháng 8 năm 2024</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div class="campaign-metrics">
                                <div class="metric">
                                    <span class="metric-label">Tổng phạm vi tiếp cận</span>
                                    <span class="metric-value">12.5M</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Lượt tương tác</span>
                                    <span class="metric-value">6.8%</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Chuyển đổi</span>
                                    <span class="metric-value">2,847</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">ROI</span>
                                    <span class="metric-value">4.2x</span>
                                </div>
                            </div>

                            <div class="campaign-progress">
                                <div class="progress-header">
                                    <span class="progress-label">Tiến trình chiến dịch</span>
                                    <span class="progress-value">68%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 68%"></div>
                                </div>
                            </div>

                            <div class="campaign-kols">
                                <div class="kol-avatars">
                                    <div class="kol-avatar-small">LN</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">MT</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">AP</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">+5</div>
                                </div>
                                <span class="kol-count">8 KOL tham gia</span>
                            </div>
                        </div>

                        <div class="campaign-footer">
                            <div class="campaign-budget">
                                Ngân sách: <span class="budget-amount">₫80M</span>
                            </div>
                            <div class="campaign-actions">
                                <button class="action-btn"
                                    onclick="window.location.href='{{ route('user.campaign.detail', ['slug' => 'test']) }}'">
                                    Xem
                                </button>
                                <button class="action-btn primary"
                                    onclick="window.location.href='{{ route('user.campaign.tracker', ['slug' => 'test']) }}'">
                                    Theo dõi
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 2 - Active -->
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <span class="campaign-status status-active">Hoạt động</span>
                            <h3 class="campaign-name">Ra mắt sản phẩm làm đẹp</h3>
                            <div class="campaign-dates">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>1 tháng 7 - 31 tháng 7 năm 2024</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div class="campaign-metrics">
                                <div class="metric">
                                    <span class="metric-label">Tổng phạm vi tiếp cận</span>
                                    <span class="metric-value">8.3M</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Lượt tương tác</span>
                                    <span class="metric-value">8.2%</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Chuyển đổi</span>
                                    <span class="metric-value">1,564</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">ROI</span>
                                    <span class="metric-value">3.5x</span>
                                </div>
                            </div>

                            <div class="campaign-progress">
                                <div class="progress-header">
                                    <span class="progress-label">Tiến trình chiến dịch</span>
                                    <span class="progress-value">45%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 45%"></div>
                                </div>
                            </div>

                            <div class="campaign-kols">
                                <div class="kol-avatars">
                                    <div class="kol-avatar-small">NT</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">MH</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">TL</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">+3</div>
                                </div>
                                <span class="kol-count">6 KOL tham gia</span>
                            </div>
                        </div>

                        <div class="campaign-footer">
                            <div class="campaign-budget">
                                Ngân sách: <span class="budget-amount">₫60M</span>
                            </div>
                            <div class="campaign-actions">
                                <button class="action-btn"
                                    onclick="window.location.href='{{ route('user.campaign.detail', ['slug' => 'test']) }}'">
                                    Xem
                                </button>
                                <button class="action-btn primary"
                                    onclick="window.location.href='{{ route('user.campaign.tracker', ['slug' => 'test']) }}'">
                                    Theo dõi</button>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 3 - Draft -->
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <span class="campaign-status status-draft">Bản nháp</span>
                            <h3 class="campaign-name">Loạt bài đánh giá công nghệ</h3>
                            <div class="campaign-dates">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Dự kiến: 1 tháng 8 - 30 tháng 9</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div class="campaign-metrics">
                                <div class="metric">
                                    <span class="metric-label">Ước tính đạt được</span>
                                    <span class="metric-value">5M</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Mục tiêu Eng.</span>
                                    <span class="metric-value">5%</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Est. Conv.</span>
                                    <span class="metric-value">800</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Mục tiêu ROI</span>
                                    <span class="metric-value">3x</span>
                                </div>
                            </div>

                            <div class="campaign-progress">
                                <div class="progress-header">
                                    <span class="progress-label">Tiến trình thiết lập</span>
                                    <span class="progress-value">30%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 30%; background: var(--gray-400);"></div>
                                </div>
                            </div>

                            <div class="campaign-kols">
                                <div class="kol-avatars">
                                    <div class="kol-avatar-small" style="background: var(--gray-400);">?</div>
                                </div>
                                <span class="kol-count">0 KOL đã chọn</span>
                            </div>
                        </div>

                        <div class="campaign-footer">
                            <div class="campaign-budget">
                                Ngân sách: <span class="budget-amount">₫40M</span>
                            </div>
                            <div class="campaign-actions">
                                <button class="action-btn">Sửa</button>
                                <button class="action-btn primary">Ra mắt</button>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 4 - Completed -->
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <span class="campaign-status status-completed">Hoàn thành</span>
                            <h3 class="campaign-name">Lễ hội ẩm thực 2024</h3>
                            <div class="campaign-dates">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Ngày 1 tháng 5 - Ngày 31 tháng 5 năm 2024</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div class="campaign-metrics">
                                <div class="metric">
                                    <span class="metric-label">Tổng phạm vi tiếp cận</span>
                                    <span class="metric-value">15.8M</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Lượt tương tác</span>
                                    <span class="metric-value">9.2%</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Chuyển đổi</span>
                                    <span class="metric-value">3,245</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">ROI</span>
                                    <span class="metric-value">5.1x</span>
                                </div>
                            </div>

                            <div class="campaign-progress">
                                <div class="progress-header">
                                    <span class="progress-label">Tiến trình chiến dịch</span>
                                    <span class="progress-value">100%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 100%; background: var(--success);"></div>
                                </div>
                            </div>

                            <div class="campaign-kols">
                                <div class="kol-avatars">
                                    <div class="kol-avatar-small">AP</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">TL</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">DH</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">+7</div>
                                </div>
                                <span class="kol-count">10 KOL đã tham gia</span>
                            </div>
                        </div>

                        <div class="campaign-footer">
                            <div class="campaign-budget">
                                Ngân sách: <span class="budget-amount">₫100M</span>
                            </div>
                            <div class="campaign-actions">
                                <button class="action-btn">Báo cáo</button>
                                <button class="action-btn primary">Nhân bản</button>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 5 - Paused -->
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <span class="campaign-status status-paused">Tạm dừng</span>
                            <h3 class="campaign-name">Giải đấu trò chơi</h3>
                            <div class="campaign-dates">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>20 tháng 6 - Tạm dừng</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div class="campaign-metrics">
                                <div class="metric">
                                    <span class="metric-label">Tổng phạm vi tiếp cận</span>
                                    <span class="metric-value">3.2M</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Lượt tương tác</span>
                                    <span class="metric-value">4.1%</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Chuyển đổi</span>
                                    <span class="metric-value">425</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">ROI</span>
                                    <span class="metric-value">2.1x</span>
                                </div>
                            </div>

                            <div class="campaign-progress">
                                <div class="progress-header">
                                    <span class="progress-label">Tiến trình chiến dịch</span>
                                    <span class="progress-value">35%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 35%; background: var(--warning);"></div>
                                </div>
                            </div>

                            <div class="campaign-kols">
                                <div class="kol-avatars">
                                    <div class="kol-avatar-small">HV</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">DN</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">+2</div>
                                </div>
                                <span class="kol-count">4 KOL tham gia</span>
                            </div>
                        </div>

                        <div class="campaign-footer">
                            <div class="campaign-budget">
                                Ngân sách: <span class="budget-amount">₫50M</span>
                            </div>
                            <div class="campaign-actions">
                                <button class="action-btn"
                                    onclick="window.location.href='{{ route('user.campaign.detail', ['slug' => 'test']) }}'">
                                    Xem
                                </button>
                                <button class="action-btn primary">Tiếp tục</button>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 6 - Active -->
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <span class="campaign-status status-active">Hoạt động</span>
                            <h3 class="campaign-name">Thử thách thể hình</h3>
                            <div class="campaign-dates">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>15 tháng 7 - 15 tháng 8, 2024</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div class="campaign-metrics">
                                <div class="metric">
                                    <span class="metric-label">Tổng phạm vi tiếp cận</span>
                                    <span class="metric-value">6.7M</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Lượt tương tác</span>
                                    <span class="metric-value">7.3%</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">Chuyển đổi</span>
                                    <span class="metric-value">892</span>
                                </div>
                                <div class="metric">
                                    <span class="metric-label">ROI</span>
                                    <span class="metric-value">3.9x</span>
                                </div>
                            </div>

                            <div class="campaign-progress">
                                <div class="progress-header">
                                    <span class="progress-label">Tiến trình chiến dịch</span>
                                    <span class="progress-value">25%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 25%"></div>
                                </div>
                            </div>

                            <div class="campaign-kols">
                                <div class="kol-avatars">
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">TL</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">HM</div>
                                    <div class="kol-avatar-small"
                                        style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">+3</div>
                                </div>
                                <span class="kol-count">5 KOL tham gia</span>
                            </div>
                        </div>

                        <div class="campaign-footer">
                            <div class="campaign-budget">
                                Ngân sách: <span class="budget-amount">₫35M</span>
                            </div>
                            <div class="campaign-actions">
                                <button class="action-btn"
                                    onclick="window.location.href='{{ route('user.campaign.detail', ['slug' => 'test']) }}'">
                                    Xem
                                </button>
                                <button class="action-btn primary">Quản lý</button>
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
        // Tab switching
        function switchTab(tab) {
            document.querySelectorAll('.campaign-tab').forEach(t => {
                t.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter campaigns based on tab
            console.log('Switching to tab:', tab);
        }

        // Create new campaign
        function createNewCampaign() {
            console.log('Creating new campaign...');
            // Navigate to campaign creation page
        }

        // Animate stats on load
        document.addEventListener('DOMContentLoaded', function() {
            const animateValue = (element, start, end, duration) => {
                const range = end - start;
                const increment = range / (duration / 10);
                let current = start;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= end) {
                        current = end;
                        clearInterval(timer);
                    }

                    if (element.textContent.includes('M')) {
                        element.textContent = '₫' + Math.round(current) + 'M';
                    } else if (element.textContent.includes('x')) {
                        element.textContent = (current / 10).toFixed(1) + 'x';
                    } else {
                        element.textContent = Math.round(current);
                    }
                }, 10);
            };

            // Trigger animations for visible stat cards
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const statValue = entry.target.querySelector('.stat-value');
                        if (statValue && !statValue.animated) {
                            statValue.animated = true;
                            const finalValue = statValue.textContent;

                            if (finalValue.includes('₫')) {
                                const num = parseInt(finalValue.replace(/[^\d]/g, ''));
                                animateValue(statValue, 0, num, 1000);
                            } else if (finalValue.includes('x')) {
                                const num = parseFloat(finalValue) * 10;
                                animateValue(statValue, 0, num, 1000);
                            } else {
                                const num = parseInt(finalValue);
                                animateValue(statValue, 0, num, 1000);
                            }
                        }
                    }
                });
            });

            document.querySelectorAll('.stat-card').forEach(card => {
                observer.observe(card);
            });

            // Animate progress bars
            setTimeout(() => {
                document.querySelectorAll('.progress-fill').forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                });
            }, 300);
        });

        // Campaign card interactions
        document.querySelectorAll('.campaign-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking on buttons
                if (!e.target.classList.contains('action-btn')) {
                    console.log('Opening campaign details...');
                }
            });
        });

        // Mobile sidebar toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
@endsection
