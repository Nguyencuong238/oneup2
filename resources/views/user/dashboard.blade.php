@extends('layouts.user')

@section('meta')
    <meta name="description" content="OneUp KOL Analytics Dashboard - Monitor your TikTok influencer campaigns">
    <title>Dashboard - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Dashboard Specific Styles */
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

        /* Dashboard Content */
        .dashboard-content {
            padding: 2rem;
        }

        /* Stats Cards */
        .stats-grid {
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

        .stat-period {
            color: var(--gray-500);
            font-size: 12px;
        }

        /* Charts */
        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .chart-tabs {
            display: flex;
            gap: 0.5rem;
        }

        .chart-tab {
            padding: 6px 14px;
            background: transparent;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .chart-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .chart-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .chart-area {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gray-50);
            border-radius: 8px;
            color: var(--gray-500);
        }

        /* Tables */
        .dashboard-table {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .table-action {
            color: var(--primary);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .table-action:hover {
            gap: 0.75rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 12px 1.5rem;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        td {
            padding: 16px 1.5rem;
            border-top: 1px solid var(--gray-100);
        }

        tr:hover {
            background: var(--gray-50);
        }

        .kol-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .kol-avatar-small {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .kol-name-small {
            font-weight: 500;
            color: var(--dark-blue);
        }

        .kol-handle-small {
            font-size: 12px;
            color: var(--gray-500);
        }

        .trend-up {
            color: var(--success);
        }

        .trend-down {
            color: var(--danger);
        }

        /* Activity Feed */
        .activity-feed {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-lighter);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 12px;
            color: var(--gray-500);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quick-action {
            background: white;
            border: 2px dashed var(--gray-300);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: var(--gray-600);
        }

        .quick-action:hover {
            border-color: var(--primary);
            border-style: solid;
            background: var(--primary-lighter);
            color: var(--primary);
            transform: translateY(-4px);
        }

        .quick-action-icon {
            font-size: 24px;
            margin-bottom: 0.5rem;
        }

        .quick-action-text {
            font-weight: 500;
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

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .dashboard-content {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 1rem;
            }

            .page-title {
                font-size: 20px;
            }

            .date-range-selector {
                display: none;
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
                <h1 class="page-title">Dashboard Overview</h1>
                <div class="date-range-selector">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Last 30 Days</span>
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
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

                <a href="../index.html" class="btn btn-primary btn-small">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    New Campaign
                </a>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{route('user.kolExplorer')}}" class="quick-action">
                    <div class="quick-action-icon">🔍</div>
                    <div class="quick-action-text">Find KOLs</div>
                </a>
                <a href="{{route('user.campaign.index')}}" class="quick-action">
                    <div class="quick-action-icon">📊</div>
                    <div class="quick-action-text">Create Campaign</div>
                </a>
                <a href="{{route('user.report')}}" class="quick-action">
                    <div class="quick-action-icon">📈</div>
                    <div class="quick-action-text">Generate Report</div>
                </a>
                <a href="{{route('user.analytic')}}" class="quick-action">
                    <div class="quick-action-icon">💡</div>
                    <div class="quick-action-text">View Insights</div>
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Reach</div>
                            <div class="stat-value">45.2M</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+28.7%</span>
                                <span class="stat-period">vs last month</span>
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
                            <div class="stat-title">Active Campaigns</div>
                            <div class="stat-value">18</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>+3</span>
                                <span class="stat-period">new this week</span>
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
                            <div class="stat-title">Avg. Engagement</div>
                            <div class="stat-value">4.8%</div>
                            <div class="stat-change negative">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                                    style="transform: rotate(180deg);">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>-0.3%</span>
                                <span class="stat-period">vs last week</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Spend</div>
                            <div class="stat-value">285M</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>3.2x ROI</span>
                                <span class="stat-period">this month</span>
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
            </div>

            <!-- Charts Row -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                <!-- Performance Chart -->
                <div class="chart-container">
                    <div class="chart-header">
                        <h2 class="chart-title">Campaign Performance</h2>
                        <div class="chart-tabs">
                            <button class="chart-tab active">Views</button>
                            <button class="chart-tab">Engagement</button>
                            <button class="chart-tab">Conversions</button>
                        </div>
                    </div>
                    <div class="chart-area">
                        <span>Chart will be rendered here</span>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="activity-feed">
                    <h2 class="chart-title" style="margin-bottom: 1rem;">Recent Activity</h2>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Campaign "Summer Fashion" launched</div>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--success);">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New KOL added: @fashionista.vn</div>
                            <div class="activity-time">5 hours ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Low engagement alert: Tech Review campaign</div>
                            <div class="activity-time">8 hours ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 1 1 0 000 2H6a2 2 0 100 4h2a2 2 0 100-4h2a1 1 0 100-2 2 2 0 00-2 2v11a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2H6z" />
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Monthly report generated</div>
                            <div class="activity-time">1 day ago</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Performing KOLs Table -->
            <div class="dashboard-table" style="margin-top: 2rem;">
                <div class="table-header">
                    <h2 class="table-title">Top Performing KOLs</h2>
                    <a href="{{route('user.analytic')}}" class="table-action">
                        View All
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>KOL</th>
                            <th>Category</th>
                            <th>Followers</th>
                            <th>Engagement</th>
                            <th>Campaigns</th>
                            <th>Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small">NT</div>
                                    <div>
                                        <div class="kol-name-small">Ngọc Trinh</div>
                                        <div class="kol-handle-small">@ngoctrinh.official</div>
                                    </div>
                                </div>
                            </td>
                            <td>Fashion</td>
                            <td>2.8M</td>
                            <td>
                                <span class="trend-up">5.8%</span>
                            </td>
                            <td>3</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <span style="color: var(--success);">+42%</span>
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                                        style="color: var(--success);">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small">MH</div>
                                    <div>
                                        <div class="kol-name-small">Minh Hằng</div>
                                        <div class="kol-handle-small">@minhhang.beauty</div>
                                    </div>
                                </div>
                            </td>
                            <td>Beauty</td>
                            <td>1.5M</td>
                            <td>
                                <span class="trend-up">7.2%</span>
                            </td>
                            <td>2</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <span style="color: var(--success);">+38%</span>
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                                        style="color: var(--success);">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="kol-cell">
                                    <div class="kol-avatar-small">TL</div>
                                    <div>
                                        <div class="kol-name-small">Thùy Linh</div>
                                        <div class="kol-handle-small">@thuylinh.food</div>
                                    </div>
                                </div>
                            </td>
                            <td>Food</td>
                            <td>890K</td>
                            <td>
                                <span class="trend-up">9.1%</span>
                            </td>
                            <td>4</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <span style="color: var(--success);">+55%</span>
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                                        style="color: var(--success);">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
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
    <script>
        // Dashboard interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Chart tabs
            document.querySelectorAll('.chart-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove(
                        'active'));
                    this.classList.add('active');
                });
            });

            // Quick actions hover effect
            document.querySelectorAll('.quick-action').forEach(action => {
                action.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                action.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Animate stats on load
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
                        element.textContent = (current / 1000000).toFixed(1) + 'M';
                    } else if (element.textContent.includes('%')) {
                        element.textContent = current.toFixed(1) + '%';
                    } else if (element.textContent.includes('₫')) {
                        element.textContent = '₫' + Math.round(current) + 'M';
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

                            if (finalValue.includes('M')) {
                                const num = parseFloat(finalValue) * 1000000;
                                animateValue(statValue, 0, num, 1000);
                            } else if (finalValue.includes('%')) {
                                const num = parseFloat(finalValue);
                                animateValue(statValue, 0, num, 1000);
                            } else if (finalValue.includes('₫')) {
                                const num = parseInt(finalValue.replace(/[^\d]/g, ''));
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
        });

        // Mobile sidebar toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
@endsection
