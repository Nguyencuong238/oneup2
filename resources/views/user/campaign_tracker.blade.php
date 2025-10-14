@extends('layouts.user')

@section('meta')
    <meta name="description" content="OneUp Campaign Tracker - Real-time campaign performance tracking">
    <title>Campaign Tracker - OneUp KOL Analytics</title>
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

        /* Tracker Content */
        .tracker-content {
            padding: 2rem;
        }

        /* Campaign Selector */
        .campaign-selector-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .selector-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .selector-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .campaign-dropdown {
            padding: 10px 16px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            min-width: 300px;
        }

        .campaign-info {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-100);
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        /* Real-time Metrics */
        .realtime-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .realtime-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .realtime-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 60px;
            background: var(--primary);
            opacity: 0.05;
            border-radius: 50%;
            transform: translate(20px, -20px);
        }

        .realtime-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .realtime-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .live-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 11px;
            color: var(--success);
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .realtime-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .realtime-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 13px;
        }

        .change-positive {
            color: var(--success);
        }

        .change-negative {
            color: var(--danger);
        }

        /* Tracking Table */
        .tracking-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .tracking-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tracking-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .tracking-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .refresh-btn {
            padding: 8px 16px;
            background: var(--primary-lighter);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .refresh-btn:hover {
            background: var(--primary);
            color: white;
        }

        .tracking-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tracking-table th {
            text-align: left;
            padding: 12px 1.5rem;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        .tracking-table td {
            padding: 16px 1.5rem;
            border-top: 1px solid var(--gray-100);
        }

        .tracking-table tr:hover {
            background: var(--gray-50);
        }

        .content-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .content-thumbnail {
            width: 48px;
            height: 48px;
            background: var(--gradient-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .content-details {
            flex: 1;
        }

        .content-title {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .content-creator {
            font-size: 13px;
            color: var(--gray-600);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-live {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-scheduled {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-completed {
            background: rgba(0, 102, 255, 0.1);
            color: var(--primary);
        }

        .metric-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .trend-icon {
            width: 16px;
            height: 16px;
        }

        /* Alert Section */
        .alerts-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .alerts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .alerts-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .alert-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 8px;
            margin-bottom: 0.75rem;
        }

        .alert-item:last-child {
            margin-bottom: 0;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .alert-description {
            font-size: 14px;
            color: var(--gray-600);
        }

        .alert-time {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }

        /* Performance Chart */
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
            color: var(--gray-600);
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
            background: var(--gray-50);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
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

            .realtime-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .tracker-content {
                padding: 1rem;
            }

            .campaign-info {
                flex-direction: column;
                gap: 1rem;
            }

            .realtime-grid {
                grid-template-columns: 1fr;
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
                <h1 class="page-title">Campaign Tracker</h1>
                <div class="date-range-selector">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Real-time</span>
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
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Export Data
                </button>
                <button class="btn btn-primary btn-small">
                    Add Content Link
                </button>
            </div>
        </div>

        <!-- Tracker Content -->
        <div class="tracker-content">
            <!-- Campaign Selector -->
            <div class="campaign-selector-card">
                <div class="selector-header">
                    <h2 class="selector-title">Select Campaign to Track</h2>
                    <select class="campaign-dropdown">
                        <option selected>Summer Fashion Collection 2024</option>
                        <option>Beauty Product Launch</option>
                        <option>Food Festival 2024</option>
                        <option>Gaming Tournament</option>
                    </select>
                </div>
                <div class="campaign-info">
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value" style="color: var(--success);">Active</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Start Date</span>
                        <span class="info-value">Jun 15, 2024</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">End Date</span>
                        <span class="info-value">Aug 30, 2024</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total KOLs</span>
                        <span class="info-value">8 KOLs</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Budget</span>
                        <span class="info-value">₫80M</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Target Reach</span>
                        <span class="info-value">15M views</span>
                    </div>
                </div>
            </div>

            <!-- Real-time Metrics -->
            <div class="realtime-grid">
                <div class="realtime-card">
                    <div class="realtime-header">
                        <span class="realtime-title">Total Views</span>
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>LIVE</span>
                        </div>
                    </div>
                    <div class="realtime-value">12,547,823</div>
                    <div class="realtime-change change-positive">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>+125.3K last hour</span>
                    </div>
                </div>

                <div class="realtime-card">
                    <div class="realtime-header">
                        <span class="realtime-title">Total Likes</span>
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>LIVE</span>
                        </div>
                    </div>
                    <div class="realtime-value">856,342</div>
                    <div class="realtime-change change-positive">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>+8.5K last hour</span>
                    </div>
                </div>

                <div class="realtime-card">
                    <div class="realtime-header">
                        <span class="realtime-title">Comments</span>
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>LIVE</span>
                        </div>
                    </div>
                    <div class="realtime-value">45,678</div>
                    <div class="realtime-change change-positive">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>+523 last hour</span>
                    </div>
                </div>

                <div class="realtime-card">
                    <div class="realtime-header">
                        <span class="realtime-title">Shares</span>
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>LIVE</span>
                        </div>
                    </div>
                    <div class="realtime-value">23,456</div>
                    <div class="realtime-change change-positive">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>+234 last hour</span>
                    </div>
                </div>

                <div class="realtime-card">
                    <div class="realtime-header">
                        <span class="realtime-title">Eng. Rate</span>
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>LIVE</span>
                        </div>
                    </div>
                    <div class="realtime-value">6.8%</div>
                    <div class="realtime-change change-positive">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>+0.2% today</span>
                    </div>
                </div>

                <div class="realtime-card">
                    <div class="realtime-header">
                        <span class="realtime-title">Conversions</span>
                        <div class="live-indicator">
                            <span class="live-dot"></span>
                            <span>LIVE</span>
                        </div>
                    </div>
                    <div class="realtime-value">2,847</div>
                    <div class="realtime-change change-positive">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>+42 today</span>
                    </div>
                </div>
            </div>

            <!-- Performance Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3 class="chart-title">Performance Trend (Last 7 Days)</h3>
                    <div class="chart-tabs">
                        <button class="chart-tab active">Views</button>
                        <button class="chart-tab">Engagement</button>
                        <button class="chart-tab">Conversions</button>
                    </div>
                </div>
                <div class="chart-area">
                    <span>Real-time chart will be rendered here</span>
                </div>
            </div>

            <!-- Content Tracking Table -->
            <div class="tracking-container">
                <div class="tracking-header">
                    <h3 class="tracking-title">Content Performance Tracking</h3>
                    <div class="tracking-controls">
                        <span style="font-size: 14px; color: var(--gray-600);">Auto-refresh in: <strong>45s</strong></span>
                        <button class="refresh-btn">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                    clip-rule="evenodd" />
                            </svg>
                            Refresh Now
                        </button>
                    </div>
                </div>

                <table class="tracking-table">
                    <thead>
                        <tr>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Likes</th>
                            <th>Comments</th>
                            <th>Engagement</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="content-info">
                                    <div class="content-thumbnail">🎬</div>
                                    <div class="content-details">
                                        <div class="content-title">Summer Collection Showcase</div>
                                        <div class="content-creator">@linhnguyen_beauty</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-live">Live</span>
                            </td>
                            <td>
                                <div class="metric-trend">
                                    <span>3.2M</span>
                                    <svg class="trend-icon" fill="var(--success)" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </td>
                            <td>
                                <div class="metric-trend">
                                    <span>256K</span>
                                    <svg class="trend-icon" fill="var(--success)" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </td>
                            <td>12.5K</td>
                            <td>
                                <span style="color: var(--success); font-weight: 600;">8.5%</span>
                            </td>
                            <td>2 mins ago</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content-info">
                                    <div class="content-thumbnail"
                                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">📸</div>
                                    <div class="content-details">
                                        <div class="content-title">Lifestyle Summer Tips</div>
                                        <div class="content-creator">@minhtran_lifestyle</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-live">Live</span>
                            </td>
                            <td>
                                <div class="metric-trend">
                                    <span>2.8M</span>
                                    <svg class="trend-icon" fill="var(--success)" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </td>
                            <td>
                                <div class="metric-trend">
                                    <span>174K</span>
                                    <svg class="trend-icon" fill="var(--success)" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </td>
                            <td>8.9K</td>
                            <td>
                                <span style="color: var(--primary); font-weight: 600;">6.2%</span>
                            </td>
                            <td>5 mins ago</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content-info">
                                    <div class="content-thumbnail"
                                        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">🍜</div>
                                    <div class="content-details">
                                        <div class="content-title">Fashion Food Collab</div>
                                        <div class="content-creator">@anpham_food</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-scheduled">Scheduled</span>
                            </td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>Posting at 7 PM</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content-info">
                                    <div class="content-thumbnail"
                                        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">🎮</div>
                                    <div class="content-details">
                                        <div class="content-title">Tech Fashion Review</div>
                                        <div class="content-creator">@hoangvu_tech</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-completed">Completed</span>
                            </td>
                            <td>1.5M</td>
                            <td>89K</td>
                            <td>4.2K</td>
                            <td>
                                <span style="color: var(--primary); font-weight: 600;">5.9%</span>
                            </td>
                            <td>2 hours ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Alerts Section -->
            <div class="alerts-container">
                <div class="alerts-header">
                    <h3 class="alerts-title">Campaign Alerts</h3>
                    <button class="btn btn-secondary btn-small">View All</button>
                </div>

                <div class="alert-item">
                    <div class="alert-icon alert-success">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Milestone Reached!</div>
                        <div class="alert-description">Campaign has reached 10M total views - 83% of target achieved</div>
                        <div class="alert-time">30 minutes ago</div>
                    </div>
                </div>

                <div class="alert-item">
                    <div class="alert-icon alert-warning">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Low Engagement Alert</div>
                        <div class="alert-description">@hoangvu_tech's content engagement is below target (5.9% vs 7%
                            target)</div>
                        <div class="alert-time">2 hours ago</div>
                    </div>
                </div>

                <div class="alert-item">
                    <div class="alert-icon alert-success">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                        </svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">High Performing Content</div>
                        <div class="alert-description">@linhnguyen_beauty's video is trending with 8.5% engagement rate
                        </div>
                        <div class="alert-time">3 hours ago</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Real-time counter animation
        let counters = {};

        function startRealtimeCounters() {
            // Simulate real-time updates
            setInterval(() => {
                // Update views
                const viewsElement = document.querySelector('.realtime-card:nth-child(1) .realtime-value');
                const currentViews = parseInt(viewsElement.textContent.replace(/,/g, ''));
                const newViews = currentViews + Math.floor(Math.random() * 100);
                viewsElement.textContent = newViews.toLocaleString();

                // Update likes
                const likesElement = document.querySelector('.realtime-card:nth-child(2) .realtime-value');
                const currentLikes = parseInt(likesElement.textContent.replace(/,/g, ''));
                const newLikes = currentLikes + Math.floor(Math.random() * 10);
                likesElement.textContent = newLikes.toLocaleString();

                // Update comments occasionally
                if (Math.random() > 0.7) {
                    const commentsElement = document.querySelector('.realtime-card:nth-child(3) .realtime-value');
                    const currentComments = parseInt(commentsElement.textContent.replace(/,/g, ''));
                    const newComments = currentComments + Math.floor(Math.random() * 5);
                    commentsElement.textContent = newComments.toLocaleString();
                }
            }, 2000);
        }

        // Auto-refresh countdown
        let refreshCountdown = 45;

        function startRefreshCountdown() {
            setInterval(() => {
                refreshCountdown--;
                if (refreshCountdown < 0) {
                    refreshCountdown = 45;
                    refreshData();
                }
                document.querySelector('.tracking-controls strong').textContent = refreshCountdown + 's';
            }, 1000);
        }

        function refreshData() {
            // Show refresh animation
            const refreshBtn = document.querySelector('.refresh-btn');
            refreshBtn.innerHTML =
                '<svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" style="animation: spin 1s linear infinite;"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> Refreshing...';

            setTimeout(() => {
                refreshBtn.innerHTML =
                    '<svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> Refresh Now';
            }, 1000);
        }

        // Chart tabs
        document.querySelectorAll('.chart-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            startRealtimeCounters();
            startRefreshCountdown();

            // Add spinning animation style
            const style = document.createElement('style');
            style.textContent =
                '@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
            document.head.appendChild(style);
        });

        // Manual refresh button
        document.querySelector('.refresh-btn').addEventListener('click', function() {
            refreshCountdown = 45;
            refreshData();
        });
    </script>
@endsection
