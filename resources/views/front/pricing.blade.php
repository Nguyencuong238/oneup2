@extends('layouts.front')

@section('meta')
    <title>Bảng giá - OneUp KOL Analytics</title>
    <meta name="description"
        content="Bảng giá OneUp Analytics - Chọn gói hoàn hảo cho nhu cầu tiếp thị người ảnh hưởng trên TikTok của bạn">
@endsection

@section('css')
    <style>
        /* Additional styles for pricing page */
        .pricing-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background: #E0E0E0;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle-switch.active {
            background: var(--gradient);
        }

        .toggle-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(30px);
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3rem;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        }

        .comparison-table th,
        .comparison-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #E0E0E0;
            color: var(--dark-blue);
        }

        .comparison-table th {
            background: #F8F9FA;
            font-weight: 600;
        }

        .comparison-table tr:hover {
            background: #F8F9FA;
        }

        .check-icon {
            color: var(--success);
            font-size: 20px;
        }

        .x-icon {
            color: #CCC;
            font-size: 20px;
        }

        .faq-item {
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            background: white;
        }

        .faq-question {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .faq-question:hover {
            background: #F8F9FA;
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            color: var(--gray-light);
            line-height: 1.8;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 0 1.5rem 1.5rem;
        }

        .faq-answer p {
            color: var(--gray-700)
        }

        .faq-icon {
            transition: transform 0.3s;
            color: var(--gray-light);
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        

        .filter-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        textarea.filter-input {
            resize: vertical;
            font-family: inherit;
        }

        .pricing-name {
            color: var(--gray-100);
        }

        .pricing-features li {
            color: var(--gray-400)
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 60px;">
        <div class="container">
            <div class="text-center">
                <div class="badge badge-success mb-3 fade-in">💰 Tiết kiệm 20% với gói trả theo năm</div>
                <h1 class="mb-3 color-dark-blue fade-in">
                    Bảng giá <span class="gradient-text">Đơn giản & Minh bạch</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Chọn gói phù hợp nhất cho nhu cầu marketing nhà sáng tạo nội dung TikTok của bạn
                </p>

                <!-- Pricing Toggle -->
                <div class="pricing-toggle fade-in">
                    <span class="color-dark-blue">Theo tháng</span>
                    <div class="toggle-switch" id="billingToggle">
                        <div class="toggle-slider"></div>
                    </div>
                    <span class="color-dark-blue">Theo năm <span class="badge badge-success">-20%</span></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="pricing-container">
                <!-- Starter Plan -->
                <div class="pricing-card fade-in">
                    <div class="pricing-header">
                        <h3 class="pricing-name">Starter</h3>
                        <div class="pricing-price">
                            <span class="monthly-price">0₫</span>
                            <span class="annual-price" style="display: none;">0₫</span>
                        </div>
                        <div class="pricing-period">mỗi tháng</div>
                    </div>
                    <ul class="pricing-features">
                        <li>Tối đa 100 lượt tìm kiếm nhà sáng tạo nội dung/tháng</li>
                        <li>Bảng phân tích cơ bản</li>
                        <li>5 chiến dịch hoạt động</li>
                        <li>Hỗ trợ qua email</li>
                    </ul>
                    <a href="{{ route('register', ['plan' => 'starter']) }}" class="btn btn-outline btn-large"
                        style="width: 100%;">
                        Dùng thử miễn phí
                    </a>
                </div>

                <!-- Professional Plan -->
                <div class="pricing-card featured fade-in" style="animation-delay: 0.1s;">
                    <div class="pricing-header">
                        <h3 class="pricing-name">Professional</h3>
                        <div class="pricing-price">
                            <span class="monthly-price">0₫</span>
                            <span class="annual-price" style="display: none;">0₫</span>
                        </div>
                        <div class="pricing-period">mỗi tháng</div>
                    </div>
                    <ul class="pricing-features">
                        <li>Tìm kiếm nhà sáng tạo nội dung không giới hạn</li>
                        <li>Phân tích nâng cao & gợi ý từ AI</li>
                        <li>20 chiến dịch hoạt động</li>
                        <li>Hỗ trợ ưu tiên</li>
                    </ul>
                    <a href="{{ route('register', ['plan' => 'professional']) }}" class="btn btn-primary btn-large"
                        style="width: 100%;">
                        Dùng thử miễn phí
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card fade-in" style="animation-delay: 0.2s;">
                    <div class="pricing-header">
                        <h3 class="pricing-name">Enterprise</h3>
                        <div class="pricing-price">Tùy chỉnh</div>
                        <div class="pricing-period">theo nhu cầu của bạn</div>
                    </div>
                    <ul class="pricing-features">
                        <li>Tất cả tính năng trong Professional</li>
                        <li>Chiến dịch không giới hạn</li>
                        <li>Quản lý tài khoản riêng</li>
                        <li>Tích hợp tùy chỉnh</li>
                    </ul>
                    <button class="btn btn-secondary btn-large" style="width: 100%;" onclick="openContactModal()">
                        Liên hệ tư vấn
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Comparison -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="text-center color-dark-blue mb-4">So sánh chi tiết các gói</h2>

            <div style="overflow-x: auto;">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Tính năng</th>
                            <th>Starter</th>
                            <th>Professional</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Khám phá nhà sáng tạo nội dung</td>
                        </tr>
                        <tr>
                            <td>Tìm kiếm Nhà sáng tạo nội dung</td>
                            <td>100/tháng</td>
                            <td>Không giới hạn</td>
                            <td>Không giới hạn</td>
                        </tr>
                        <tr>
                            <td>Bộ lọc nâng cao</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Gợi ý từ AI</td>
                            <td>✕</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Phân tích dữ liệu</td>
                        </tr>
                        <tr>
                            <td>Chỉ số cơ bản</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td>Nhân khẩu học khán giả</td>
                            <td>Cơ bản</td>
                            <td>Nâng cao</td>
                            <td>Nâng cao</td>
                        </tr>
                        {{-- <tr>
                            <td>Phát hiện gian lận</td>
                            <td>✕</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr> --}}
                        <tr>
                            <td>Phân tích đối thủ</td>
                            <td>✕</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Quản lý chiến dịch</td>
                        </tr>
                        <tr>
                            <td>Chiến dịch hoạt động</td>
                            <td>5</td>
                            <td>20</td>
                            <td>Không giới hạn</td>
                        </tr>
                        <tr>
                            <td>Theo dõi theo thời gian thực</td>
                            <td>✓</td>
                            <td>✓</td>
                            <td>✓</td>
                        </tr>
                        {{-- <tr>
                            <td>Tính toán ROI</td>
                            <td>Cơ bản</td>
                            <td>Nâng cao</td>
                            <td>Tùy chỉnh</td>
                        </tr> --}}
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Hỗ trợ & Dịch vụ</td>
                        </tr>
                        <tr>
                            <td>Hỗ trợ kỹ thuật</td>
                            <td>Email</td>
                            <td>Email & Chat ưu tiên</td>
                            <td>24/7 - Quản lý riêng</td>
                        </tr>
                        {{-- <tr>
                            <td>Đào tạo sử dụng</td>
                            <td>Tự học</td>
                            <td>Webinar</td>
                            <td>Hướng dẫn tùy chỉnh</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-4">Câu hỏi thường gặp</h2>

            <div style="max-width: 800px; margin: 0 auto;">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>ONEUP.VN là gì?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Nền tảng kết nối thông minh giữa thương hiệu và KOL/KOC/Creator, giúp triển khai – đo lường – tối ưu chiến dịch hiệu quả.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>ONEUP khác gì so với nền tảng khác?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>ONEUP dựa trên dữ liệu real-time, quy trình minh bạch và hỗ trợ phát triển Creator bền vững, không chỉ là nền tảng booking.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Thương hiệu sử dụng ONEUP thế nào?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Gửi brief → ONEUP đề xuất KOL → ký hợp đồng → đăng tải → theo dõi KPI → nhận báo cáo & thanh toán minh bạch.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Creator tham gia bằng cách nào?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Đăng ký hồ sơ trên website, xét duyệt – đào tạo – nhận job – được xếp hạng theo hiệu suất (Rookie → Elite).</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>ONEUP có bản dùng thử không?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Oneup có bản dùng thử. Brand có thể trải nghiệm bản dùng thử miễn phí để khám phá dashboard, dữ liệu KOL/KOC và quy trình quản lý chiến dịch trước khi nâng cấp.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container text-center">
            <h2 class="mb-3 color-dark-blue">Sẵn sàng bắt đầu ngay?</h2>
            <p class="mb-4 color-gray-600" style="font-size: 18px;">
                Hơn 500+ thương hiệu đã tối ưu chiến dịch nhà sáng tạo nội dung TikTok của họ cùng chúng tôi
            </p>
            <div class="d-flex gap-2 justify-center">
                @auth
                    <a href="{{ auth()->user()->type == 'brand' ? route('brand.dashboard') : route('creator.dashboard') }}" class="btn" style="background: #0066FF; color:white;">
                        Bảng điều khiển
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-small">
                        Đăng ký
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline btn-small">
                        Đăng nhập
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Contact Modal -->
    <div id="contactModal" class="modal">
        <div class="modal-overlay" onclick="closeContactModal()"></div>
        <div class="modal-content">
            <button class="modal-close" onclick="closeContactModal()">×</button>
            <h3 class="mb-3 color-dark-blue">Liên hệ đội ngũ kinh doanh</h3>
            <form id="contactForm">

                <div class="mb-3">
                    <input type="text" name="name" id="name" class="filter-input" placeholder="Tên của bạn" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" id="email" class="filter-input" placeholder="Địa chỉ email" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="company" id="company" class="filter-input" placeholder="Tên công ty">
                </div>
                <div class="mb-3">
                    <textarea class="filter-input" name="message" id="message" rows="4" placeholder="Mô tả nhu cầu của bạn"></textarea>
                </div>
                <button type="submit" class="btn btn-primary justify-center" style="width: 100%;">Gửi tin nhắn</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Billing Toggle
            $('#billingToggle').on('click', function() {
                $(this).toggleClass('active');

                if ($(this).hasClass('active')) {
                    $('.monthly-price').hide();
                    $('.annual-price').show();
                } else {
                    $('.monthly-price').show();
                    $('.annual-price').hide();
                }
            });

            // FAQ Toggle
            window.toggleFAQ = function(element) {
                const $faqItem = $(element).parent();

                // Close other FAQs
                $('.faq-item').not($faqItem).removeClass('active');

                // Toggle current FAQ
                $faqItem.toggleClass('active');
            };

            // Modal Functions
            window.openContactModal = function() {
                $('#contactModal').addClass('active');
                $('body').css('overflow', 'hidden');
            };

            window.closeContactModal = function() {
                $('#contactModal').removeClass('active');
                $('body').css('overflow', '');
            };

            // Close modal on ESC key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeContactModal();
                }
            });
        });
    </script>

    <script>
        $(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                $(this).find('button').prop('disabled', true);

                var data = {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    company: $('#company').val(),
                    message: $('#message').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    type: 'post',
                    url: "{{ route('newsletters') }}",
                    data: data,
                }).then(function(res) {

                    if (res.success) {
                        toastr.success(res.msg);
                        $('#contactForm')[0].reset();
                    } else {
                        toastr.error(res.msg);
                    }


                });
                $(this).find('button').prop('disabled', false);
            });
        });
    </script>
@endsection
