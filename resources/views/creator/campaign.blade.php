@extends('layouts.creator_master')

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
            background: rgba(0, 102, 255, 0.1);
            color: var(--primary);
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

                {{-- <a href="{{ route('creator.campaign.planner') }}" class="btn btn-primary btn-small">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Chiến dịch mới
                </a> --}}
            </div>
        </div>

        <!-- Campaigns Content -->
        <div class="campaigns-content">


            <!-- Campaign Tabs -->
            <div class="campaign-tabs-container">
                <div class="campaign-tabs">
                    <div class="campaign-tab active" data-tab="all">
                        Tất cả chiến dịch
                    </div>
                    <div class="campaign-tab" data-tab="confirmed">
                        Đã tham gia
                        <span class="tab-badge">{{ count($comfirmedCampaignIds) }}</span>
                    </div>
                    <div class="campaign-tab" data-tab="invited">
                        Được mời tham gia
                        <span class="tab-badge">{{ count($invitedCampaignIds) }}</span>
                    </div>
                </div>

                @php
                    $statusText = [
                        'active' => 'Đang hoạt động',
                        'paused' => 'Tạm dừng',
                        'completed' => 'Đã kết thúc',
                        'cancelled' => 'Đã hủy',
                        'draft' => 'Bản nháp',
                        'pending' => 'Chờ duyệt',
                    ];
                @endphp

                <!-- Campaigns Grid -->
                <div class="campaigns-grid" id="campaignsGrid">
                    @foreach ($campaigns as $campaign)
                        <div class="campaign-card campaign-{{ @$myStatusCampaigns[$campaign->id] }}">
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
                                    {{-- <div class="metric">
                                        <span class="metric-label">Phạm vi tiếp cận</span>
                                        <span class="metric-value">{{ formatDisplayNumber($campaign->target_reach) }}</span>
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
                                    </div> --}}
                                    {{-- <div class="metric">
                                        <span class="metric-label">ROI</span>
                                        <span class="metric-value">{{ numberFormat($campaign->roi, 1) }}x</span>
                                    </div> --}}
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
                                    <span class="kol-count">{{ $campaign->kols->count() }} Nhà sáng tạo nội dung tham gia</span>
                                </div>
                            </div>
                            <div class="campaign-footer">
                                {{-- <div class="campaign-budget">
                                    Ngân sách:
                                    <span class="budget-amount">
                                        ₫{{ numberFormat($campaign->budget_amount / 1000000, 3) }}M
                                    </span>
                                </div> --}}
                                <div class="campaign-actions">
                                    @if ($campaign->status == 'active' && @$myStatusCampaigns[$campaign->id] != 'confirmed')
                                        {{-- <button class="action-btn js-navigate"
                                            data-href="{{ route('creator.campaign.detail', ['slug' => $campaign->slug]) }}">
                                            Xem
                                        </button>
                                        <button class="action-btn primary js-navigate"
                                            data-href="{{ route('creator.campaign.tracker', ['slug' => $campaign->slug]) }}">
                                            Theo dõi
                                        </button> --}}

                                        <form action="{{ route('creator.campaign.join') }}" method="post"
                                            class="change-status-form">
                                            @csrf
                                            @method('post')

                                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                                            <button
                                                class="action-btn primary">{{ @$myStatusCampaigns[$campaign->id] == 'invited' ? 'Đồng ý tham gia' : 'Tham gia' }}</button>
                                        </form>
                                    @endif

                                    @if (@$myStatusCampaigns[$campaign->id] == 'confirmed')
                                        <button class="action-btn">
                                            Đã tham gia
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

            @if (request()->input('tab') && in_array(request()->input('tab'), ['all', 'confirmed', 'invited']))
                switchTab($('.campaign-tab[data-tab="{{ request()->input('tab') }}"]'),
                    '{{ request()->input('tab') }}');
            @endif
        });
    </script>

    <script>
        $('.change-status-form').on('submit', function(e) {
            e.preventDefault();
            var msg = 'Bạn có chắc chắn muốn tham gia chiến dịch';

            if (confirm(msg)) {
                this.submit();
            }

        });
    </script>
@endsection
