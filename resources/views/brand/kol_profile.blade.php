@extends('layouts.brand_master')

@section('meta')
    <meta name="description" content="Hồ sơ KOL - Bảng điều khiển phân tích OneUp">
    <title>{{ $kol->display_name }} - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
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

        /* Main Content */
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

        .verified-icon {
            width: 24px;
            height: 24px;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .profile-header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            gap: 1rem;
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
            color: #16a34a;
            /* xanh lá */
        }

        .score-value.yellow {
            color: #eab308;
            /* vàng */
        }

        .score-value.red {
            color: #dc2626;
            /* đỏ */
        }

        .profile-top-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;

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
        /* Container giới hạn & căn giữa toàn bộ khối thống kê */
        .profile-stats {
            margin-right: 150px !important;
            display: flex;
            flex-wrap: nowrap;              
            justify-content: space-evenly; 
            align-items: center;
            gap: 1rem;
            margin: 2rem auto 0;           
            max-width: 1100px;              
            padding: 0 1rem;
            box-sizing: border-box;
        }

        /* Mỗi ô có kích thước cố định/đều nhau */
        .stat-item {
            flex: 0 0 22%;                  /* chiếm ~22% mỗi ô -> 4 ô + gap vừa khít */
            min-width: 180px;               /* ngăn quá nhỏ */
            max-width: 260px;               /* giới hạn lớn nhất (trên màn to) */
            background-color: #2f6cfb;      /* màu blue giống mẫu */
            color: #fff;
            border-radius: 12px;
            padding: 18px 14px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(47,108,251,0.18);
        }

        /* Giá trị + nhãn */
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255,255,255,0.9);
            margin-top: 0;
        }

        /* Thanh progress ô cuối (nếu cần) */
        .stat-item:last-child .trust-bar {
            margin-top: 8px;
            height: 6px;
            background: rgba(255,255,255,0.25);
            border-radius: 6px;
            overflow: hidden;
        }
        .stat-item:last-child .trust-bar > i {
            display: block;
            height: 100%;
            width: 60%; /* đổi bằng inline style hoặc class theo điểm thực tế */
            background: linear-gradient(90deg, #2ff2a3, #00c2ff);
        }

        /* Responsive: trên mobile cho 2 ô 1 hàng */
        @media (max-width: 900px) {
            .profile-stats {
                margin-right: 0px !important;  
                flex-wrap: wrap;
                justify-content: center;     /* căn giữa khi xuống dòng */
                gap: 0.75rem;
                max-width: 1000px;
            }
            .stat-item {
                flex: 0 0 calc(50% - 0.75rem);
                min-width: 140px;
            }
        }

        /* Responsive nhỏ hơn nữa: 1 ô 1 hàng */
        @media (max-width: 420px) {
            .stat-item {
                flex: 0 0 100%;
                max-width: 100%;
            }
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
        /* Khi tab khác overview -> ẩn cột phải và cho cột trái full width */
        .content-grid.full-width {
            grid-template-columns: 1fr !important;
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
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .tab-content {
            overflow: auto;
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

        .trust-factor {
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

            .trust-factor {
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

            .trust-factor {
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
            font-size: 17px;
            /* tăng cỡ chữ */
            line-height: 1.4;
            font-weight: 600;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* chỉ hiển thị 2 dòng */
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

        .tab-content.hidden {
            display: none;
        }

        .tab.active {
            border-bottom: 2px solid var(--primary);
            color: var(--primary);
        }

        .service-table {
            width: 100%;
            border-collapse: collapse;
        }

        .service-table th,
        .service-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .service-table th {
            background: #f9f9f9;
            text-align: left;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .btn-select-service {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }

        .btn-select-service:hover {
            background-color: #1e40af;
        }

        .hidden {
            display: none !important;
        }

        /* Responsive: nút sẽ xuống hàng dưới */
        @media (max-width: 768px) {
            .btn-select-service {
                width: 100%;
                text-align: center;
                margin-top: 6px;
            }
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal-overlay.hidden {
            display: none;
        }

        .modal-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #222;
        }

        .modal-box textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: none;
            font-size: 14px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
            gap: 10px;
        }

        .btn-cancel {
            background: #e5e7eb;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-submit {
            background: #2563eb;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #1e40af;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .profile-top-row {
                justify-content: center;
            }

            .topbar {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .profile-content {
                padding-left: 1rem;
                padding-right: 1rem;
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
                <h1 class="page-title">Nhà sáng tạo nội dung</h1>
            </div>

            <div class="topbar-right">

                <div class="menu-toggle" onclick="$('.sidebar').toggleClass('active');">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

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
                        @if ($kol->blue_tick == 1)
                            <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                            </svg>
                        @else
                            <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20" style="display:none">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                            </svg>
                        @endif
                        <div class="profile-badges">
                            @if ($kol->is_verified)
                                <span class="badge badge-verified">Đã xác minh</span>
                            @endif
                            {{-- <span class="badge badge-tier">Hạng Diamond</span> --}}
                        </div>
                    </div>

                    <div class="profile-handle">
                        <a href="https://www.tiktok.com/{{ '@' . trim($kol->username, '@') }}" target="blank">
                            {{ '@' . trim($kol->username, '@') }}
                        </a>

                    </div>

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
                            <div class="stat-value">{{ $totalPosts }}</div>
                            <div class="stat-label">Bài đăng</div>
                            {{-- <div class="stat-change">
                                <span style="color: var(--gray-600);">3.2 bài viết/tuần</span>
                            </div> --}}
                        </div>

                         <div class="stat-item">
                            <div class="stat-value">{{ formatDisplayNumber($totalLikes) }}</div>
                            <div class="stat-label">Tổng lượt like</div>
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
                <a href="#overview" class="tab active" onclick="showTab('overview')">Tổng quan</a>
                <a href="#content" class="tab" onclick="showTab('content')">Nội dung</a>
                <a href="#pricing" class="tab" onclick="showTab('pricing')">Bảng giá dịch vụ</a>
                <a href="#history" class="tab" onclick="showTab('history')">Lịch sử chiến dịch</a>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <div class="content-grid">
                <!-- Left Column -->
                <div id="overview" class="tab-content active">
                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header">
                            <h2 class="metric-title">Dữ liệu TikTok theo ngày</h2>
                            <span class="metric-period">Theo dõi hiệu suất</span>
                        </div>
                        <div id="tiktok-chart" style="width: 100%; height: 400px;"></div>
                    </div>

                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header"
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h2 class="metric-title" style="font-weight: bold; font-size: 20px;">Nội dung gần đây</h2>
                            <a href="#" style="color: var(--primary); font-size: 14px; text-decoration: none;">Xem
                                tất cả →</a>
                        </div>

                        <div class="tiktok-video-grid">
                            @foreach ($video as $v)
                                <div class="tiktok-video-item">
                                    <div class="video-wrapper">
                                        <a href="https://www.tiktok.com/@ {{ $kol->username }}/video/{{ $v->platform_post_id }}"
                                            target="_blank" rel="noopener">
                                            <img src="{{ $v->thumbnail_url }}" alt="video thumbnail"
                                                class="video-thumb">
                                            @if ($v->is_pinned ?? false)
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

                    <!-- Engagement Metrics -->
                    {{-- <div class="metric-card">
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
                    </div> --}}
        
                </div>

                     <!-- Bảng giá dịch vụ -->
                <div id="pricing" class="tab-content hidden">
                    <div class="metric-card">
                        <div class="metric-header">
                            <h2 class="metric-title">Bảng giá dịch vụ</h2>
                            <p class="metric-subtitle" style="color: #666; font-size: 14px;">
                                Các dịch vụ mà bạn đang cung cấp
                            </p>
                        </div>

                        <div class="table-wrapper">
                            <table class="service-table">
                                <thead>
                                    <tr>
                                        <th style="color:black">Hình ảnh</th>
                                        <th style="color:black">Mô tả</th>
                                        <th style="color:black">Giá (VNĐ)</th>
                                        <th style="color:black">Ngày tạo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $service)
                                        <tr>
                                            <td style="width: 100px;">
                                                @if ($service->image)
                                                    <img src="{{ $service->image }}" alt="Ảnh dịch vụ"
                                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <span style="color: #888;">(Không có ảnh)</span>
                                                @endif
                                            </td>
                                            <td style="color:black">{{ $service->description }}</td>
                                            <td style="color:black">{{ number_format($service->price) }}₫</td>
                                            <td style="color:black">{{ $service->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if (in_array($service->id, $bookedServiceIds))
                                                    <button class="btn-selected" disabled
                                                        style="width: 70px; height: 40px; border-radius: 5px">Đã
                                                        chọn</button>
                                                @else
                                                    <button class="btn-select-service" data-id="{{ $service->id }}">
                                                        Chọn dịch vụ
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center; padding: 20px; color: black;">
                                                Chưa có dịch vụ nào được thêm
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal đặt dịch vụ -->
                <div id="serviceModal" class="modal-overlay hidden">
                    <div class="modal-box">
                        <h3 class="modal-title">Bạn có muốn thêm yêu cầu gì không?</h3>
                        <form id="serviceForm">
                            <textarea name="note" placeholder="Nhập yêu cầu thêm (nếu có)..." rows="4"></textarea>
                            <input type="hidden" name="service_id" id="modalServiceId">
                            <div class="modal-actions">
                                <button type="button" class="btn-cancel" id="closeModal">Hủy</button>
                                <button type="submit" class="btn-submit">Gửi yêu cầu</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="content" class="tab-content hidden">
                    <div class="metric-card" style="margin-top: 2rem;">
                        <div class="metric-header"
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h2 class="metric-title" style="font-weight: bold; font-size: 20px;">Nội dung gần đây</h2>
                            <a href="#" style="color: var(--primary); font-size: 14px; text-decoration: none;">Xem
                                tất cả →</a>
                        </div>

                        <div class="tiktok-video-grid">
                            @foreach ($videos as $v)
                                <div class="tiktok-video-item">
                                    <div class="video-wrapper">
                                        <a href="https://www.tiktok.com/@ {{ $kol->username }}/video/{{ $v->platform_post_id }}"
                                            target="_blank" rel="noopener">
                                            <img src="{{ $v->thumbnail_url }}" alt="video thumbnail"
                                                class="video-thumb">
                                            @if ($v->is_pinned ?? false)
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

                <div id="history" class="tab-content hidden">
                    <div class="metric-card">
                        <div class="metric-header">
                            <h2 class="metric-title">Lịch sử chiến dịch</h2>
                            <p class="metric-subtitle" style="color: #666; font-size: 14px;">
                                Các chiến dịch mà bạn đã tham gia
                            </p>
                        </div>

                        <div class="table-wrapper">
                            <table class="service-table">
                                <thead>
                                    <tr>
                                        <th style="color:black">Tên chiến dịch</th>
                                        <th style="color:black">Trạng thái</th>
                                        <th style="color:black">Số tiền hợp đồng</th>
                                        <th style="color:black">Thưởng hiệu suất</th>
                                        <th style="color:black">Ngày tham gia</th>
                                        <th style="color:black">Ngày hoàn thành</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($campaigns as $item)
                                        <tr>
                                            <td style="color:black">{{ $item->campaign_name }}</td>
                                            <td>
                                                @switch($item->status)
                                                    @case('pending')
                                                        <span class="badge badge-warning">Chờ duyệt</span>
                                                    @break

                                                    @case('approved')
                                                        <span class="badge badge-success">Đã chấp nhận</span>
                                                    @break

                                                    @case('rejected')
                                                        <span class="badge badge-danger">Từ chối</span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-secondary"
                                                            style="color: black">{{ ucfirst($item->status) }}</span>
                                                @endswitch
                                            </td>
                                            <td style="color:black">
                                                {{ number_format($item->contracted_amount, 0, ',', '.') }} ₫</td>
                                            <td style="color:black">
                                                {{ number_format($item->performance_bonus, 0, ',', '.') }} ₫</td>
                                            <td style="color:black">
                                                {{ $item->added_at ? \Carbon\Carbon::parse($item->added_at)->format('d/m/Y') : '-' }}
                                            </td>
                                            <td style="color:black">
                                                {{ $item->completed_at ? \Carbon\Carbon::parse($item->completed_at)->format('d/m/Y') : '-' }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" style="text-align:center; color:black;">Chưa có chiến dịch
                                                    nào</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div id="right-column">
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
                                            stroke-dasharray="377" stroke-dashoffset="{{ 377 - (377 * $trustScore) / 100 }}">
                                        </circle>
                                    </svg>
                                    <div class="trust-score-text">{{ $trustScore }}</div>
                                </div>

                                <div class="trust-factors space-y-1">
                                    <div class="trust-factor flex justify-between">
                                        <span>Người theo dõi thật</span>
                                        <span
                                            class="score-value @if ($realFollowersScore >= 80) green 
                                                @elseif($realFollowersScore >= 50) yellow  
                                                @else red @endif">
                                            {{ $realFollowersScore }}%
                                        </span>
                                    </div>
                                    <div class="trust-factor flex justify-between">
                                        <span>Chất lượng tương tác</span>
                                        <span
                                            class="score-value @if ($engagementQuality >= 80) green 
                                                @elseif($engagementQuality >= 50) yellow 
                                                @else red @endif">
                                            {{ $engagementQuality }}%
                                        </span>
                                    </div>
                                    <div class="trust-factor flex justify-between">
                                        <span>Tính xác thực bình luận</span>
                                        <span
                                            class="score-value @if ($authenticComments >= 80) green 
                                                @elseif($authenticComments >= 50) yellow 
                                                @else red @endif">
                                            {{ $authenticComments }}%
                                        </span>
                                    </div>
                                    <div class="trust-factor flex justify-between">
                                        <span>Độ ổn định tăng trưởng</span>
                                        <span
                                            class="score-value @if ($growthStability >= 80) green 
                                                @elseif($growthStability >= 50) yellow 
                                                @else red @endif">
                                            {{ $growthStability }}%
                                        </span>
                                    </div>
                                    <div class="trust-factor flex justify-between">
                                        <span>Chất lượng nội dung</span>
                                        <span
                                            class="score-value @if ($contentQuality >= 80) green 
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
        </div>
    </main>
    @endsection

    @section('js')
    <script src="{{ asset('plugins/visualization/echarts/echarts.min.js') }}"></script>
    <script>
    // Initialize TikTok Chart
             function initTiktokChart() {
                 const chartData = @json($chartData ?? []);
                 
                 if (!chartData || chartData.length === 0) {
                     console.log('No chart data available');
                     return;
                 }

                 const dates = chartData.map(item => item.date);
                 const followers = chartData.map(item => item.followers);
                 const likes = chartData.map(item => item.likes_count);
                 const comments = chartData.map(item => item.comments_count);
                 const shares = chartData.map(item => item.shares_count);

                 const chartDom = document.getElementById('tiktok-chart');
                 if (!chartDom) return;

                 const myChart = echarts.init(chartDom);
                 
                 const option = {
                     title: {
                         text: ''
                     },
                     tooltip: {
                         trigger: 'axis',
                         backgroundColor: 'rgba(0, 0, 0, 0.8)',
                         borderColor: '#333',
                         textStyle: {
                             color: '#fff'
                         }
                     },
                     legend: {
                         data: ['Followers', 'Likes', 'Comments', 'Shares'],
                         bottom: 10,
                         textStyle: {
                             color: '#666'
                         }
                     },
                     grid: {
                         left: '3%',
                         right: '4%',
                         bottom: '15%',
                         top: '10%',
                         containLabel: true
                     },
                     xAxis: {
                         type: 'category',
                         data: dates,
                         axisLabel: {
                             color: '#999'
                         },
                         axisLine: {
                             lineStyle: {
                                 color: '#ddd'
                             }
                         }
                     },
                     yAxis: [
                         {
                             type: 'value',
                             name: 'Followers',
                             position: 'left',
                             axisLabel: {
                                 color: '#999'
                             },
                             splitLine: {
                                 lineStyle: {
                                     color: '#f0f0f0'
                                 }
                             }
                         },
                         {
                             type: 'value',
                             name: 'Count',
                             position: 'right',
                             axisLabel: {
                                 color: '#999'
                             },
                             splitLine: {
                                 show: false
                             }
                         }
                     ],
                     series: [
                         {
                             name: 'Followers',
                             data: followers,
                             type: 'line',
                             smooth: true,
                             yAxisIndex: 0,
                             lineStyle: {
                                 width: 2,
                                 color: '#667eea'
                             },
                             itemStyle: {
                                 color: '#667eea'
                             },
                             areaStyle: {
                                 color: 'rgba(102, 126, 234, 0.1)'
                             }
                         },
                         {
                             name: 'Likes',
                             data: likes,
                             type: 'line',
                             smooth: true,
                             yAxisIndex: 1,
                             lineStyle: {
                                 width: 2,
                                 color: '#f093d0'
                             },
                             itemStyle: {
                                 color: '#f093d0'
                             }
                         },
                         {
                             name: 'Comments',
                             data: comments,
                             type: 'line',
                             smooth: true,
                             yAxisIndex: 1,
                             lineStyle: {
                                 width: 2,
                                 color: '#ffa500'
                             },
                             itemStyle: {
                                 color: '#ffa500'
                             }
                         },
                         {
                             name: 'Shares',
                             data: shares,
                             type: 'line',
                             smooth: true,
                             yAxisIndex: 1,
                             lineStyle: {
                                 width: 2,
                                 color: '#52c41a'
                             },
                             itemStyle: {
                                 color: '#52c41a'
                             }
                         }
                     ]
                 };

                 myChart.setOption(option);
                 
                 // Handle window resize
                 window.addEventListener('resize', function() {
                     myChart.resize();
                 });
             }

             // Tab switching
             document.addEventListener('DOMContentLoaded', function() {
                 initTiktokChart();
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

            function showTab(tabId) {
                document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
                document.querySelector(`a[href="#${tabId}"]`).classList.add('active');
                document.getElementById(tabId).classList.remove('hidden');
            }

            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('serviceModal');
                const closeModal = document.getElementById('closeModal');
                const form = document.getElementById('serviceForm');

                document.querySelectorAll('.btn-select-service').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        document.getElementById('modalServiceId').value = id;
                        modal.classList.remove('hidden');
                    });
                });

                closeModal.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    fetch('{{ route('creator.book.service') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            alert(data.message);
                            window.location.reload();
                        })
                        .catch(() => alert('Có lỗi xảy ra, vui lòng thử lại.'));
                });
            });

            function showTab(tabName) {
            // 1️⃣ Ẩn tất cả các tab-content
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(c => c.classList.add('hidden'));

            // 2️⃣ Hiện tab được chọn
            const activeTab = document.getElementById(tabName);
            if (activeTab) activeTab.classList.remove('hidden');

            // 3️⃣ Cập nhật class 'active' cho tab menu
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(t => t.classList.remove('active'));
            const clickedTab = document.querySelector(`[onclick="showTab('${tabName}')"]`);
            if (clickedTab) clickedTab.classList.add('active');

            // 4️⃣ Hiện hoặc ẩn cột phải
            const rightColumn = document.getElementById('right-column');
            const contentGrid = document.querySelector('.content-grid'); // 👈 thêm dòng này

            if (rightColumn) {
                if (tabName === 'overview') {
                    rightColumn.classList.remove('hidden');

                    // 👇 thêm dòng này để trở lại layout 2 cột
                    contentGrid?.classList.remove('full-width');
                } else {
                    rightColumn.classList.add('hidden');

                    // 👇 thêm dòng này để chuyển sang layout 1 cột full width
                    contentGrid?.classList.add('full-width');
                }
            }
        }

        </script>
    @endsection
