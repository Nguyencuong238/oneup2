@extends('layouts.user')

@section('meta')
    <meta name="description" content="Billing & Invoices - OneUp KOL Analytics Dashboard">
    <title>Thanh toán - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Billing Specific Styles */
        body {
            background: #F8F9FA;
            min-height: 100vh;
        }

        .dashboard-layout {
            display: block;
            min-height: 100vh;
        }

        /* Reuse sidebar styles */
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

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .main-content {
            margin-left: 260px;
            padding: 0;
            background: #F8F9FA;
            min-height: 100vh;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 15px;
        }

        /* Content Container */
        .billing-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Current Plan Card */
        .current-plan-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .current-plan-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .plan-info {
            position: relative;
            z-index: 1;
        }

        .plan-label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .plan-name-large {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .plan-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .plan-detail-item {
            display: flex;
            flex-direction: column;
        }

        .plan-detail-label {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 0.25rem;
        }

        .plan-detail-value {
            font-size: 20px;
            font-weight: 600;
        }

        .upgrade-btn {
            background: white;
            color: var(--primary);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 1.5rem;
        }

        .upgrade-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Stats Grid */
        .billing-stats {
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
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            width: 32px;
            height: 32px;
            background: var(--primary-lighter);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .stat-description {
            font-size: 13px;
            color: var(--gray-600);
        }

        .stat-progress {
            margin-top: 1rem;
            height: 8px;
            background: var(--gray-200);
            border-radius: 4px;
            overflow: hidden;
        }

        .stat-progress-fill {
            height: 100%;
            background: var(--gradient-blue);
            border-radius: 4px;
            transition: width 1s ease;
        }

        /* Payment Method */
        .payment-method-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .payment-card {
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .payment-card:hover {
            border-color: var(--primary);
            background: var(--primary-lighter);
        }

        .payment-card.active {
            border-color: var(--primary);
            background: var(--primary-lighter);
        }

        .payment-card.active::after {
            content: '✓';
            position: absolute;
            top: 8px;
            right: 8px;
            width: 20px;
            height: 20px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .card-icon {
            width: 48px;
            height: 32px;
            background: var(--gray-100);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--gray-600);
        }

        .card-details {
            flex: 1;
        }

        .card-type {
            font-size: 14px;
            font-weight: 500;
            color: var(--dark-blue);
        }

        .card-number {
            font-size: 13px;
            color: var(--gray-600);
        }

        .card-expiry {
            font-size: 12px;
            color: var(--gray-500);
        }

        /* Invoices Table */
        .invoices-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .search-input {
            flex: 1;
            max-width: 300px;
            padding: 8px 12px;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 14px;
        }

        .invoices-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoices-table th {
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

        .invoices-table td {
            padding: 16px 12px;
            border-bottom: 1px solid var(--gray-100);
        }

        .invoices-table tr:last-child td {
            border-bottom: none;
        }

        .invoice-id {
            font-family: monospace;
            font-size: 13px;
            color: var(--gray-700);
        }

        .invoice-amount {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-paid {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-failed {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .invoice-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 6px 10px;
            background: transparent;
            border: 1px solid var(--gray-300);
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Usage Chart */
        .usage-chart {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .chart-container {
            height: 200px;
            background: var(--gray-50);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            font-size: 14px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            font-size: 14px;
            display: inline-flex;
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
            border-color: var(--gray-400);
            background: var(--gray-50);
        }

        /* Alert */
        .alert-card {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: start;
            gap: 1rem;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .alert-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: #3B82F6;
        }

        .alert-content {
            flex: 1;
            font-size: 14px;
            color: var(--gray-700);
        }

        /* Pagination */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
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
        }

        @media (max-width: 768px) {
            .billing-stats {
                grid-template-columns: 1fr;
            }

            .plan-details {
                grid-template-columns: 1fr;
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }

            .filter-bar {
                flex-direction: column;
            }

            .search-input {
                max-width: 100%;
            }

            .invoices-table {
                font-size: 12px;
            }

            .invoice-actions {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Thanh toán & Hóa đơn</h1>
            <p class="page-subtitle">Quản lý gói đăng ký, phương thức thanh toán và tải hóa đơn</p>
        </div>

        <!-- Billing Container -->
        <div class="billing-container">
            <!-- Current Plan -->
            <div class="current-plan-card">
                <div class="plan-info">
                    <div class="plan-label">Gói hiện tại</div>
                    <div class="plan-name-large">Gói Chuyên nghiệp</div>

                    <div class="plan-details">
                        <div class="plan-detail-item">
                            <span class="plan-detail-label">Chi phí hàng tháng</span>
                            <span class="plan-detail-value">₫2,500,000</span>
                        </div>
                        <div class="plan-detail-item">
                            <span class="plan-detail-label">Ngày thanh toán kế tiếp</span>
                            <span class="plan-detail-value">15 Tháng 2, 2025</span>
                        </div>
                        <div class="plan-detail-item">
                            <span class="plan-detail-label">Thành viên nhóm</span>
                            <span class="plan-detail-value">3 / 5 chỗ đã dùng</span>
                        </div>
                        <div class="plan-detail-item">
                            <span class="plan-detail-label">Theo dõi KOL</span>
                            <span class="plan-detail-value">Không giới hạn</span>
                        </div>
                    </div>

                    <button class="upgrade-btn">Nâng cấp lên Gói Doanh nghiệp</button>
                </div>
            </div>

            <!-- Usage Stats -->
            <div class="billing-stats">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Lượt gọi API</span>
                        <div class="stat-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">42,853</div>
                    <div class="stat-description">trên tổng 100,000 lượt/tháng</div>
                    <div class="stat-progress">
                        <div class="stat-progress-fill" style="width: 42.8%;"></div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Dung lượng đã dùng</span>
                        <div class="stat-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
                                <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
                                <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">8.4 GB</div>
                    <div class="stat-description">trên tổng 50 GB</div>
                    <div class="stat-progress">
                        <div class="stat-progress-fill" style="width: 16.8%;"></div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Chiến dịch đang hoạt động</span>
                        <div class="stat-icon">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">18</div>
                    <div class="stat-description">Không giới hạn trong gói Pro</div>
                    <div class="stat-progress">
                        <div class="stat-progress-fill" style="width: 100%; background: var(--success);"></div>
                    </div>
                </div>
            </div>

            <!-- Usage Chart -->
            <div class="usage-chart">
                <div class="section-header">
                    <h2 class="section-title">Xu hướng sử dụng</h2>
                    <select class="filter-select">
                        <option>30 ngày gần đây</option>
                        <option>3 tháng gần đây</option>
                        <option>6 tháng gần đây</option>
                        <option>Năm nay</option>
                    </select>
                </div>
                <div class="chart-container">
                    Biểu đồ sử dụng sẽ hiển thị tại đây
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="payment-method-card">
                <div class="section-header">
                    <h2 class="section-title">Phương thức thanh toán</h2>
                    <button class="btn btn-primary">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Thêm phương thức thanh toán
                    </button>
                </div>

                <div class="payment-methods">
                    <div class="payment-card active">
                        <div class="card-icon">VISA</div>
                        <div class="card-details">
                            <div class="card-type">Visa kết thúc bằng 4242</div>
                            <div class="card-number">•••• •••• •••• 4242</div>
                            <div class="card-expiry">Hết hạn 12/2026</div>
                        </div>
                    </div>

                    <div class="payment-card">
                        <div class="card-icon" style="background: #FF5F00; color: white;">MC</div>
                        <div class="card-details">
                            <div class="card-type">Mastercard kết thúc bằng 8888</div>
                            <div class="card-number">•••• •••• •••• 8888</div>
                            <div class="card-expiry">Hết hạn 06/2025</div>
                        </div>
                    </div>
                </div>

                <div class="alert-card alert-info" style="margin-top: 1rem;">
                    <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="alert-content">
                        Phương thức thanh toán của bạn sẽ được trừ tự động vào ngày thanh toán. Bạn có thể thay đổi hoặc
                        xóa bất kỳ lúc nào.
                    </div>
                </div>
            </div>

            <!-- Invoices -->
            <div class="invoices-section">
                <div class="section-header">
                    <h2 class="section-title">Lịch sử hóa đơn</h2>
                    <button class="btn btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Tải tất cả
                    </button>
                </div>

                <div class="filter-bar">
                    <select class="filter-select">
                        <option>Tất cả trạng thái</option>
                        <option>Đã thanh toán</option>
                        <option>Đang chờ</option>
                        <option>Thất bại</option>
                    </select>
                    <select class="filter-select">
                        <option>12 tháng gần đây</option>
                        <option>Năm nay</option>
                        <option>Năm trước</option>
                        <option>Tất cả</option>
                    </select>
                    <input type="text" class="search-input" placeholder="Tìm kiếm hóa đơn...">
                </div>

                <table class="invoices-table">
                    <thead>
                        <tr>
                            <th>Hóa đơn</th>
                            <th>Ngày</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="invoice-id">#INV-2025-001</span></td>
                            <td style="color: black">15 Tháng 1, 2025</td>
                            <td><span class="invoice-amount">₫2,500,000</span></td>
                            <td><span class="status-badge status-paid"><span
                                        style="width:6px;height:6px;background:currentColor;border-radius:50%;"></span>Đã
                                    thanh toán</span></td>
                            <td>
                                <div class="invoice-actions">
                                    <button class="action-btn">Xem</button>
                                    <button class="action-btn">Tải xuống</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="invoice-id">#INV-2024-012</span></td>
                            <td style="color: black">15 Tháng 12, 2024</td>
                            <td><span class="invoice-amount">₫2,500,000</span></td>
                            <td><span class="status-badge status-paid"><span
                                        style="width:6px;height:6px;background:currentColor;border-radius:50%;"></span>Đã
                                    thanh toán</span></td>
                            <td>
                                <div class="invoice-actions">
                                    <button class="action-btn">Xem</button>
                                    <button class="action-btn">Tải xuống</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="invoice-id">#INV-2024-011</span></td>
                            <td style="color: black">15 Tháng 11, 2024</td>
                            <td><span class="invoice-amount">₫2,500,000</span></td>
                            <td><span class="status-badge status-paid"><span
                                        style="width:6px;height:6px;background:currentColor;border-radius:50%;"></span>Đã
                                    thanh toán</span></td>
                            <td>
                                <div class="invoice-actions">
                                    <button class="action-btn">Xem</button>
                                    <button class="action-btn">Tải xuống</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="invoice-id">#INV-2024-010</span></td>
                            <td style="color: black">15 Tháng 10, 2024</td>
                            <td><span class="invoice-amount">₫2,500,000</span></td>
                            <td><span class="status-badge status-paid"><span
                                        style="width:6px;height:6px;background:currentColor;border-radius:50%;"></span>Đã
                                    thanh toán</span></td>
                            <td>
                                <div class="invoice-actions">
                                    <button class="action-btn">Xem</button>
                                    <button class="action-btn">Tải xuống</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="invoice-id">#INV-2024-009</span></td>
                            <td style="color: black">15 Tháng 9, 2024</td>
                            <td><span class="invoice-amount">₫1,500,000</span></td>
                            <td><span class="status-badge status-paid"><span
                                        style="width:6px;height:6px;background:currentColor;border-radius:50%;"></span>Đã
                                    thanh toán</span></td>
                            <td>
                                <div class="invoice-actions">
                                    <button class="action-btn">Xem</button>
                                    <button class="action-btn">Tải xuống</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn" disabled>
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <span style="padding: 0 0.5rem; color: var(--gray-500);">...</span>
                    <button class="page-btn">12</button>
                    <button class="page-btn">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('js')
    <script>
        // Billing page interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Payment card selection
            const paymentCards = document.querySelectorAll('.payment-card');
            paymentCards.forEach(card => {
                card.addEventListener('click', function() {
                    paymentCards.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Invoice actions
            document.querySelectorAll('.action-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const action = this.textContent;
                    const row = this.closest('tr');
                    const invoiceId = row.querySelector('.invoice-id').textContent;

                    if (action === 'Download') {
                        console.log(`Downloading invoice ${invoiceId}...`);
                        // Show download animation
                        this.innerHTML = `
                            <svg width="12" height="12" class="animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        `;
                        setTimeout(() => {
                            this.textContent = 'Download';
                        }, 2000);
                    } else if (action === 'View') {
                        console.log(`Viewing invoice ${invoiceId}...`);
                    }
                });
            });

            // Upgrade button
            const upgradeBtn = document.querySelector('.upgrade-btn');
            if (upgradeBtn) {
                upgradeBtn.addEventListener('click', function() {
                    console.log('Opening upgrade modal...');
                });
            }

            // Animate progress bars on scroll
            const observeProgress = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const progressFill = entry.target.querySelector('.stat-progress-fill');
                        if (progressFill) {
                            const width = progressFill.style.width;
                            progressFill.style.width = '0';
                            setTimeout(() => {
                                progressFill.style.width = width;
                            }, 100);
                        }
                    }
                });
            });

            document.querySelectorAll('.stat-card').forEach(card => {
                observeProgress.observe(card);
            });

            // Pagination
            document.querySelectorAll('.page-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (!this.disabled) {
                        document.querySelectorAll('.page-btn').forEach(b => b.classList.remove(
                            'active'));
                        if (!this.querySelector('svg')) {
                            this.classList.add('active');
                        }
                    }
                });
            });

            // Add spin animation style
            const style = document.createElement('style');
            style.textContent = `
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                .animate-spin {
                    animation: spin 1s linear infinite;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
