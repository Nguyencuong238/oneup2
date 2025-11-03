@extends('layouts.front')

@section('meta')
    <title>Giới thiệu về chúng tôi - OneUp Nhà sáng tạo Analytics</title>
    <meta name="description" content="About OneUp KOL Analytics - Leading TikTok influencer marketing platform in Vietnam">
@endsection

@section('css')
    <style>
        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--gradient);
            transform: translateX(-50%);
        }

        .timeline-item {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-right: 50%;
            text-align: right;
            padding-right: 3rem;
        }

        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 50%;
            padding-left: 3rem;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--gradient);
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 2px 10px rgba(255, 0, 80, 0.3);
        }

        .timeline-content h3 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .team-member {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .team-avatar::after {
            content: '';
            position: absolute;
            inset: -5px;
            background: var(--gradient);
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .team-member:hover .team-avatar::after {
            opacity: 0.3;
            animation: pulse 2s infinite;
        }

        .timeline-content h4 {
            color: var(--gray-900)
        }

        .timeline-content p {
            color: var(--gray-600)
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .team-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-blue);
        }

        .team-role {
            color: var(--primary);
            font-size: 14px;
            margin-bottom: 1rem;
        }

        .team-bio {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.6;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            justify-items: center;
        }

        .value-card {
            padding: 2rem;
            background: linear-gradient(135deg, white 0%, #F8F9FA 100%);
            border-radius: 20px;
            border: 1px solid rgba(255, 0, 80, 0.1);
            transition: var(--transition);
            height: 100%;
            text-align: center;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 0, 80, 0.1);
            border-color: var(--primary);
        }

        .value-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 1.5rem auto;
        }

        /* 🌟 ép 5 cột khi màn hình lớn */
        @media (min-width: 1200px) {
            .values-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }


        .value-card:hover .value-icon {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 132, 255, 0.3);
        }

        /* text */
        .value-card h3 {
            font-size: 20px;
            font-weight: 700;
            color: #111;
            margin-bottom: 0.5rem;
        }

        .value-card h4 {
            font-size: 16px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 0.75rem;
        }

        .value-card p {
            font-size: 15px;
            line-height: 1.5;
            color: #555;
        }

        /* hover màu icon gradient riêng */
        .value-card:nth-child(1) .value-icon {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
        }
        .value-card:nth-child(2) .value-icon {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
        }
        .value-card:nth-child(3) .value-icon {
            background: linear-gradient(135deg, #f7971e, #ffd200);
        }
        .value-card:nth-child(4) .value-icon {
            background: linear-gradient(135deg, #8e2de2, #4a00e0);
        }
        .value-card:nth-child(5) .value-icon {
            background: linear-gradient(135deg, #00b09b, #96c93d);
        }

        .partner-logos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 3rem;
            margin-top: 3rem;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s;
        }

        .partner-logos:hover {
            filter: grayscale(0);
            opacity: 1;
        }

        .partner-logo {
            width: 120px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            color: var(--gray);
        }

        .values-grid h3 {
            color: var(--dark-blue);
        }

        .values-grid p {
            color: var(--gray-600);
        }

        @media (max-width: 768px) {
            .timeline::before {
                left: 30px;
            }

            .timeline-item .timeline-content {
                margin-left: 80px !important;
                margin-right: 0 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                text-align: left !important;
            }

            .timeline-dot {
                left: 30px;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 80px;">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 color-dark-blue fade-in" style="font-size: 61px">
                    <span class="gradient-text">Dữ Liệu Thông Minh</span>
                    Kiến Tạo Ảnh Hưởng Từ Những Quyết Định Chính Xác
                </h1>
                <p class="section-description mb-4 fade-in">
                    Từ phân tích hiệu suất đến dự đoán xu hướng, ONEUP giúp thương hiệu ra quyết định dựa trên dữ liệu — không dựa vào cảm tính.
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section" style="background: var(--gradient); color: white; padding: 60px 0;">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item fade-in">
                    <div class="stat-number" >2025</div>
                    <div class="stat-label">Thành lập</div>
                </div>
                <div class="stat-item fade-in" style="animation-delay: 0.1s;">
                    <div class="stat-number" data-counter="45">0</div>
                    <div class="stat-label">Thành viên</div>
                </div>
                <div class="stat-item fade-in" style="animation-delay: 0.2s;">
                    <div class="stat-number" data-counter="500">0</div>
                    <div class="stat-label">Khách hàng hài lòng</div>
                </div>
                <div class="stat-item fade-in" style="animation-delay: 0.3s;">
                    <div class="stat-number">100M+</div>
                    <div class="stat-label">Giá trị chiến dịch theo dõi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">CÂU CHUYỆN CỦA CHÚNG TÔI</div>
                <h2 class="section-title color-gray-100 fade-in">Khởi Nguồn</h2>
            </div>

            <div class="grid grid-2 align-center gap-5">
                <div class="slide-in-left">
                    <p class="mb-3" style="font-size: 18px; line-height: 1.8; color: var(--gray-light);">
                        OneUp Analytics ra đời với tầm nhìn giúp thương hiệu Việt Nam ra quyết định tiếp thị thông minh hơn bằng sức mạnh của dữ liệu.
                    </p>
                    <p class="mb-3" style="font-size: 18px; line-height: 1.8; color: var(--gray-light);">
                        Trong kỷ nguyên sáng tạo nội dung bùng nổ, việc tìm đúng người kể câu chuyện thương hiệu trở nên phức tạp hơn bao giờ hết, trong khi các phương pháp truyền thống lại tốn kém và thiếu hiệu quả.
                    </p>
                    <p style="font-size: 18px; line-height: 1.8; color: var(--gray-light);">
                        Dựa trên nền tảng khoa học dữ liệu và công nghệ phân tích hiện đại, OneUp giúp thương hiệu kết nối chính xác hơn với nhà sáng tạo nội dung, KOC và Creator, biến dữ liệu thành lợi thế cạnh tranh thực sự.
                        Chúng tôi tiên phong trong việc ứng dụng dữ liệu thông minh vào influencer marketing tại Việt Nam, đồng hành cùng hàng trăm thương hiệu tối ưu hiệu quả đầu tư và mở rộng tầm ảnh hưởng trên mạng xã hội.
                    </p>
                </div>
                <div class="slide-in-right">
                    <div
                        style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%); border-radius: 20px; padding: 3rem; text-align: center;">
                        <div style="font-size: 64px; margin-bottom: 1rem;">🚀</div>
                        <h3 class="gradient-text">Sứ Mệnh Của Chúng Tôi</h3>
                        <p style="color: var(--gray-800); margin-top: 1rem; font-style: italic;">
                            "Trao quyền cho mọi thương hiệu tại Việt Nam với công cụ và dữ liệu cần thiết để triển khai các chiến dịch tiếp thị người ảnh hưởng thành công."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="text-center mb-5 color-dark-blue">Hành Trình Của Chúng Tôi</h2>

            <div class="timeline">
                <div class="timeline-item fade-in">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2019</h3>
                        <h4>Thành lập công ty AnyTech</h4>
                        <p> Hoạt động trong lĩnh vực thiết kế phần mềm và marketing trực tuyến.</p>
                    </div>
                </div>

                <div class="timeline-item fade-in" style="animation-delay: 0.1s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2021</h3>
                        <h4>Triển khai các dịch vụ marketing trong lĩnh vực web3</h4>
                        {{-- <p>Ra mắt bản thử nghiệm với 50 thương hiệu đầu tiên.</p> --}}
                    </div>
                </div>

                <div class="timeline-item fade-in" style="animation-delay: 0.2s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2022-2023</h3>
                        <h4>Mở rộng dịch vụ Marketing sang lĩnh vực chăm sức sức khoẻ và thực phẩm</h4>
                        {{-- <p>Gọi vốn 2 triệu USD để mở rộng năng lực nền tảng và đội ngũ.</p> --}}
                    </div>
                </div>

                <div class="timeline-item fade-in" style="animation-delay: 0.3s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2024</h3>
                        <h4>Nghiên cứu và triển khai mảng Marketing cho lĩnh vực FnB</h4>
                        {{-- <p>Ra mắt gợi ý các nhà sáng tạo nội dung và phát hiện gian lận dựa trên trí tuệ nhân tạo.</p> --}}
                    </div>
                </div>

                <div class="timeline-item fade-in" style="animation-delay: 0.4s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2025</h3>
                        <h4>Nghiên cứu và phân tích dữ liệu liên quan tới Tiktok và Youtube</h4>
                        {{-- <p>Trở thành nền tảng phân tích KOL Creator Community số 1 tại Việt Nam.</p> --}}
                    </div>
                </div>

                <div class="timeline-item fade-in" style="animation-delay: 0.5s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Tháng 9/2025</h3>
                        <h4>Thành lập công ty AnyMedia Hoạt động trong lĩnh vực truyền thông và giải trí trực tuyến.</h4>
                        {{-- <p>Mở rộng sang Thái Lan, Philippines và Indonesia.</p> --}}
                    </div>
                </div>

                <div class="timeline-item fade-in" style="animation-delay: 0.4s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3> Tháng 10/2025</h3>
                        <h4>Ra mắt OneUp Analytics</h4>
                        {{-- <p>Ra mắt OneUp Analytics.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle fade-in" style="font-size: 38px; font-weight:700">ĐẶC ĐIỂM NỔI BẬT VỀ ONEUP.VN</p>
                <p class="section-title color-gray-100 fade-in">"ONEUP tin rằng nội dung chân thật là nền tảng của niềm tin thương hiệu."</p>
            </div>

            <div class="values-grid">
                <div class="value-card fade-in">
                    <div class="value-icon">🎯</div>
                    <h3>Authenticity</h3>
                    <h4>Tính xác thực</h4>
                    <p>Review thật / Người thật / Sản phẩm thật / Trải nghiệm thật</p>
                </div>

                <div class="value-card fade-in" style="animation-delay: 0.1s;">
                    <div class="value-icon">🤝</div>
                    <h3>Creativity</h3>
                    <h4>Sáng tạo</h4>
                    <p>Concept video độc đáo / Phù hợp GenZ</p>
                </div>

                <div class="value-card fade-in" style="animation-delay: 0.2s;">
                    <div class="value-icon">💡</div>
                    <h3>Collaboration</h3>
                    <h4>Hợp tác</h4>
                    <p>Win-win giữa Brand / Creator / Audience</p>
                </div>

                <div class="value-card fade-in" style="animation-delay: 0.3s;">
                    <div class="value-icon">🔍</div>
                    <h3>Data-driven</h3>
                    <h4>Dựa trên số liệu</h4>
                    <p>Theo dõi KPI, Reach, ROI rõ ràng</p>
                </div>

                <div class="value-card fade-in" style="animation-delay: 0.4s;">
                    <div class="value-icon">⚡</div>
                    <h3>Sustainability</h3>
                    <h4>Bền vững</h4>
                    <p>Phát triển cộng đồng và creator bền vững</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">ĐỘI NGŨ CỦA CHÚNG TÔI</div>
                <h2 class="section-title fade-in" style="font-size: 40px">Những Con Người Đằng Sau OneUp</h2>
                <p class="section-description fade-in">
                    Đội ngũ đa dạng các chuyên gia đam mê tiếp thị người ảnh hưởng
                </p>
            </div>

            <div class="team-grid">
                <div class="team-member fade-in">
                    <div class="team-avatar">AV</div>
                    <div class="team-name">Alex Vu</div>
                    <div class="team-role">CEO</div>
                    {{-- <div class="team-bio">Hơn 10 năm trong lĩnh vực tiếp thị số. Cựu Trưởng phòng Digital tại Unilever Việt Nam.</div> --}}
                </div>

                <div class="team-member fade-in" style="animation-delay: 0.1s;">
                    <div class="team-avatar">PT</div>
                    <div class="team-name">Pham Thao</div>
                    <div class="team-role">CTO</div>
                    {{-- <div class="team-bio">Chuyên gia AI/ML. Cựu kỹ sư cấp cao tại Google Singapore.</div> --}}
                </div>

                <div class="team-member fade-in" style="animation-delay: 0.2s;">
                    <div class="team-avatar">TV</div>
                    <div class="team-name">Thuy Vu</div>
                    <div class="team-role">Kols Manager</div>
                    {{-- <div class="team-bio">Tầm nhìn sản phẩm với kinh nghiệm tại Grab và Shopee.</div> --}}
                </div>

                <div class="team-member fade-in" style="animation-delay: 0.3s;">
                    <div class="team-avatar">TT</div>
                    <div class="team-name">Thu Trang</div>
                    <div class="team-role">Account</div>
                    {{-- <div class="team-bio">Tiến sĩ Khoa học Dữ liệu. Chuyên gia phân tích mạng xã hội.</div> --}}
                </div>

                {{-- <div class="team-member fade-in" style="animation-delay: 0.4s;">
                    <div class="team-avatar">VL</div>
                    <div class="team-name">Vũ Linh</div>
                    <div class="team-role">Trưởng Bộ Phận Thành Công Khách Hàng</div>
                    <div class="team-bio">Đam mê giúp thương hiệu thành công cùng tiếp thị người ảnh hưởng.</div>
                </div> --}}

                {{-- <div class="team-member fade-in" style="animation-delay: 0.5s;">
                    <div class="team-avatar">HN</div>
                    <div class="team-name">Hoàng Nam</div>
                    <div class="team-role">Trưởng Bộ Phận Tiếp Thị</div>
                    <div class="team-bio">Chuyên gia tăng trưởng với thành tích mở rộng các công ty SaaS B2B.</div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">ĐƯỢC TIN TƯỞNG BỞI</div>
                <h2 class="section-title color-gray-100 fade-in">Đối Tác & Khách Hàng</h2>
            </div>

            <div class="partner-logos">
                <div class="partner-logo">
                    <img src="{{ asset('assets/bia.jpg') }}"  style="height:80px; width: 120px; border-radius: 5px">
                </div>
                <div class="partner-logo">
                    <img src="{{ asset('assets/megasea.jpg') }}"  style="height:80px; width: 120px; border-radius: 5px">
                </div>
                <div class="partner-logo">
                    <img src="{{ asset('assets/d-one.jpg') }}"  style="height:80px; width: 120px; border-radius: 5px">
                </div>
                <div class="partner-logo">
                    <img src="{{ asset('assets/hansky.jpg') }}"  style="height:80px; width: 120px; border-radius: 5px">
                </div>
                <div class="partner-logo">
                    <img src="{{ asset('assets/bep.jpg') }}"  style="height:80px; width: 120px; border-radius: 5px">
                </div>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    {{-- <section class="section" style="background: #F8F9FA;">
        <div class="container text-center">
            <h2 class="mb-4">Giải Thưởng & Sự Công Nhận</h2>

            <div class="grid grid-4">
                <div class="card fade-in">
                    <div style="font-size: 48px; margin-bottom: 1rem;">🏆</div>
                    <h4>Startup MarTech Xuất Sắc Nhất</h4>
                    <p style="color: var(--gray-light);">Vietnam Tech Awards 2023</p>
                </div>

                <div class="card fade-in" style="animation-delay: 0.1s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">⭐</div>
                    <h4>Top 10 Startup Hàng Đầu</h4>
                    <p style="color: var(--gray-light);">Đông Nam Á 2023</p>
                </div>

                <div class="card fade-in" style="animation-delay: 0.2s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">🚀</div>
                    <h4>Tăng Trưởng Nhanh Nhất</h4>
                    <p style="color: var(--gray-light);">Tech in Asia 2022</p>
                </div>

                <div class="card fade-in" style="animation-delay: 0.3s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">💎</div>
                    <h4>Giải Thưởng Đổi Mới</h4>
                    <p style="color: var(--gray-light);">Digital Marketing Asia 2023</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- CTA Section -->
    <section class="section" style="background: var(--gradient); color: white;">
        <div class="container text-center">
            <h2 class="mb-3">Hãy Cùng Chúng Tôi Thực Hiện Sứ Mệnh</h2>
            <p class="mb-4" style="font-size: 18px; opacity: 0.9;">
                Trở thành một phần của cuộc cách mạng tiếp thị người ảnh hưởng tại Đông Nam Á.
            </p>
            <div class="d-flex gap-2 justify-center">
                @auth
                    <a href="{{ auth()->user()->type == 'brand' ? route('brand.dashboard') : route('creator.dashboard') }}" class="btn" style="background: white; color: var(--primary);">
                        Bảng điều khiển
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn" style="background: white; color: var(--primary);">
                        Đăng ký
                    </a>
                    <a href="{{ route('login') }}" class="btn"
                        style="background: rgba(255,255,255,0.2); color: white; border: 2px solid white;">
                        Đăng nhập
                    </a>
                @endauth
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script></script>
@endsection
