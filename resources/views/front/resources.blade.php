@extends('layouts.front')

@section('meta')
    <title>Tin tức - OneUp KOL Analytics</title>
    <meta name="description"
        content="Resources - Blog, guides, case studies and insights about TikTok influencer marketing">



@section('css')
    <style>
        .resource-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }
        
        .tab-btn {
            padding: 12px 24px;
            background: white;
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 13.5px;
            line-height: 1;
        }
        
        .tab-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .tab-btn.active {
            background: var(--gradient);
            color: white;
            border-color: transparent;
        }
        
        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .resource-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }
        
        .resource-image {
            width: 100%;
            height: 200px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            position: relative;
            overflow: hidden;
        }
        
        .resource-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
        }
        
        .resource-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 6px 12px;
            background: rgba(255,255,255,0.9);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            z-index: 1;
    color: var(--dark-blue);
        }
        
        .resource-content {
            padding: 1.5rem;
        }
        
        .resource-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.3;
    color: var(--dark-blue);
        }
        
        .resource-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 14px;
            color: var(--gray-light);
        }
        
        .resource-excerpt {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .resource-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: gap 0.3s;
        }
        
        .resource-link:hover {
            gap: 1rem;
        }
        
        .featured-resource {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: linear-gradient(135deg, white 0%, #F8F9FA 100%);
        }
        
        .featured-resource .resource-image {
            height: 100%;
            min-height: 300px;
        }
        
        .featured-resource .resource-content {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .download-card {
            background: var(--gradient);
            color: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .download-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        .download-card p {
            color: var(--gray-300);
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .newsletter-form {
            display: flex;
            gap: 1rem;
            max-width: 500px;
            margin: 2rem auto 0;
        }
        
        .newsletter-input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        
        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .filter-sidebar {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 100px;
        }
        
        .filter-group {
            margin-bottom: 2rem;
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }
        
        .filter-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        @media (max-width: 1024px) {
            .featured-resource {
                grid-column: span 1;
                grid-template-columns: 1fr;
            }
            
            .featured-resource .resource-image {
                min-height: 200px;
            }
        }
        
        @media (max-width: 768px) {
            .resource-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('page')
    
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 60px; background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 color-dark-blue fade-in">
                    Tin tức & <span class="gradient-text">Thông Tin Chiến Lược</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Tìm hiểu mọi thứ về marketing influencer TikTok qua hướng dẫn, nghiên cứu điển hình và báo cáo ngành.
                </p>
                
                <!-- Resource Tabs -->
                <div class="resource-tabs fade-in">
                    <a href="{{ route('resources', ['category' => 'all']) }}" 
                    class="tab-btn {{ $categorySlug == 'all' ? 'active' : '' }}" style="text-decoration: none">Tất Cả</a>

                    <a href="{{ route('resources', ['category' => 'news']) }}" 
                    class="tab-btn {{ $categorySlug == 'news' ? 'active' : '' }}" style="text-decoration: none">Tin tức</a>

                    <a href="{{ route('resources', ['category' => 'travel']) }}" 
                    class="tab-btn {{ $categorySlug == 'travel' ? 'active' : '' }}" style="text-decoration: none">Du lịch</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Resource -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="resource-grid">
                <!-- Featured Article -->
                {{-- <div class="featured-resource resource-card fade-in">
                    <div class="resource-image">
                        <span class="resource-category">Báo Cáo Nổi Bật</span>
                        <span style="font-size: 72px;">📈</span>
                    </div>
                    <div class="resource-content">
                        <div class="badge badge-primary mb-2">MỚI</div>
                        <h2 class="resource-title">Báo Cáo Marketing KOL TikTok 2025: Thị Trường Việt Nam</h2>
                        <div class="resource-meta">
                            <span>📅 15 Tháng 1, 2025</span>
                            <span>⏱ 15 phút đọc</span>
                            <span>👁 5.2K lượt xem</span>
                        </div>
                        <p class="resource-excerpt">
                            Phân tích toàn diện xu hướng marketing KOL TikTok tại Việt Nam. Khám phá tỷ lệ tương tác trung bình, mức giá tham khảo và chiến lược thành công từ hơn 500 chiến dịch.
                        </p>
                        <a href="#" class="resource-link">
                            Tải Báo Cáo Miễn Phí
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    </div>
                </div> --}}

                <!-- Blog Posts -->
                @foreach($posts as $p)
                    <div class="resource-card fade-in" data-category="blog">
                        <div class="resource-image">
                            <span class="resource-category"><span class="article-category">{{ $p->categories->first()?->name }}</span></span>

                            <img src="{{ $p->getFirstMediaUrl('media') }}" alt="">
                        </div>
                        <div class="resource-content">
                            <h3 class="resource-title">
                                <a href="{{ route('resources.show', $p->slug) }}" style="color: black; text-decoration: none">
                                    {{ $p->title }}
                                </a>   
                            </h3>
                            {{-- <div class="resource-meta">
                                <span>12 Tháng 1, 2025</span>
                                <span>8 phút đọc</span>
                            </div> --}}
                            <p class="resource-excerpt">
                                {{ $p->excerpt }}
                            </p>
                            <a href="{{ route('resources.show', $p->slug) }}" class="resource-link">
                                Đọc Thêm →
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Download Section -->
    {{-- <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <div class="grid grid-3">
                <div class="download-card fade-in">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📱</div>
                    <h3 style="margin-bottom: 1rem;">Danh Sách Kiểm Tra TikTok KOL</h3>
                    <p style="opacity: 0.9; margin-bottom: 1.5rem;">
                        Danh sách quan trọng để đánh giá và chọn lọc influencer TikTok
                    </p>
                    <button class="btn" style="background: white; color: var(--primary);">
                        Tải Miễn Phí
                    </button>
                </div>

                <div class="download-card fade-in" style="animation-delay: 0.1s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📋</div>
                    <h3 style="margin-bottom: 1rem;">Mẫu Kế Hoạch Chiến Dịch</h3>
                    <p style="opacity: 0.9; margin-bottom: 1.5rem;">
                        Mẫu sẵn sàng sử dụng để lập kế hoạch chiến dịch TikTok hiệu quả
                    </p>
                    <button class="btn" style="background: white; color: var(--primary);">
                        Nhận Mẫu
                    </button>
                </div>

                <div class="download-card fade-in" style="animation-delay: 0.2s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">💰</div>
                    <h3 style="margin-bottom: 1rem;">Công Cụ Tính ROI</h3>
                    <p style="opacity: 0.9; margin-bottom: 1.5rem;">
                        File Excel giúp bạn tính toán ROI chiến dịch tức thì
                    </p>
                    <button class="btn" style="background: white; color: var(--primary);">
                        Tải Công Cụ
                    </button>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Newsletter Section -->
    {{-- <section class="section">
        <div class="container text-center">
            <div class="section-header">
                <div class="section-subtitle fade-in">CẬP NHẬT MỚI NHẤT</div>
                <h2 class="section-title color-gray-100 fade-in">Nhận Tin Tức Hàng Tuần</h2>
                <p class="section-description color-gray-600 fade-in">
                    Tham gia hơn 5,000 marketer nhận bản tin hàng tuần về<br>
                    xu hướng TikTok, nghiên cứu và cập nhật nền tảng mới nhất.
                </p>
            </div>
            
            <form class="newsletter-form fade-in" onsubmit="handleNewsletter(event)">
                <input type="email" class="newsletter-input" placeholder="Nhập email của bạn" required>
                <button type="submit" class="btn btn-primary">Đăng Ký</button>
            </form>
            
            <p class="mt-3" style="color: var(--gray-light); font-size: 14px;">
                Không spam. Bạn có thể hủy đăng ký bất cứ lúc nào.
            </p>
        </div>
    </section> --}}

    <!-- Popular Topics -->
    {{-- <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <h2 class="text-center color-dark-blue mb-4">Chủ Đề Phổ Biến</h2>
            
            <div class="d-flex flex-wrap justify-center gap-2">
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #TikTokMarketing
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #HiệuQuảInfluencer
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #MicroInfluencer
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #ChiếnLượcNộiDung
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #PhânTíchChiếnDịch
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #MarketingLanTruyền
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #HợpTácThươngHiệu
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #XuHướngTikTok
                </a>
            </div>
        </div>
    </section> --}}
@endsection


@section('js')
    <script>
        // Filter Resources
        function filterResources(category) {
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Filter cards
            const cards = document.querySelectorAll('.resource-card');
            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Handle Newsletter
        function handleNewsletter(event) {
            event.preventDefault();
            const email = event.target.querySelector('input[type="email"]').value;
            alert(`Thank you for subscribing with ${email}! Check your inbox for confirmation.`);
            event.target.reset();
        }
    </script>
@endsection
