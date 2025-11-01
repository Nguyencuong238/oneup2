@extends('layouts.front')

@section('meta')
    <title>Help Center - OneUp KOL Analytics</title>
    <meta name="description"
        content="Help Center - Get support and find answers about OneUp KOL Analytics platform">
@endsection

@section('css')
    <style>
        .search-box {
            max-width: 600px;
            margin: 0 auto 3rem;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 20px 60px 20px 24px;
            font-size: 18px;
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 0, 80, 0.1);
        }
        
        .search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: var(--gradient);
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
        }
        
        .help-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .help-category {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .help-category:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }
        
        .help-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, rgba(255, 0, 80, 0.1) 0%, rgba(0, 242, 234, 0.1) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            transition: all 0.3s;
        }
        
        .help-category:hover .help-icon {
            transform: scale(1.1) rotate(5deg);
            background: var(--gradient);
        }
        
        .help-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-blue);
        }
        
        .help-description {
            color: var(--gray-600);
            font-size: 14px;
        }
        
        .faq-section {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .faq-item {
            background: white;
            border-radius: 16px;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .faq-item:hover {
            box-shadow: var(--shadow-md);
        }
        
        .faq-question {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .faq-question:hover {
            background: linear-gradient(90deg, rgba(255, 0, 80, 0.05) 0%, rgba(0, 242, 234, 0.05) 100%);
        }
        .faq-question span {
            color: var(--dark-blue)
        }
        
        .faq-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }
        
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            color: var(--gray-light);
            line-height: 1.8;
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 0 1.5rem 1.5rem;
        }
        .faq-answer p, .faq-answer li {
            color: var(--gray-600);
        }
        
        .contact-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .video-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .video-thumbnail {
            width: 100%;
            height: 180px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .play-btn {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary);
            transition: all 0.3s;
        }
        
        .video-card:hover .play-btn {
            transform: scale(1.2);
            background: white;
        }
        
        .video-info {
            padding: 1rem;
        }
        
        .video-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-blue);
        }
        
        .video-duration {
            color: var(--gray-600);
            font-size: 14px;
        }
        
        .quick-links {
            background: linear-gradient(135deg, #F8F9FA 0%, white 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .quick-link {
            color: var(--primary);
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .quick-link:hover {
            background: rgba(255, 0, 80, 0.1);
            padding-left: 1rem;
        }
        .contact-cards h3 {
            color: var(--dark-blue);
        }
    </style>
@endsection

@section('page')
    
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 80px; background: var(--gradient);">
        <div class="container">
            <div class="text-center" style="color: white;">
                <h1 class="mb-3 fade-in">Chúng tôi có thể giúp gì cho bạn?</h1>
                <p class="mb-4 fade-in" style="font-size: 20px; opacity: 0.9;">
                    Tìm kiếm trong trung tâm hỗ trợ hoặc duyệt theo danh mục bên dưới
                </p>
                
                <!-- Search Box -->
                <div class="search-box fade-in">
                    <input type="text" class="search-input" placeholder="Tìm bài viết, hướng dẫn hoặc chủ đề..." id="searchInput">
                    <button class="search-btn" onclick="performSearch()">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                
                <div class="fade-in" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <span style="opacity: 0.9;">Tìm kiếm phổ biến:</span>
                    <a href="#" style="color: white; text-decoration: underline;">Thiết lập chiến dịch</a>
                    <a href="#" style="color: white; text-decoration: underline;">Câu hỏi thanh toán</a>
                    <a href="#" style="color: white; text-decoration: underline;">Xác minh nhà sáng tạo nội dung</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Categories -->
    <section class="section" style="padding-top: 0; margin-top: -40px;">
        <div class="container">
            <div class="help-categories">
                <div class="help-category fade-in" onclick="showCategory('getting-started')">
                    <div class="help-icon">🚀</div>
                    <h3 class="help-title">Bắt đầu sử dụng</h3>
                    <p class="help-description">Tìm hiểu những kiến thức cơ bản khi sử dụng nền tảng OneUp KOL Analytics</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.1s;" onclick="showCategory('account')">
                    <div class="help-icon">👤</div>
                    <h3 class="help-title">Tài khoản & Thanh toán</h3>
                    <p class="help-description">Quản lý tài khoản, gói đăng ký và phương thức thanh toán của bạn</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.2s;" onclick="showCategory('campaigns')">
                    <div class="help-icon">📈</div>
                    <h3 class="help-title">Chiến dịch</h3>
                    <p class="help-description">Tạo, quản lý và theo dõi chiến dịch influencer của bạn</p>
                </div>
                
                {{-- <div class="help-category fade-in" style="animation-delay: 0.3s;" onclick="showCategory('analytics')">
                    <div class="help-icon">📊</div>
                    <h3 class="help-title">Phân tích & Báo cáo</h3>
                    <p class="help-description">Hiểu rõ các chỉ số, thông tin chi tiết và cách tạo báo cáo</p>
                </div> --}}
                
                <div class="help-category fade-in" style="animation-delay: 0.4s;" onclick="showCategory('kol-discovery')">
                    <div class="help-icon">🔍</div>
                    <h3 class="help-title">Khám phá nhà sáng tạo nội dung</h3>
                    <p class="help-description">Tìm và đánh giá influencer phù hợp với thương hiệu của bạn</p>
                </div>
                
                {{-- <div class="help-category fade-in" style="animation-delay: 0.5s;" onclick="showCategory('api')">
                    <div class="help-icon">⚙️</div>
                    <h3 class="help-title">API & Tích hợp</h3>
                    <p class="help-description">Kết nối OneUp với các công cụ và quy trình hiện có của bạn</p>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Popular Articles -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="text-center color-dark-blue mb-4">Bài viết hỗ trợ phổ biến</h2>
            
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Làm thế nào để bắt đầu chiến dịch đầu tiên?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Để bắt đầu chiến dịch đầu tiên của bạn:</p>
                        <ol style="margin-left: 20px; margin-top: 10px;">
                            <li>Đi đến mục Chiến dịch trong trang quản trị</li>
                            <li>Nhấn “Tạo chiến dịch mới”</li>
                            <li>Đặt mục tiêu và ngân sách cho chiến dịch</li>
                            <li>Sử dụng công cụ Khám phá nhà sáng tạo nội dung để tìm influencer phù hợp</li>
                            <li>Xem lại và khởi chạy chiến dịch</li>
                        </ol>
                        <p style="margin-top: 10px;">Xem chi tiết trong <a href="#" style="color: var(--primary);">Hướng dẫn thiết lập chiến dịch</a>.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Hệ thống phát hiện gian lận có chính xác không?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Hệ thống phát hiện gian lận của chúng tôi sử dụng AI nâng cao để phân tích nhiều tín hiệu như:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>Mô hình tăng trưởng người theo dõi</li>
                            <li>Tính nhất quán của tỷ lệ tương tác</li>
                            <li>Tính xác thực của bình luận</li>
                            <li>Phân bố nhân khẩu học của khán giả</li>
                        </ul>
                        <p style="margin-top: 10px;">Hệ thống đạt độ chính xác 95% trong việc phát hiện người theo dõi giả và tương tác ảo.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Tôi có thể xuất dữ liệu sang Excel hoặc CSV không?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Có! Bạn có thể xuất dữ liệu theo nhiều định dạng:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>CSV để phân tích dữ liệu thô</li>
                            <li>Excel (XLSX) cho báo cáo định dạng sẵn</li>
                            <li>PDF cho báo cáo trình bày chuyên nghiệp</li>
                        </ul>
                        <p style="margin-top: 10px;">Chỉ cần nhấn nút “Xuất” trên bảng dữ liệu hoặc trang báo cáo và chọn định dạng mong muốn.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Làm sao để nâng cấp hoặc hạ cấp gói dịch vụ?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Bạn có thể thay đổi gói dịch vụ bất kỳ lúc nào trong phần Cài đặt tài khoản:</p>
                        <ol style="margin-left: 20px; margin-top: 10px;">
                            <li>Vào Cài đặt → Thanh toán</li>
                            <li>Nhấn “Thay đổi gói”</li>
                            <li>Chọn gói mới của bạn</li>
                            <li>Xác nhận thay đổi</li>
                        </ol>
                        <p style="margin-top: 10px;">Nâng cấp có hiệu lực ngay lập tức. Hạ cấp sẽ áp dụng từ chu kỳ thanh toán tiếp theo. Tín dụng chưa dùng sẽ được tính theo tỷ lệ tương ứng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Tutorials -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-4">Video hướng dẫn</h2>
            <p class="text-center mb-4" style="color: var(--gray-light);">
                Học cách sử dụng OneUp nhà sáng tạo nội dung Analytics qua các video hướng dẫn chi tiết
            </p>
            
            <div class="video-grid">
                <div class="video-card fade-in">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Tổng quan nền tảng</div>
                        <div class="video-duration">5 phút • Cơ bản</div>
                    </div>
                </div>
                
                <div class="video-card fade-in" style="animation-delay: 0.1s;">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Thiết lập chiến dịch đầu tiên</div>
                        <div class="video-duration">8 phút • Cơ bản</div>
                    </div>
                </div>
                
                <div class="video-card fade-in" style="animation-delay: 0.2s;">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Tính năng phân tích nâng cao</div>
                        <div class="video-duration">12 phút • Nâng cao</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <h2 class="text-center color-dark-blue mb-3">Vẫn cần hỗ trợ thêm?</h2>
            <p class="text-center mb-4" style="color: var(--gray-600);">
                Đội ngũ hỗ trợ của chúng tôi luôn sẵn sàng giúp bạn
            </p>
            
            <div class="contact-cards">
                <div class="contact-card fade-in">
                    <div class="contact-icon">💬</div>
                    <h3>Trò chuyện trực tuyến</h3>
                    <p style="color: var(--gray-600); margin: 1rem 0;">
                        Trao đổi trực tiếp với đội ngũ hỗ trợ
                    </p>
                    <p style="color: var(--success); font-weight: 600; margin-bottom: 1rem;">
                        Hoạt động Thứ 2 - Thứ 6, 9:00 - 18:00 (GMT+7)
                    </p>
                    <button class="btn btn-primary">Bắt đầu trò chuyện</button>
                </div>
                
                <div class="contact-card fade-in" style="animation-delay: 0.1s;">
                    <div class="contact-icon">✉️</div>
                    <h3>Hỗ trợ qua Email</h3>
                    <p style="color: var(--gray-600); margin: 1rem 0;">
                        Gửi cho chúng tôi tin nhắn chi tiết
                    </p>
                    <p style="font-weight: 600; margin-bottom: 1rem;color: var(--gray-500);">
                        contact@oneup.vn
                    </p>
                    <button class="btn btn-outline">Gửi Email</button>
                </div>
                
                <div class="contact-card fade-in" style="animation-delay: 0.2s;">
                    <div class="contact-icon">📞</div>
                    <h3>Hỗ trợ qua điện thoại</h3>
                    <p style="color: var(--gray-600); margin: 1rem 0;">
                        Nói chuyện trực tiếp với đội ngũ của chúng tôi
                    </p>
                    <p style="font-weight: 600; margin-bottom: 1rem;color: var(--gray-500);">
                        +84 28 1234 5678
                    </p>
                    <button class="btn btn-outline">Gọi ngay</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    {{-- <section class="section">
        <div class="container">
            <div class="quick-links">
                <h3 class="mb-3 color-dark-blue">Liên kết nhanh</h3>
                <div class="quick-links-grid">
                    <a href="{{ route('resources') }}" class="quick-link">
                        <span>📚</span> Tài liệu
                    </a>
                    <a href="#" class="quick-link">
                        <span>🔧</span> Tham chiếu API
                    </a>
                    <a href="#" class="quick-link">
                        <span>📝</span> Ghi chú phát hành
                    </a>
                    <a href="#" class="quick-link">
                        <span>🔒</span> Bảo mật & Quyền riêng tư
                    </a>
                    <a href="#" class="quick-link">
                        <span>💡</span> Đề xuất tính năng
                    </a>
                    <a href="#" class="quick-link">
                        <span>🐛</span> Báo lỗi
                    </a>
                    <a href="#" class="quick-link">
                        <span>📊</span> Trạng thái hệ thống
                    </a>
                    <a href="#" class="quick-link">
                        <span>👥</span> Diễn đàn cộng đồng
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
@endsection


@section('js')
    <script>
        // Toggle FAQ
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            
            // Close other FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('active');
                }
            });
            
            // Toggle current FAQ
            faqItem.classList.toggle('active');
        }
        
        // Search function
        function performSearch() {
            const query = document.getElementById('searchInput').value;
            if (query) {
                alert(`Searching for: ${query}\nThis would typically redirect to search results.`);
            }
        }
        
        // Handle Enter key in search
        document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        // Show category
        function showCategory(category) {
            alert(`Navigating to ${category} category...`);
        }
    </script>
@endsection
