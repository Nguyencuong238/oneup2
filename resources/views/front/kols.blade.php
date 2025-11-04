@extends('layouts.front')

@section('meta')
    <title>Danh mục Nhà sáng tạo nội dung - Phân tích Nhà sáng tạo nội dung OneUp</title>
    <meta name="description" content="Browse and discover 10,000+ verified TikTok KOLs in Vietnam">
@endsection

@section('css')
    <style>
        a {
            text-decoration: none;
        }

        /* KOL List Page Specific Styles */
        .filters-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }

        .filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--gray-200);
        }

        .filters-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filters-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
            cursor: pointer;
            transition: color 0.2s;
        }

        .filters-toggle:hover {
            color: var(--primary);
        }

        .filters-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            transition: all 0.3s ease;
        }

        .filters-content.collapsed {
            display: none;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .filter-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }

        .filter-select {
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            background: white;
            color: var(--dark-blue);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-select:hover {
            border-color: var(--primary);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-chip {
            padding: 6px 14px;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-chip:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-chip.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .filter-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .active-filters {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--primary-lighter);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .active-filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 4px 12px;
            background: white;
            border-radius: 20px;
            font-size: 13px;
            color: var(--dark-blue);
        }

        .active-filter-tag button {
            background: none;
            border: none;
            color: var(--gray-500);
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .active-filter-tag button:hover {
            color: var(--danger);
        }

        .kol-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .kol-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid var(--gray-200);
            position: relative;
        }

        .kol-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-light);
        }

        .kol-card-header {
            position: relative;
            height: 200px;
            background: linear-gradient(135deg, var(--primary-lighter) 0%, var(--secondary) 100%);
            /* overflow: hidden; */
        }

        .kol-cover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }

        .kol-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .kol-badge.verified {
            background: var(--success);
            color: white;
        }

        .kol-badge.rising {
            background: var(--warning);
            color: white;
        }

        .kol-avatar-wrapper {
            position: absolute;
            bottom: -40px;
            left: 20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .kol-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 700;
        }

        .kol-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .kol-card-body {
            padding: 1.5rem;
            padding-top: 3rem;
        }

        .kol-info {
            margin-bottom: 1rem;
        }

        .kol-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .verified-icon {
            width: 16px;
            height: 16px;
            color: var(--primary);
        }

        .kol-handle {
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .kol-category {
            display: inline-block;
            padding: 4px 10px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .kol-bio {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.5;
            margin: 1rem 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .kol-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            padding: 1rem 0;
            border-top: 1px solid var(--gray-200);
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 1rem;
        }

        .kol-stat {
            text-align: center;
        }

        .kol-stat-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-blue);
            display: block;
        }

        .kol-stat-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        .kol-metrics {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .metric-tag {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            background: var(--gray-100);
            border-radius: 6px;
            font-size: 12px;
            color: var(--gray-700);
        }

        .metric-tag.good {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .metric-tag.warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .kol-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .search-bar {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }

        .search-input-group {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .results-count {
            font-size: 14px;
            color: var(--gray-600);
        }

        .results-count strong {
            color: var(--gray-100);
            font-weight: 600;
        }

        .results-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .view-toggle {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .view-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .view-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .sort-dropdown {
            padding: 8px 16px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .sort-dropdown:focus {
            outline: none;
            border-color: var(--primary);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
        }

        .page-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
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

        .trending-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--danger);
        }

        @media (max-width: 1200px) {
            .kol-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .filters-content {
                grid-template-columns: 1fr;
            }

            .kol-grid {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero"
        style="padding: 120px 0 60px; background: linear-gradient(135deg, var(--primary-lighter) 0%, white 100%);">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 fade-in color-dark-blue">
                    Khám phá <span class="gradient-text">10,000+ Nhà sáng tạo nội dung TikTok</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Duyệt qua các influencer đã được xác minh với phân tích chi tiết và theo dõi theo thời gian thực
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section" style="padding-top: 0; margin-top: -40px;">
        <div class="container">
            <!-- Search Bar -->
            <div class="search-bar fade-in">
                <form method="GET" action="{{ route('kols') }}" class="search-input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                        placeholder="Tìm theo tên, tài khoản hoặc từ khóa...">
                    <button class="btn btn-primary" type="submit">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                        Tìm kiếm
                    </button>
                </form>
            </div>
            <form method="GET" action="{{ route('kols') }}" class="search-bar fade-in mb-6">
                <div class="filters-section mt-6">
                    <div class="filters-content" id="filtersContent">
                        <div class="filter-group">
                            <label class="filter-label">Danh mục</label>
                            <select name="category" class="filter-select">
                                <option value="all">Tất cả danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Followers --}}
                        <div class="filter-group">
                            <label class="filter-label">Hạng nhà sáng tạo</label>
                            <select name="rank" class="filter-select">
                                <option value="all">Tất cả</option>
                                <option value="food_lover" {{ request('rank') == 'food_lover' ? 'selected' : '' }}>
                                    Food Lover (&lt;5K)
                                    </option>
                                <option value="tase_maker" {{ request('rank') == 'tase_maker' ? 'selected' : '' }}>Taste Maker
                                    (5K–20K)</option>
                                <option value="rising" {{ request('rank') == 'rising' ? 'selected' : '' }}>Rising (20K–100K)
                                </option>
                                <option value="star" {{ request('rank') == 'star' ? 'selected' : '' }}>Star (100K–500K)</option>
                                <option value="legend" {{ request('rank') == 'legend' ? 'selected' : '' }}>Legend (500K+)
                                </option>
                            </select>
                        </div>

                        {{-- Engagement rate --}}
                        <div class="filter-group">
                            <label class="filter-label">Tỷ lệ tương tác</label>
                            <select name="engagement" class="filter-select">
                                <option value="any">Bất kỳ</option>
                                <option value="1" {{ request('engagement') == '1' ? 'selected' : '' }}>Trên 1%</option>
                                <option value="3" {{ request('engagement') == '3' ? 'selected' : '' }}>Trên 3%</option>
                                <option value="5" {{ request('engagement') == '5' ? 'selected' : '' }}>Trên 5%</option>
                                <option value="8" {{ request('engagement') == '8' ? 'selected' : '' }}>Trên 8%</option>
                                <option value="10" {{ request('engagement') == '10' ? 'selected' : '' }}>Trên 10%</option>
                            </select>
                        </div>

                        {{-- Thành phố --}}
                        <div class="filter-group">
                            <label class="filter-label">Khu vực</label>
                            <select name="location_city" class="filter-select">
                                <option value="all">Tất cả khu vực</option>
                                <option value="Hà Nội" {{ request('location_city') == 'Hà Nội' ? 'selected' : '' }}>Hà Nội
                                </option>
                                <option value="TP.HCM" {{ request('location_city') == 'TP.HCM' ? 'selected' : '' }}>TP.HCM
                                </option>
                                <option value="Đà Nẵng" {{ request('location_city') == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng
                                </option>
                                <option value="Khác" {{ request('location_city') == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>

                        {{-- Ngôn ngữ --}}
                        <div class="filter-group">
                            <label class="filter-label">Ngôn ngữ</label>
                            <select name="language" class="filter-select">
                                <option value="all">Tất cả ngôn ngữ</option>
                                <option value="vi" {{ request('language') == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                                <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>Tiếng Anh</option>
                            </select>
                        </div>

                        {{-- Verified --}}
                        {{-- <div class="filter-group">
                            <label class="filter-label">Trạng thái xác minh</label>
                            <select name="is_verified" class="filter-select">
                                <option value="all">Tất cả</option>
                                <option value="verified" {{ request('is_verified') == 'verified' ? 'selected' : '' }}>Đã xác minh
                                </option>
                                <option value="rising" {{ request('is_verified') == 'rising' ? 'selected' : '' }}>Ngôi sao đang
                                    lên</option>
                            </select>
                        </div> --}}

                    </div>

                    <div class="flex items-center gap-3 mt-4">
                        <button class="btn btn-primary">Áp dụng bộ lọc</button>
                        <a href="{{ route('kols') }}" class="btn btn-outline" style="height:41px">Xóa tất cả</a>
                    </div>
                </div>
            </form>

            <!-- Results Header -->
            <div class="results-header fade-in">
                <div class="results-count fade-in">
                    Hiển thị
                    <strong>{{ $kols->firstItem() ?? 0 }}–{{ $kols->lastItem() ?? 0 }}</strong>
                    trong tổng số
                    <strong>{{ $kols->total() }}</strong> Nhà sáng tạo nội dung
                </div>
                <div class="results-controls">
                    <select class="sort-dropdown" onchange="window.location.href=this.value">
                        <option value="{{ route('kols') }}">Phù hợp nhất</option>
                        <option value="{{ route('kols', ['favorite' => 1]) }}"
                            {{ request('favorite') == 1 ? 'selected' : '' }}>
                            Yêu thích
                        </option>
                    </select>
                </div>
            </div>

            <!-- KOL Cards Grid -->
            <div class="kol-grid">
                @foreach ($kols as $k)
                    <div class="kol-card fade-in">
                        <div class="kol-card-header">
                            <span class="kol-badge {{ $k->is_verified ? 'verified' : 'not-verified' }}">
                                {{ $k->is_verified ? 'Đã xác minh' : 'Chưa xác minh' }}
                            </span>
                            <div class="trending-tag">🔥 Thịnh hành</div>
                            <div class="kol-avatar-wrapper">
                                <div class="kol-avatar">
                                    <img src="{{ $k->getFirstMediaUrl('media') }}" alt="KOL Cover"
                                        class="kol-cover-image">
                                </div>
                            </div>
                        </div>
                        <div class="kol-card-body">
                            <div class="kol-info">
                                <div class="kol-name">
                                    <a href="{{ route('brand.profile', $k->username) }}"
                                        style="text-decoration:none; color: black">
                                        {{ $k->display_name }}
                                    </a>
                                    @if ($k->blue_tick == 1)
                                        <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                        </svg>
                                    @else
                                        <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20"
                                            style="display:none">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="kol-handle">{{ $k->username }}</div>
                                <span class="kol-category">Danh mục:
                                    @if ($k->categories->isEmpty())
                                        --
                                    @else
                                        @foreach ($k->categories as $category)
                                            {{ $category->name }}
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <p class="kol-bio">
                                {{ $k->bio }}
                            </p>
                            <div class="kol-stats">
                                <div class="kol-stat">
                                    <span class="kol-stat-value">{{ formatDisplayNumber($k->followers) }}</span>
                                    <span class="kol-stat-label">Người theo dõi</span>
                                </div>
                                <div class="kol-stat">
                                    <span class="kol-stat-value">{{ formatDisplayNumber($k->engagement) }}%</span>
                                    <span class="kol-stat-label">Tương tác</span>
                                </div>
                                <div class="kol-stat">
                                    <span class="kol-stat-value">{{ formatDisplayNumber($k->total_likes) }}</span>
                                    <span class="kol-stat-label">Tổng số lượt thích</span>
                                </div>
                            </div>
                            {{-- <div class="kol-metrics">
                            <span class="metric-tag good">✨ Chất lượng cao</span>
                            <span class="metric-tag">📍 {{ $k->location_country }}</span>
                            <span class="metric-tag">💰 Trung bình</span>
                        </div> --}}
                            <div class="kol-actions">
                                @auth
                                    <a href="{{ route('brand.profile', $k->username) }}" class="btn btn-primary"
                                        style="flex: 1;">
                                        Xem hồ sơ
                                    </a>
                                @else
                                    <a href="{{ route('login', ['redirect' => route('brand.profile', $k->username)]) }}"
                                        class="btn btn-primary" style="flex: 1;">
                                        Đăng nhập để xem
                                    </a>
                                @endauth
                                <button class="btn btn-outline btn-icon btn-favorite" data-kol-id="{{ $k->id }}">
                                    <svg width="20" height="20"
                                        fill="{{ $k->isFavoritedBy(auth()->id()) ? 'blue' : 'none' }}"
                                        viewBox="0 0 20 20" stroke="currentColor">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            {{ $kols->links('vendor.pagination.custom') }}

        </div>
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-favorite').forEach(button => {
                button.addEventListener('click', function() {
                    const kolId = this.dataset.kolId;

                    fetch("{{ route('kol.favorite') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                kol_id: kolId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Response:',
                            data); // 👉 kiểm tra phản hồi trong console
                            if (data.success) {
                                const svg = this.querySelector('svg');
                                if (data.favorited) {
                                    svg.setAttribute('fill', 'blue');
                                } else {
                                    svg.setAttribute('fill', 'none');
                                }
                            } else {
                                alert(data.message || 'Có lỗi xảy ra');
                            }
                        })
                        .catch(err => {
                            console.error('Fetch error:', err);
                        });
                });
            });
        });
        // Toggle Filters
        function toggleFilters() {
            const filtersContent = document.getElementById('filtersContent');
            const toggleText = document.getElementById('filterToggleText');

            if (filtersContent.classList.contains('collapsed')) {
                filtersContent.classList.remove('collapsed');
                toggleText.textContent = 'Hide Filters';
            } else {
                filtersContent.classList.add('collapsed');
                toggleText.textContent = 'Show Filters';
            }
        }


        // Filter chips functionality
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                // Clear other chips in the same group
                const siblings = this.parentElement.querySelectorAll('.filter-chip');
                siblings.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Remove filter tag
        function removeFilter(button) {
            button.parentElement.remove();
        }

        // View toggle
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Pagination
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.disabled) {
                    document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Apply filters
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                // Show active filters section when filters are applied
                if (this.value !== this.options[0].value) {
                    document.querySelector('.active-filters').style.display = 'flex';
                }
            });
        });
    </script>
@endsection
