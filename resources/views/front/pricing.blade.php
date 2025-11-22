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

        /* Tab Navigation Styles */
        .pricing-tabs-nav {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            overflow-x: auto;
            padding-bottom: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pricing-tab-btn {
            padding: 12px 24px;
            background: white;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            color: var(--dark-blue);
            white-space: nowrap;
        }

        .pricing-tab-btn:hover {
            border-color: var(--primary);
            background: #F8F9FA;
        }

        .pricing-tab-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Tab Content Styles */
        .pricing-tab-content {
            display: none;
            animation: fadeIn 0.3s;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .pricing-tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pricing Table Styles */
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        .pricing-table th,
        .pricing-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #E0E0E0;
            color: var(--dark-blue);
        }

        .pricing-table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            text-align: center;
        }

        .pricing-table thead .price {
            font-size: 20px;
            font-weight: 700;
            display: block;
            margin-top: 5px;
        }

        .pricing-table tbody tr:nth-child(even) {
            background: #F8F9FA;
        }

        .pricing-table tbody tr:hover {
            background: #F0F0F0;
        }

        .pricing-table tbody td:first-child {
            font-weight: 600;
            background: #F8F9FA;
        }

        /* Services Grid Styles */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .service-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.12);
        }

        .service-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--primary);
        }

        .service-content {
            color: #4a4a4a;
            line-height: 1.8;
        }

        .service-content strong {
            color: #1a1a2e;
        }

        /* Two Column Layout for Tab 3 */
        .two-column-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .pricing-tabs-nav {
                flex-direction: column;
            }

            .pricing-tab-btn {
                width: 100%;
            }

            .pricing-tab-content {
                padding: 20px;
            }

            .pricing-table {
                font-size: 14px;
            }

            .pricing-table th,
            .pricing-table td {
                padding: 10px;
            }

            .two-column-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* Contact Modal Styles */
        .contact-modal-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .contact-modal-form .form-row-modal {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .contact-modal-form .form-group-modal {
            margin-bottom: 20px;
        }

        .contact-modal-form label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .contact-modal-form label .required {
            color: #e74c3c;
        }

        .contact-modal-form .form-control-modal {
            width: 100%;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .contact-modal-form .form-control-modal:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .contact-modal-form .form-control-modal::placeholder {
            color: #aaa;
        }

        .contact-modal-form textarea.form-control-modal {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .contact-modal-form .form-message-modal {
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            display: none;
        }

        .contact-modal-form .form-message-modal.show {
            display: block;
        }

        .contact-modal-form .form-message-modal .contact_success {
            color: #27ae60;
            font-weight: 500;
        }

        .contact-modal-form .form-message-modal .contact_error {
            color: #e74c3c;
            font-weight: 500;
        }

        .contact-modal-form .btn-submit-modal {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .contact-modal-form .btn-submit-modal:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .contact-modal-form .btn-submit-modal:active {
            transform: translateY(0);
        }

        .contact-modal-form .btn-submit-modal:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .contact-modal-form .privacy-notice-modal {
            text-align: center;
            font-size: 13px;
            color: #666;
            margin-top: 20px;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .contact-modal-title {
                font-size: 22px;
                margin-bottom: 20px;
            }

            .contact-modal-form .form-row-modal {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .contact-modal-form .btn-submit-modal {
                padding: 15px;
                font-size: 15px;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 60px;">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 color-dark-blue fade-in">
                    Bảng Giá Dịch Vụ <span class="gradient-text">ONEUP.VN</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Chọn gói dịch vụ phù hợp với nhu cầu của bạn
                </p>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <section class="section" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 600px;">
        <div class="container" style="max-width: unset;">
            <div class="pricing-tabs-nav">
                <button class="pricing-tab-btn active" data-tab="tab1">Dịch vụ Website</button>
                <button class="pricing-tab-btn" data-tab="tab2">Booking KOLs - Nhà hàng</button>
                <button class="pricing-tab-btn" data-tab="tab3">Booking KOLs - Sản phẩm</button>
                <button class="pricing-tab-btn" data-tab="tab4">Hợp tác KOL/KOC</button>
                <button class="pricing-tab-btn" data-tab="tab5">Dịch vụ khác</button>
            </div>

            <!-- Tab 1: Dịch vụ phân tích và đăng ký chiến dịch -->
            <div class="pricing-tab-content active" id="tab1">
                <h2 class="text-center mb-4" style="color: #1a1a2e; font-weight: 700; margin-bottom: 30px;">Giá gói dịch vụ phân tích và đăng ký chiến dịch trên website ONEUP.VN</h2>
                <div style="overflow-x: auto;">
                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th>Quyền lợi</th>
                                <th>Gói cơ bản<br><span class="price">99.000/ tháng</span><br><small>Trải nghiệm 1 tháng miễn phí</small></th>
                                <th>Gói phổ biến<br><span class="price">199.000/ tháng</span></th>
                                <th>Gói nâng cao<br><span class="price">319.000/ tháng</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Giá</td><td>99.000</td><td>199.000</td><td>319.000</td></tr>
                            <tr><td>Phạm vi thời gian xem dữ liệu</td><td>28 ngày</td><td>90 ngày</td><td>không giới hạn</td></tr>
                            <tr><td>Xuất dữ liệu</td><td>không</td><td>không</td><td>150 lượt/ tháng, 3000 kg đầu</td></tr>
                            <tr><td>Số lượt tạo chiến dịch</td><td>5 chiến dịch/ tháng</td><td>15 chiến dịch/ tháng</td><td>không giới hạn</td></tr>
                            <tr><td>Xem thông tin liên hệ nhà sáng tạo</td><td>không</td><td>250 lần/ ngày</td><td>250 lần/ ngày</td></tr>
                            <tr><td>Dữ liệu thị trường</td><td>không</td><td>chỉ hôm qua</td><td>7 ngày trước</td></tr>
                            <tr><td>Xuất thông tin liên hệ nhà sáng tạo</td><td>không</td><td>không</td><td>2 lượt/ ngày, 3000 kg/lượt</td></tr>
                            <tr><td>Số lượt tìm kiếm</td><td>100 lần/ ngày</td><td>250 lần/ ngày</td><td>500 lần/ ngày</td></tr>
                            <tr><td>xem dữ liệu Kết quả tìm kiếm</td><td>Top 200</td><td>Top 1000</td><td>không giới hạn</td></tr>
                            <tr><td>số lượt xem trang chi tiết</td><td>100 lần/ ngày</td><td>100 lần/ ngày</td><td>không giới hạn</td></tr>
                            <tr><td>xem dữ liệu xếp hạng</td><td>Top 100</td><td>Top 300</td><td>không giới hạn</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 2: Booking KOLs - Nhà hàng/địa điểm -->
            <div class="pricing-tab-content" id="tab2">
                <h2 class="text-center mb-4" style="color: #1a1a2e; font-weight: 700; margin-bottom: 30px;">Giá gói dịch vụ BOOKING KOLS<br><small>(review nhà hàng/ địa điểm ăn uống)</small><br><small style="font-size: 14px;">(Giá chưa bao gồm VAT & 10% phí quản lý)</small></h2>
                <div style="overflow-x: auto;">
                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th>Quyền lợi</th>
                                <th>Gói Basic<br><span class="price">10.000.000</span></th>
                                <th>Gói Popular<br><span class="price">25.000.000</span></th>
                                <th>Gói Premium<br><span class="price">30.000.000</span></th>
                                <th>Tư Vấn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>GIÁ</td><td>10.000.000</td><td>25.000.000</td><td>30.000.000</td><td>Tư vấn thêm</td></tr>
                            <tr><td>Số lượng kols (1 video/kols)</td><td>5</td><td>5</td><td>7</td><td rowspan="8">Tư vấn túy theo nhu cầu của khách hàng.</td></tr>
                            <tr><td>Mức follower kols</td><td>10-50k</td><td>50-100k</td><td>50-300k</td></tr>
                            <tr><td>Độ dài video</td><td>30-60s</td><td>60-90s</td><td>60-90s</td></tr>
                            <tr><td>Dạng video</td><td>Hình ảnh/ nhạc/ voice</td><td>Hình ảnh/ nhạc/ voice</td><td>Hình ảnh/ nhạc/ voice</td></tr>
                            <tr><td>Nền tảng được đăng lại</td><td>Tiktok/ FB/ Instagram</td><td>Tiktok/ FB/ Instagram</td><td>Tiktok/ FB/ Instagram</td></tr>
                            <tr><td>SDHA (1 tháng)</td><td>Không</td><td>Có</td><td>Có</td></tr>
                            <tr><td>Demo & feedback chỉnh sửa</td><td>2 lần</td><td>2 lần</td><td>2 lần</td></tr>
                            <tr><td>Air video</td><td>Không giới hạn ngày giờ</td><td>Không giới hạn ngày giờ</td><td>Không giới hạn ngày giờ</td></tr>
                            <tr><td colspan="5" style="background: #F0F0F0; font-weight: 600; padding: 15px;">GÓI TĂNG KÈM</td></tr>
                            <tr><td>Hỗ trợ hình ảnh social fanpage cho brand</td><td>5</td><td>5</td><td>7</td><td rowspan="4"></td></tr>
                            <tr><td>Hỗ trợ bài viết trên nhóm cộng đồng</td><td>Không</td><td>Có</td><td>Có</td></tr>
                            <tr><td>Bó hình ảnh</td><td>Có (10 tấm)</td><td>Có (20 tấm)</td><td>Có (30 tấm)</td></tr>
                            <tr><td>Brand hashtag/ địa điểm</td><td>Có</td><td>Có</td><td>Có</td></tr>
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 20px; padding: 15px; background: #FFF5F7; border-radius: 8px;">
                    <p style="font-weight: 600; margin-bottom: 10px; color: #1a1a2e;">*Hỗ trợ BOOST ADS tăng hiển thị và tăng độ phủ với phí dịch vụ HẤP DẪN.</p>
                    <p style="color: #4a4a4a; font-size: 15px;">(nhận tư vấn, set up và báo cáo số liệu dựa trên ngân sách của khách hàng)</p>
                </div>
            </div>

            <!-- Tab 3: Booking KOLs - Sản phẩm -->
            <div class="pricing-tab-content" id="tab3">
                <h2 class="text-center mb-4" style="color: #1a1a2e; font-weight: 700; margin-bottom: 30px;">Giá gói dịch vụ BOOKING KOLS<br><small>(review sản phẩm)</small><br><small style="font-size: 14px;">(Giá chưa bao gồm VAT)</small></h2>
                <div style="overflow-x: auto;">
                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th>Quyền lợi</th>
                                <th>Gói Basic<br><span class="price">3.000.000</span></th>
                                <th>Gói Popular<br><span class="price">4.500.000</span></th>
                                <th>Gói Premium<br><span class="price">7.000.000</span></th>
                                <th>Tư Vấn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>GIÁ</td><td>3.000.000</td><td>4.500.000</td><td>7.000.000</td><td>Tư vấn thêm</td></tr>
                            <tr><td>Số lượng koc</td><td>30</td><td>50</td><td>100</td><td rowspan="3">Tư vấn túy theo nhu cầu của khách hàng.</td></tr>
                            <tr><td>Độ dài video</td><td>30-45s</td><td>30-60s</td><td>30-60s</td></tr>
                            <tr><td>Dạng video</td><td>Video ngắn</td><td>Video ngắn</td><td>Video ngắn</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="two-column-layout">
                    <!-- Left Column -->
                    <div style="border-left: 3px solid #667eea; padding-left: 20px;">
                        <div style="margin-bottom: 30px;">
                            <h3 style="font-weight: 700; margin-bottom: 15px; color: #1a1a2e; font-size: 18px;">Áp dụng</h3>
                            <ul style="list-style: disc; margin-left: 20px; line-height: 2; color: #4a4a4a;">
                                <li>Khác có mục tiêu giai đoạn rõ ràng và có thể đo lường.</li>
                                <li>Khách có ngân sách rõ ràng và KPI tương ứng</li>
                                <li>Khách cần marketing tích hợp ở cấp độ thương hiệu</li>
                                <li>Khách có nhu cầu tạo ra sản phẩm bán chạy.</li>
                            </ul>
                        </div>

                        <div style="margin-bottom: 30px;">
                            <h3 style="font-weight: 700; margin-bottom: 15px; color: #1a1a2e; font-size: 18px;">Hình thức</h3>
                            <ul style="list-style: disc; margin-left: 20px; line-height: 2; color: #4a4a4a;">
                                <li>Khách cung cấp: Ngân sách, KPI</li>
                                <li>Oneup cung cấp: Phương án chạy doanh số</li>
                                <li>Confirm phương án, bắt đầu tiền hành.</li>
                            </ul>
                        </div>

                        <div>
                            <h3 style="font-weight: 700; margin-bottom: 15px; color: #1a1a2e; font-size: 18px;">Ghi chú</h3>
                            <ul style="list-style: disc; margin-left: 20px; line-height: 2; color: #4a4a4a;">
                                <li>KPI không cam kết GMV</li>
                                <li>kol/koc liên quan đến kế hoạch trong gói này brand không được lựa chọn.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div style="background: #1a1a2e; color: white; padding: 30px; border-radius: 8px; margin-bottom: 20px;">
                            <h3 style="font-weight: 700; margin-bottom: 15px; font-size: 20px;">*CAM KẾT:</h3>
                            <ol style="margin-left: 20px; line-height: 2; color: white; font-size: 15px;">
                                <li>Gắn link vĩnh viễn trên kênh.</li>
                                <li>Chuẩn kịch bản chuyển đổi</li>
                                <li>Video sắc nét, âm thanh rõ ràng</li>
                                <li>Chuẩn ngành hàng, chuẩn tệp khách</li>
                            </ol>
                        </div>

                        <div style="background: #1a1a2e; color: white; padding: 30px; border-radius: 8px;">
                            <p style="font-weight: 700; margin-bottom: 15px; font-size: 16px;">*Hỗ trợ BOOST ADS tăng hiển thị và tăng độ phủ với phí dịch vụ HẤP DẪN.</p>
                            <p style="font-size: 14px; line-height: 1.8;">(nhận tư vấn, set up và báo cáo số liệu dựa trên ngân sách của khách hàng)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 4: Hợp tác KOL/KOC -->
            <div class="pricing-tab-content" id="tab4">
                <h2 class="text-center mb-4" style="color: #1a1a2e; font-weight: 700; margin-bottom: 30px;">Hợp tác KOL/KOC<br><small>(booking kol lẻ)</small></h2>
                <div style="overflow-x: auto;">
                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th>Nhóm creator</th>
                                <th>Phân loại</th>
                                <th>Follower</th>
                                <th>Video</th>
                                <th>Đơn giá</th>
                                <th>Hoa hồng</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">KOL REVIEW/<br>KOC<br>BÁN HÀNG</td>
                                <td>NANO</td>
                                <td>1K-10K</td>
                                <td>Video</td>
                                <td>2tr</td>
                                <td rowspan="5">• Phí quản lý +10%</td>
                                <td rowspan="5">Đối với các brand chưa có kế hoạch cụ thể, booking lẻ.<br><br>Để có báo giá chính xác, brand cần cung cấp:<br>• Brief chi tiết<br>• Thời gian chạy dự kiến</td>
                            </tr>
                            <tr>
                                <td>MICRO</td>
                                <td>10K-100K</td>
                                <td>Video</td>
                                <td>từ 4tr</td>
                            </tr>
                            <tr>
                                <td>MIDDLE</td>
                                <td>100K-500K</td>
                                <td>Video</td>
                                <td>từ 6tr</td>
                            </tr>
                            <tr>
                                <td>MACRO</td>
                                <td>500K-1M</td>
                                <td>Video</td>
                                <td>từ 8-10tr</td>
                            </tr>
                            <tr>
                                <td>MEGA</td>
                                <td>1M</td>
                                <td>Video</td>
                                <td>trên 15tr</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 5: Dịch vụ khác -->
            <div class="pricing-tab-content" id="tab5">
                <h2 class="text-center mb-4" style="color: #1a1a2e; font-weight: 700; margin-bottom: 30px;">Dịch vụ khác</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <h3 class="service-title">Quảng cáo</h3>
                        <div class="service-content">
                            <p style="font-weight: 600; margin-bottom: 15px; color: #1a1a2e;">*Hỗ trợ BOOST ADS tăng hiển thị và tăng độ phủ với phí dịch vụ HẤP DẪN.</p>
                            <p style="color: #4a4a4a; font-size: 15px;">(nhận tư vấn, set up và báo cáo số liệu dựa trên ngân sách của khách hàng)</p>
                        </div>
                    </div>
                    <div class="service-card">
                        <h3 class="service-title">Vận hành</h3>
                        <div class="service-content">
                            <ul style="list-style: disc; margin-left: 20px; line-height: 1.8; color: #1a1a2e;">
                                <li>Xây kênh mới (nếu brand chưa có trang)</li>
                                <li>Vận hành: thiết kế hình ảnh, nội dung, set lịch lịch đăng,...</li>
                            </ul>
                            <p style="margin-top: 15px; color: #4a4a4a; font-size: 15px;">(nhận tư vấn, lên chương trình khuyến mãi, nội dung & báo cáo số liệu dựa trên gói khách chọn lựa)</p>
                            <div style="margin-top: 20px; padding: 15px; background: #F0F0F0; border-radius: 8px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding: 5px; color: #1a1a2e;"><strong>Quản lý 1-2 kênh Tiktok/ Facebook</strong><br><span style="color: #4a4a4a;">12-15 bài/tháng<br>Đăng bài & báo cáo cơ bản</span></td>
                                        <td style="padding: 5px; text-align: right; color: #1a1a2e;"><strong>Từ 8.000.000đ/tháng</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div style="margin-top: 10px; padding: 15px; background: #F0F0F0; border-radius: 8px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding: 5px; color: #1a1a2e;"><strong>Quản lý 2 kênh / nội dung thương xuyên</strong><br><span style="color: #4a4a4a;">12-15 bài/tháng<br>Content plan, chi tiết, tối ưu SEO<br>Báo cáo chuyên sâu theo KPI</span></td>
                                        <td style="padding: 5px; text-align: right; color: #1a1a2e;"><strong>Từ 20.000.000đ/tháng</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div style="margin-top: 10px; padding: 15px; background: #F0F0F0; border-radius: 8px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding: 5px; color: #1a1a2e;"><strong>Quản lý 2-3 kênh đa nền tảng chuyên nghiệp</strong><br><span style="color: #4a4a4a;">20+ bài/tháng + hỗ trợ chạy ads<br>Quản lý tương tác, insight, content calendar<br>Báo cáo chuyên sâu & KPI tăng trưởng</span></td>
                                        <td style="padding: 5px; text-align: right; color: #1a1a2e;"><strong>Từ 35.000.000+/tháng</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div style="margin-top: 30px; text-align: center;">
                <button class="btn btn-primary btn-large" onclick="openContactModal()">TƯ VẤN THÊM</button>
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
        <div class="modal-content" style="max-width: 700px;">
            <button class="modal-close" onclick="closeContactModal()">×</button>
            <h3 class="contact-modal-title">NHẬN TƯ VẤN NGAY</h3>
            <form id="contactForm" class="contact-modal-form">
                @csrf
                <div class="form-row-modal">
                    <div class="form-group-modal">
                        <label for="contact_name">Họ & Tên</label>
                        <input type="text"
                               id="contact_name"
                               name="name"
                               class="form-control-modal"
                               placeholder="Họ & Tên"
                               required>
                    </div>
                    <div class="form-group-modal">
                        <label for="contact_phone">Số điện thoại</label>
                        <input type="tel"
                               id="contact_phone"
                               name="phone"
                               class="form-control-modal"
                               placeholder="Số điện thoại"
                               required>
                    </div>
                </div>

                <div class="form-group-modal">
                    <label for="contact_email">Email <span class="required">*</span></label>
                    <input type="email"
                           id="contact_email"
                           name="email"
                           class="form-control-modal"
                           placeholder="Nhập email của bạn"
                           required>
                </div>

                <div class="form-group-modal">
                    <label for="contact_message">Lời nhắn</label>
                    <textarea id="contact_message"
                              name="message"
                              class="form-control-modal"
                              rows="4"
                              placeholder="Lời nhắn"></textarea>
                </div>

                <div class="form-message-modal" id="contactFormMessage"></div>

                <button type="submit" class="btn-submit-modal">GỬI YÊU CẦU</button>

                <p class="privacy-notice-modal">* Mọi thông tin của bạn đều được cam kết bảo mật</p>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Tab Switching
            $('.pricing-tab-btn').on('click', function() {
                const tabId = $(this).data('tab');

                // Remove active class from all tabs and content
                $('.pricing-tab-btn').removeClass('active');
                $('.pricing-tab-content').removeClass('active');

                // Add active class to clicked tab and corresponding content
                $(this).addClass('active');
                $('#' + tabId).addClass('active');
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

                const submitBtn = $(this).find('.btn-submit-modal');
                const messageDiv = $('#contactFormMessage');
                const formData = new FormData(this);

                // Disable submit button
                submitBtn.prop('disabled', true);
                submitBtn.text('ĐANG GỬI...');

                // Hide previous messages
                messageDiv.removeClass('show');
                messageDiv.html('');

                fetch('{{ route("contacts.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    messageDiv.html(data.msg);
                    messageDiv.addClass('show');

                    if (data.success) {
                        $('#contactForm')[0].reset();
                        // Scroll to message
                        messageDiv[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }

                    // Re-enable submit button
                    submitBtn.prop('disabled', false);
                    submitBtn.text('GỬI YÊU CẦU');
                })
                .catch(error => {
                    console.error('Error:', error);
                    messageDiv.html('<span class="contact_error">Có lỗi xảy ra. Vui lòng thử lại sau.</span>');
                    messageDiv.addClass('show');

                    // Re-enable submit button
                    submitBtn.prop('disabled', false);
                    submitBtn.text('GỬI YÊU CẦU');
                });
            });
        });
    </script>
@endsection
