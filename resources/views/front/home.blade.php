@extends('layouts.front')

@section('css')
    <style>
        /* Additional styles for homepage */
        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-text h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--dark-blue);
        }

        .hero-visual {
            position: relative;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .hero-stat {
            text-align: left;
        }

        .hero-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .hero-stat-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .kol-showcase {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-xl);
            position: relative;
        }

        .kol-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .kol-card-mini {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--gray-100);
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .kol-card-mini:hover {
            background: var(--primary-lighter);
            transform: translateX(5px);
        }

        .kol-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .kol-info-mini {
            flex: 1;
        }

        .kol-name-mini {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .kol-followers {
            font-size: 12px;
            color: var(--gray-600);
        }

        .kol-engagement {
            padding: 2px 6px;
            background: var(--success);
            color: white;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .trust-badges {
            display: flex;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            flex-wrap: wrap;
        }

        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .trust-badge span {
            color: var(--dark-blue);
        }

        .trust-badge-icon {
            width: 24px;
            height: 24px;
            color: var(--primary);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-box {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .feature-box:hover::before {
            transform: scaleX(1);
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .feature-number {
            width: 32px;
            height: 32px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .kol-list-section {
            background: var(--gray-100);
            padding: 4rem 0;
        }

        .kol-filter-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .filter-tab {
            padding: 0.5rem 1.5rem;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .filter-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .kol-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .kol-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .kol-table th {
            background: var(--gray-100);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--gray-200);
        }

        .kol-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-200);
            color: var(--dark-blue);
        }

        .kol-table tr:hover {
            background: var(--primary-lighter);
        }

        .kol-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .kol-avatar-large {
            width: 48px;
            height: 48px;
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

        .kol-handle {
            font-size: 12px;
            color: var(--gray-600);
        }

        .metric-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .metric-badge.high {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .metric-badge.medium {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .metric-badge.low {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .cta-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .cta-features {
            list-style: none;
            margin: 2rem 0;
        }

        .cta-features li {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
        }

        .cta-features li::before {
            content: '✓';
            width: 24px;
            height: 24px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .section-dark .section-title {
            color: var(--gray-100)
        }

        .section-dark .card-title,
        .section-dark h1,
        .section-dark h2,
        .section-dark h3,
        .section-dark h4,
        .section-dark h5,
        .section-dark h6 {
            color: var(--dark-blue);
        }
        .section-dark p {
            color: var(--gray-600);
        }


        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .cta-split {
                grid-template-columns: 1fr;
            }

            .kol-table {
                overflow-x: auto;
            }

            .kol-table table {
                min-width: 600px;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 140px 0 80px;">
        <div class="hero-content">
            <div class="hero-text fade-in">
                <div class="badge badge-primary mb-3">🚀 Nền tảng hỗ trợ AI</div>
                <h1>
                   Khám phá và phân tích <span class="gradient-text">TikTok KOLs</span>
                    giúp bạn cải thiện hiệu xuất
                </h1>
                <p style="font-size: 1.25rem; color: var(--gray-600); margin-bottom: 2rem;">
                    Truy cập dữ liệu thời gian thực của hơn 10.000 nhà sáng tạo TikTok tại Việt Nam. Tự tin đưa ra quyết định dựa trên dữ liệu.
                </p>

                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-large">
                        Bắt đầu dùng thử miễn phí
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" />
                        </svg>
                    </a>
                    <a href="#demo" class="btn btn-outline btn-large">
                        Xem bản demo
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-value">10,000+</div>
                        <div class="hero-stat-label">KOL đã được xác minh</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">2.5B+</div>
                        <div class="hero-stat-label">Tổng phạm vi tiếp cận</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">98%</div>
                        <div class="hero-stat-label">Tỷ lệ chính xác</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual fade-in" style="animation-delay: 0.2s;">
                <div class="kol-showcase">
                    <h4 style="margin-bottom: 1.5rem; color: var(--dark-blue);">🔥 KOLs thịnh hành hiện nay</h4>
                    <div class="kol-grid">
                        @foreach($kols as $k)
                        <div class="kol-card-mini">
                            <div class="kol-avatar">{{ $k->initials  }}</div>
                            <div class="kol-info-mini">
                                <div class="kol-name-mini">{{ $k->display_name }}</div>
                                <div class="kol-followers">{{ $k->followers }} người theo dõi</div>
                            </div>
                            <div class="kol-engagement">{{ $k->engagement }} %</div>
                        </div>
                        @endforeach
                    </div>
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <a href="#kol-list" style="color: var(--primary); font-weight: 600;">
                            Xem tất cả KOL →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section style="background: var(--gray-100); padding: 2rem 0;">
        <div class="container">
            <div class="trust-badges">
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 1 1 0 000 2H6a2 2 0 100 4h2a2 2 0 100-4h2a1 1 0 100-2 2 2 0 00-2 2v11a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2H6z" />
                    </svg>
                    <span>Dữ liệu thời gian thực</span>
                </div>
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                    </svg>
                    <span>Hồ sơ đã được xác minh</span>
                </div>
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                    <span>Phân tích nâng cao</span>
                </div>
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" />
                    </svg>
                    <span>Nền tảng an toàn</span>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section section-dark">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">CÁCH THỨC HOẠT ĐỘNG</div>
                <h2 class="section-title fade-in">Thành công của bạn trong 4 bước đơn giản</h2>
            </div>

            <div class="grid grid-3">
                <div class="feature-box fade-in">
                    <div class="feature-number">1</div>
                    <h4>Tìm kiếm & Lọc</h4>
                    <p>Sử dụng bộ lọc nâng cao để tìm KOL theo lĩnh vực, vị trí, người theo dõi, tỷ lệ tương tác, v.v.</p>
                </div>

                <div class="feature-box fade-in" style="animation-delay: 0.1s;">
                    <div class="feature-number">2</div>
                    <h4>Phân tích hiệu suất</h4>
                    <p>Xem xét các số liệu chi tiết bao gồm thông tin nhân khẩu học của khán giả, hiệu suất nội dung và điểm xác thực.</p>
                </div>

                <div class="feature-box fade-in" style="animation-delay: 0.2s;">
                    <div class="feature-number">3</div>
                    <h4>Kế hoạch chiến dịch</h4>
                    <p>Sử dụng các đề xuất của AI để lựa chọn hỗn hợp KOL tối ưu cho ngân sách và mục tiêu của bạn.</p>
                </div>

                <div class="feature-box fade-in" style="animation-delay: 0.3s;">
                    <div class="feature-number">4</div>
                    <h4>Theo dõi kết quả</h4>
                    <p>Theo dõi hiệu suất theo thời gian thực, ROI và nhận thông tin chi tiết hữu ích để tối ưu hóa chiến dịch của bạn.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KOL List Section -->
    <section id="kol-list" class="kol-list-section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">Người đạt thành tích cao nhất</div>
                <h2 class="section-title fade-in">KOL TikTok nổi bật</h2>
                <p class="section-description fade-in">
                    Khám phá những người có ảnh hưởng đã được xác minh với thành tích đã được chứng minh
                </p>
            </div>

            <div class="kol-filter-tabs flex flex-wrap gap-2 mb-8">
                <button class="filter-tab active" data-category="">Tất cả danh mục</button>
                <button class="filter-tab" data-category="beauty-fashion">Beauty & Fashion</button>
                <button class="filter-tab" data-category="lifestyle">Lifestyle</button>
                <button class="filter-tab" data-category="technology">Technology</button>
                <button class="filter-tab" data-category="food-drink">Food & Drink</button>
                <button class="filter-tab" data-category="travel">Travel</button>
            </div>

            <div class="kol-table">
                <table>
                    <thead>
                        <tr>
                            <th>Hồ sơ KOL</th>
                            <th>Danh mục</th>
                            <th>Người theo dõi</th>
                            <th>Mức độ tương tác</th>
                            <th>Lượt xem trung bình</th>
                            <th>Điểm tin cậy</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kols as $k)
                            <tr data-category="{{ $k->categories->isEmpty() ? '' : $k->categories->pluck('slug')->join(' ') }}">
                                <td>
                                    <div class="kol-profile">
                                        <div class="kol-avatar-large">{{ $k->initials }}</div>
                                        <div class="kol-details">
                                            <div style="font-weight: 600;">{{ $k->display_name }}</div>
                                            <div class="kol-handle">{{$k->username }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($k->categories->isEmpty())
                                        --
                                    @else
                                        @foreach($k->categories as $category)
                                            {{ $category->name }}
                                        @endforeach
                                    @endif
                                </td>
                                <td><strong>{{ $k->followers }}</strong></td>
                                <td><span class="metric-badge high">{{ $k->engagement }}%</span></td>
                                <td>{{ rand(100, 1000) }}K</td>
                                <td><span class="metric-badge high">{{ $k->trust_score }}/100</span></td>
                                <td>
                                    @auth
                                        <a href="{{ route('branch.kolProfile', $k->id) }}" class="btn btn-primary btn-small" style="height:32px; width: 114px">
                                            Xem hồ sơ
                                        </a>
                                    @else
                                        <a href="{{ route('login', ['redirect' => route('branch.kolProfile', $k->id)]) }}" class="btn btn-primary btn-small">
                                            Đăng nhập để xem
                                        </a>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                @auth
                    <a href="{{ route('branch.kolExplorer') }}" class="btn btn-primary btn-large">
                        Xem tất cả hơn 10.000 KOL
                    </a>
                @else
                    <a href="{{ route('login', ['redirect' => route('branch.kolExplorer')]) }}" class="btn btn-primary btn-large">
                        Đăng nhập để xem tất cả KOL
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">TÍNH NĂNG MẠNH MẼ</div>
                <h2 class="section-title color-gray-100 fade-in">Mọi thứ bạn cần để thành công</h2>
            </div>

            <div class="grid grid-2">
                <div class="feature-card fade-in">
                    <div class="feature-icon">🔍</div>
                    <h3 class="card-title">Khám phá thông minh</h3>
                    <p class="card-description color-gray-500">
                        Tìm kiếm hỗ trợ AI với hơn 50 bộ lọc để tìm KOL hoàn hảo cho thương hiệu của bạn
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.1s">
                    <div class="feature-icon">📊</div>
                    <h3 class="card-title">Phân tích thời gian thực</h3>
                    <p class="card-description color-gray-500">
                        Theo dõi số liệu hiệu suất, tỷ lệ tương tác và ROI theo thời gian thực
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.2s">
                    <div class="feature-icon">🎯</div>
                    <h3 class="card-title">Người lập kế hoạch chiến dịch</h3>
                    <p class="card-description color-gray-500">
                        Lập kế hoạch, thực hiện và tối ưu hóa các chiến dịch với thông tin chi tiết dựa trên dữ liệu
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.3s">
                    <div class="feature-icon">🛡️</div>
                    <h3 class="card-title">Phát hiện gian lận</h3>
                    <p class="card-description color-gray-500">
                        AI tiên tiến phát hiện người theo dõi giả mạo và thao túng tương tác
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.4s">
                    <div class="feature-icon">💰</div>
                    <h3 class="card-title">Máy tính ROI</h3>
                    <p class="card-description color-gray-500">
                        Tính toán và dự đoán ROI của chiến dịch trước khi bạn chi tiêu
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.5s">
                    <div class="feature-icon">📈</div>
                    <h3 class="card-title">Theo dõi tăng trưởng</h3>
                    <p class="card-description color-gray-500">
                       Theo dõi xu hướng tăng trưởng của KOL và sớm xác định những ngôi sao đang lên
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section" style="background: var(--gray-100);">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">CÂU CHUYỆN THÀNH CÔNG</div>
                <h2 class="section-title fade-in">Được các thương hiệu hàng đầu tin cậy</h2>
            </div>

            <div class="grid grid-3">
                <div class="card fade-in">
                    <div class="d-flex gap-1 mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="mb-3" style="font-style: italic; color: var(--gray-400);">
                        "OneUp KOL đã giúp chúng tôi tăng ROI lên 300% chỉ trong 3 tháng. Các khuyến nghị của AI cực kỳ chính xác."
                    </p>
                    <div class="d-flex align-center gap-2">
                        <div class="kol-avatar">NT</div>
                        <div>
                            <strong>Nguyễn Thảo</strong><br>
                            <small class="color-gray-500">Giám đốc Tiếp thị, Thương hiệu Thời trang</small>
                        </div>
                    </div>
                </div>

                <div class="card fade-in" style="animation-delay: 0.1s">
                    <div class="d-flex gap-1 mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="mb-3" style="font-style: italic; color: var(--gray-400);">
                        "Tính năng phát hiện gian lận đã giúp chúng tôi tránh lãng phí ngân sách cho những người có sức ảnh hưởng giả mạo. Công cụ thiết yếu cho bất kỳ nhà tiếp thị nào."
                    </p>
                    <div class="d-flex align-center gap-2">
                        <div class="kol-avatar">LM</div>
                        <div>
                            <strong>Lê Minh</strong><br>
                            <small class="color-gray-500">CEO, Tech Startup</small>
                        </div>
                    </div>
                </div>

                <div class="card fade-in" style="animation-delay: 0.2s">
                    <div class="d-flex gap-1 mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="mb-3" style="font-style: italic; color: var(--gray-400);">
                        "Theo dõi thời gian thực giúp chúng tôi tối ưu hóa chiến dịch ngay lập tức. Chúng tôi đã thấy tỷ lệ tương tác tăng gấp 5 lần."
                    </p>
                    <div class="d-flex align-center gap-2">
                        <div class="kol-avatar">PH</div>
                        <div>
                            <strong>Phạm Hương</strong><br>
                            <small class="color-gray-500">CMO, Công ty làm đẹp</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: var(--gradient-blue); color: white;">
        <div class="container">
            <div class="cta-split">
                <div class="cta-content">
                    <h2 style="color: white;">Bạn đã sẵn sàng chuyển đổi hoạt động tiếp thị trên TikTok chưa?</h2>
                    <p style="font-size: 1.25rem; opacity: 0.95; margin-bottom: 2rem; color: #fefefe;">
                        Tham gia cùng hơn 500 thương hiệu sử dụng OneUp KOL để tối ưu hóa các chiến dịch có sức ảnh hưởng của họ
                    </p>

                    <ul class="cta-features">
                        <li>Truy cập hơn 10.000 hồ sơ KOL đã được xác minh</li>
                        <li>Phân tích theo thời gian thực và theo dõi ROI</li>
                        <li>Đề xuất hỗ trợ bởi AI</li>
                        <li>Hỗ trợ khách hàng tận tâm</li>
                    </ul>

                    <div class="d-flex gap-2" style="margin-top: 2rem;">
                        <a href="{{ route('register') }}" class="btn"
                            style="background: white; color: var(--primary);">
                            Bắt đầu dùng thử miễn phí
                        </a>
                        <a href="{{ route('pricing') }}" class="btn"
                            style="background: rgba(255,255,255,0.2); color: white; border: 2px solid white;">
                            Xem giá
                        </a>
                    </div>
                </div>

                <div style="text-align: center;">
                    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: var(--shadow-2xl);">
                        <h3 style="color: var(--dark-blue); margin-bottom: 1.5rem;">Bắt đầu trong vài phút</h3>
                        <div style="text-align: left;">
                            <div
                                style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--primary); font-size: 24px; font-weight: 700;">1</span>
                                <span style="color: var(--gray-700);">Đăng ký tài khoản miễn phí</span>
                            </div>
                            <div
                                style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--primary); font-size: 24px; font-weight: 700;">2</span>
                                <span style="color: var(--gray-700);">Tìm kiếm và phân tích KOL</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0;">
                                <span style="color: var(--primary); font-size: 24px; font-weight: 700;">3</span>
                                <span style="color: var(--gray-700);">Khởi chạy chiến dịch đầu tiên của bạn</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Filter tabs functionality
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
    <script>
        // $(function() {

        //     $('.contact-form').on('submit', function(e) {
        //         e.preventDefault();

        //         $(this).find('button').prop('disabled', true);

        //         var data = {
        //             name: $(this).find('input[name="name"]').val(),
        //             phone: $(this).find('input[name="phone"]').val(),
        //             email: $(this).find('input[name="email"]').val(),
        //             product: $(this).find('select[name="product"]').val(),
        //             message: $(this).find('textarea[name="message"]').val()
        //         };

        //         $.ajax({
        //             type: 'post',
        //             url: '{{ route('newsletters') }}',
        //             data: data,
        //         }).then(function(res) {
        //             if (res.success) {
        //                 toastr.success(
        //                     'Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
        //                 $('.contact-form')[0].reset();
        //             } else {
        //                 toastr.error(res.msg);
        //             }
        //         });
        //         $(this).find('button').prop('disabled', false);
        //     });
        // });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.filter-tab');
        const rows = document.querySelectorAll('.kol-table tbody tr');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Bỏ active các tab khác
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const category = tab.dataset.category;
                
                rows.forEach(row => {
                    const rowCats = row.dataset.category?.split(' ') || [];
                    if (category === '' || rowCats.includes(category)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>

@endsection
