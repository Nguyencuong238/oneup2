@extends('layouts.user')

@section('meta')
    <meta name="description" content="OneUp Campaign Planner - Plan and optimize your TikTok KOL campaigns">
    <title>Campaign Planner - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Base styles from dashboard */
        body {
            background: #F8F9FA;
            min-height: 100vh;
        }

        .dashboard-layout {
            display: block;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        /* Sidebar */
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

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--gray-100);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-profile:hover {
            background: var(--gray-200);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--gray-500);
        }

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

        /* Planner Content */
        .planner-content {
            padding: 2rem;
        }

        /* Stepper */
        .stepper-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .stepper::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gray-200);
            z-index: 0;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .step-indicator {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--gray-300);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--gray-500);
            transition: all 0.3s;
        }

        .step.active .step-indicator {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .step.completed .step-indicator {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step-label {
            font-size: 14px;
            color: var(--gray-600);
            text-align: center;
        }

        .step.active .step-label {
            color: var(--primary);
            font-weight: 600;
        }

        /* Form Sections */
        .planner-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .form-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
        }

        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-help {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }

        /* Budget Calculator */
        .budget-calculator {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .budget-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 14px;
        }

        .budget-item+.budget-item {
            border-top: 1px solid var(--gray-200);
        }

        .budget-label {
            color: var(--gray-600);
        }

        .budget-value {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .budget-total {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 2px solid var(--gray-300);
        }

        .budget-total .budget-value {
            font-size: 20px;
            color: var(--primary);
        }

        /* KOL Selection */
        .kol-selection-grid {
            display: grid;
            gap: 1rem;
        }

        .kol-select-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
        }

        .kol-select-card:hover {
            background: white;
            border-color: var(--gray-200);
        }

        .kol-select-card.selected {
            background: white;
            border-color: var(--primary);
        }

        .kol-checkbox {
            width: 20px;
            height: 20px;
            accent-color: var(--primary);
        }

        .kol-avatar {
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

        .kol-info {
            flex: 1;
        }

        .kol-name {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .kol-stats {
            display: flex;
            gap: 1rem;
            font-size: 12px;
            color: var(--gray-600);
        }

        .kol-price {
            text-align: right;
        }

        .price-label {
            font-size: 12px;
            color: var(--gray-500);
        }

        .price-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        /* Preview Panel */
        .preview-panel {
            position: sticky;
            top: 100px;
        }

        .preview-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 1.5rem;
        }

        .preview-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }

        .preview-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-size: 14px;
        }

        .preview-label {
            color: var(--gray-600);
        }

        .preview-value {
            font-weight: 500;
            color: var(--dark-blue);
        }

        /* Metrics Forecast */
        .forecast-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }

        .forecast-card {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }

        .forecast-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .forecast-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Actions */
        .planner-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        /* Tags Input */
        .tags-input {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 8px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            min-height: 44px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 4px 10px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 20px;
            font-size: 14px;
        }

        .tag-remove {
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
        }

        .tag-input-field {
            border: none;
            outline: none;
            flex: 1;
            min-width: 100px;
            font-size: 14px;
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

            .planner-grid {
                grid-template-columns: 1fr;
            }

            .preview-panel {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .planner-content {
                padding: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .forecast-grid {
                grid-template-columns: 1fr;
            }

            .stepper {
                overflow-x: auto;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Main Content -->
    <form class="main-content" action="{{ route('user.campaign.store') }}" method="POST">
        @csrf

        <!-- Thanh trên cùng -->
        <div class="topbar">
            <div class="topbar-left">
                <h1 class="page-title">Trình lập kế hoạch chiến dịch</h1>
            </div>

            <div class="topbar-right">
                <button class="btn btn-secondary btn-small btn-draft">
                    Lưu nháp
                </button>
                <button class="btn btn-primary btn-small btn-save">
                    Khởi chạy chiến dịch
                </button>
            </div>
        </div>

        <!-- Nội dung Planner -->
        <div class="planner-content">
            <!-- Thanh bước -->
            <div class="stepper-container">
                <div class="stepper">
                    <div class="step completed">
                        <div class="step-indicator">✓</div>
                        <span class="step-label">Thông tin cơ bản</span>
                    </div>
                    <div class="step active">
                        <div class="step-indicator">2</div>
                        <span class="step-label">Mục tiêu & Ngân sách</span>
                    </div>
                    <div class="step">
                        <div class="step-indicator">3</div>
                        <span class="step-label">Chọn KOL</span>
                    </div>
                    <div class="step">
                        <div class="step-indicator">4</div>
                        <span class="step-label">Tóm tắt nội dung</span>
                    </div>
                    <div class="step">
                        <div class="step-indicator">5</div>
                        <span class="step-label">Xem lại & Khởi chạy</span>
                    </div>
                </div>
            </div>

            <!-- Lưới chính -->
            <div class="planner-grid">
                <!-- Cột trái - Form -->
                <div>
                    <!-- Thông tin chiến dịch -->
                    <div class="form-section">
                        <h2 class="section-title">Chi tiết chiến dịch</h2>

                        <div class="form-group">
                            <label class="form-label">Tên chiến dịch *</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-input"
                                placeholder="Tên chiến dịch..." required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Ngày bắt đầu *</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" id="start_date"
                                    class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ngày kết thúc *</label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" id="end_date"
                                    class="form-input" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="campaign_category">
                                <option>-- Chọn --</option>
                                @foreach ($campaignCategories as $item)
                                    <option value="{{ $item->id }}" @if (old('campaign_category' == $item->id)) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Mô tả chiến dịch</label>
                            <textarea class="form-textarea" name="description" placeholder="Mô tả chiến dịch...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Mục tiêu & Ngân sách -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Mục tiêu & Ngân sách</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Phạm vi tiếp cận mục tiêu</label>
                                <input type="number" name="target_reach" value="{{ old('target_reach') }}"
                                    class="form-input" placeholder="0">
                                <span class="form-help">Lượng người xem dự kiến</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tỷ lệ tương tác mục tiêu</label>
                                <input type="number" name="target_engagement" value="{{ old('target_engagement') }}"
                                    class="form-input" placeholder="0" step="0.1">
                                <span class="form-help">Tỷ lệ tương tác tối thiểu (%)</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tổng ngân sách (VNĐ)</label>
                            <input type="number" name="budget_amount" value="{{ old('budget_amount') }}" id="budget_amount"
                                class="form-input" placeholder="0">
                            <span class="form-help">Bao gồm chi phí KOL và sản xuất nội dung</span>
                        </div>

                        <div class="budget-calculator">
                            <div class="budget-item">
                                <span class="budget-label">Chi phí KOL (70%)</span>
                                <span class="budget-value kol-fee">₫0</span>
                            </div>
                            <div class="budget-item">
                                <span class="budget-label">Sản xuất nội dung (20%)</span>
                                <span class="budget-value produce-fee">₫0</span>
                            </div>
                            <div class="budget-item">
                                <span class="budget-label">Phí quản lý (10%)</span>
                                <span class="budget-value manage-fee">₫0</span>
                            </div>
                            <div class="budget-item budget-total">
                                <span class="budget-label">Tổng ngân sách</span>
                                <span class="budget-value">₫0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chọn KOL -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Chọn KOL</h2>

                        <div class="form-group">
                            <label class="form-label">Lọc theo danh mục</label>
                            <select class="form-select" id="select-kol-category">
                                <option>Tất cả danh mục</option>
                                @foreach ($kolCategories as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="kol-selection-grid">
                            @foreach ($kols as $item)
                                <div class="kol-select-card"
                                    data-categories="{{ ',' . $item->categories->implode('id', ',') . ',' }}">
                                    <input type="checkbox" class="kol-checkbox" name="kols[]"
                                        value="{{ $item->id }}"
                                        {{ in_array($item->id, old('kols', [])) ? 'checked' : '' }}>
                                    {{-- <div class="kol-avatar">LN</div> --}}
                                    <img class="kol-avatar" src="{{ $item->getFirstMediaUrl('media') }}">
                                    <div class="kol-info">
                                        <div class="kol-name">{{ $item->display_name }}</div>
                                        <div class="kol-stats">
                                            <span>
                                                {{ formatDisplayNumber($item->followers, 3) }} người theo dõi
                                            </span>
                                            <span>•</span>
                                            <span>{{ $item->engagement }}% tương tác</span>
                                        </div>
                                    </div>
                                    <div class="kol-price">
                                        <div class="price-label">Giá ước tính</div>
                                        <div class="price-value">₫{{ numberFormat($item->price) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Yêu cầu nội dung -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Yêu cầu nội dung</h2>

                        <div class="form-group">
                            <label class="form-label">Loại nội dung</label>
                            <select class="form-select" name="content_type">
                                <option value="short_video" @if (old('content_type') == 'short_video') selected @endif>
                                    Video
                                    (15-60s)</option>
                                <option value="videos" @if (old('content_type') == 'videos') selected @endif>
                                    Chuỗi video
                                </option>
                                <option value="livestream" @if (old('content_type') == 'livestream') selected @endif>
                                    Phát trực tiếp
                                </option>
                                <option value="image_post" @if (old('content_type') == 'image_post') selected @endif>
                                    Bài đăng hình ảnh</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Thông điệp chính</label>
                            <div class="tags-input">
                                <span class="tag">
                                    Thời trang bền vững
                                    <span class="tag-remove">×</span>
                                </span>
                                <span class="tag">
                                    Bộ sưu tập mùa hè
                                    <span class="tag-remove">×</span>
                                </span>
                                <span class="tag">
                                    Phong cách trẻ
                                    <span class="tag-remove">×</span>
                                </span>
                                <input type="text" class="tag-input-field" placeholder="Thêm thẻ...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hashtag</label>
                            <input type="text" class="form-input" name="hashtag"
                                value="" placeholder="#hashtag1 #hashtag2">
                        </div>
                    </div>
                </div>

                <!-- Cột phải - Xem trước -->
                <div class="preview-panel">
                    <!-- Tóm tắt chiến dịch -->
                    <div class="preview-card">
                        <h3 class="preview-title">Tóm tắt chiến dịch</h3>

                        <div class="preview-item">
                            <span class="preview-label">Thời gian</span>
                            <span class="preview-value preview-duration">0 ngày</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Số KOL đã chọn</span>
                            <span class="preview-value preview-kols">0 KOL</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Tổng ngân sách</span>
                            <span class="preview-value preview-budget">₫0</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Chi phí trung bình / KOL</span>
                            <span class="preview-value preview-fee">₫0</span>
                        </div>
                    </div>

                    <!-- Dự đoán hiệu suất -->
                    <div class="preview-card">
                        <h3 class="preview-title">Hiệu suất dự kiến</h3>

                        <div class="forecast-grid">
                            <div class="forecast-card">
                                <div class="forecast-value">0M</div>
                                <div class="forecast-label">Lượt tiếp cận ước tính</div>
                            </div>
                            <div class="forecast-card">
                                <div class="forecast-value">0%</div>
                                <div class="forecast-label">Tỷ lệ tương tác ước tính</div>
                            </div>
                            <div class="forecast-card">
                                <div class="forecast-value">₫0</div>
                                <div class="forecast-label">Chi phí / lượt xem (CPV)</div>
                            </div>
                            <div class="forecast-card">
                                <div class="forecast-value">0x</div>
                                <div class="forecast-label">ROI ước tính</div>
                            </div>
                        </div>
                    </div>

                    <!-- Danh sách KOL đã chọn -->
                    <div class="preview-card">
                        <h3 class="preview-title">KOL đã chọn (0)</h3>

                        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                            {{-- <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="kol-avatar" style="width: 36px; height: 36px; font-size: 14px;">LN</div>
                                <div style="flex: 1;">
                                    <div class="fw-600 fs-14 color-gray-700">Linh Nguyễn</div>
                                    <div class="fs-12 color-gray-600">2.3 triệu người theo dõi</div>
                                </div>
                                <span style="font-weight: 600; color: var(--primary);">₫15 triệu</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="kol-avatar"
                                    style="width: 36px; height: 36px; font-size: 14px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    MT</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500; font-size: 14px;">Minh Trần</div>
                                    <div style="font-size: 12px; color: var(--gray-600);">1.8 triệu người theo dõi</div>
                                </div>
                                <span style="font-weight: 600; color: var(--primary);">₫12 triệu</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="planner-actions">
                <button class="btn btn-secondary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                        style="margin-right: 0.5rem;">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Bước trước
                </button>

                <div class="action-buttons">
                    <button class="btn btn-secondary">Lưu nháp</button>
                    <button class="btn btn-primary">
                        Bước tiếp theo
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                            style="margin-left: 0.5rem;">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Initialize planner
        $(document).ready(function() {
            // KOL selection
            initKOLSelection();

            // Budget calculator
            initBudgetCalculator();

            // Tags input
            initTagsInput();

            // Forecast inputs
            ['target_reach', 'target_engagement', 'budget_amount'].forEach(function(name) {
                $(`input[name="${name}"]`).on('input', updateForecastFromInputs);
            });
            updateForecastFromInputs();
        });

        function initKOLSelection() {
            $('.kol-select-card').each(function() {
                var card = $(this);
                var checkbox = card.find('.kol-checkbox');

                card.on('click', function(e) {
                    if (!$(e.target).hasClass('kol-checkbox')) {
                        checkbox.prop('checked', !checkbox.prop('checked'));
                        card.toggleClass('selected', checkbox.prop('checked'));
                        updateSelectedKOLs();
                    }
                });

                checkbox.on('change', function() {
                    card.toggleClass('selected', $(this).prop('checked'));
                    updateSelectedKOLs();
                });
            });
        }

        function initBudgetCalculator() {
            $('#budget_amount').on('input', function() {
                var budget = parseInt($(this).val()) || 0;

                $('.budget-item:nth-child(1) .budget-value').text(
                    `₫${numberFormat(budget * 0.7)}`
                );
                $('.budget-item:nth-child(2) .budget-value').text(
                    `₫${numberFormat(budget * 0.2)}`
                );
                $('.budget-item:nth-child(3) .budget-value').text(
                    `₫${numberFormat(budget * 0.1)}`
                );
                $('.budget-total .budget-value, .preview-budget').text(
                    `₫${numberFormat(budget)}`
                );
            });
        }

        function initTagsInput() {
            var tagInput = $('.tag-input-field');
            var tagsContainer = $('.tags-input');

            tagInput.on('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    var value = $(this).val().trim();
                    if (value) {
                        var tag = $(`<span class="tag">${value}<span class="tag-remove">×</span></span>`);
                        tag.insertBefore(this);
                        $(this).val('');

                        tag.find('.tag-remove').on('click', function() {
                            tag.remove();
                        });
                    }
                }
            });

            // Remove existing tags
            $('.tag-remove').on('click', function() {
                $(this).parent().remove();
            });
        }

        function animateValue(element, start, end, duration, suffix) {
            var range = end - start;
            var increment = range / (duration / 10);
            var current = start;

            var timer = setInterval(function() {
                current += increment;
                if (current >= end) {
                    current = end;
                    clearInterval(timer);
                }
                $(element).text(current.toFixed(1) + (suffix || ''));
            }, 10);
        }
        // Tính toán hiệu suất dự kiến dựa trên input mục tiêu & ngân sách
        function updateForecastFromInputs() {
            // Lấy giá trị từ các input
            const reach = parseInt($('input[name="target_reach"]').val()) || 0;
            const engagement = parseFloat($('input[name="target_engagement"]').val()) || 0;
            const budget = parseInt($('input[name="budget_amount"]').val()) || 0;

            // Lượt tiếp cận ước tính
            $('.forecast-card').eq(0).find('.forecast-value').text(reach > 0 ? numberFormat(reach) : '0');

            // Tỷ lệ tương tác ước tính
            $('.forecast-card').eq(1).find('.forecast-value').text(engagement > 0 ? numberFormat(engagement) + '%' : '0%');

            // Chi phí / lượt xem (CPV)
            let cpv = reach > 0 ? (budget / reach) : 0;
            $('.forecast-card').eq(2).find('.forecast-value').text(cpv > 0 ? '₫' + numberFormat(cpv) : '₫0');

            // ROI ước tính (giả sử ROI = (reach * engagement / 100) / (budget/1000000))
            let roi = budget > 0 ? ((reach * (engagement / 100)) / (budget / 1000000)) : 0;
            $('.forecast-card').eq(3).find('.forecast-value').text(roi > 0 ? numberFormat(roi) + 'x' : '0x');
        }

        $('#start_date, #end_date').on('change', function() {
            let date1 = new Date($('#start_date').val());
            let date2 = new Date($('#end_date').val());

            if (!isNaN(date1) && !isNaN(date2) && date2 > date1) {
                // Tính số mili-giây chênh lệch
                let diffTime = date2 - date1;

                // Chuyển sang số ngày
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                $('.preview-duration').text(diffDays + ' ngày');
            } else {
                $('.preview-duration').text('0 ngày');
            }
        });

        function updateSelectedKOLs() {
            var selectedCards = $('.kol-select-card.selected');
            var selectedCount = selectedCards.length;
            $('.preview-kols').text(`${selectedCount} KOL`);

            // Update cost calculation
            var totalKOLCost = 0;
            var kolListHtml = '';
            selectedCards.each(function() {
                var avatar = $(this).find('.kol-avatar').clone().css({
                    width: '36px',
                    height: '36px',
                    'font-size': '14px'
                });
                var name = $(this).find('.kol-name').text();
                var followers = $(this).find('.kol-stats span').first().text();
                var priceText = $(this).find('.price-value').text();
                var price = parseInt(priceText.replace(/[^\d]/g, ''));
                totalKOLCost += price;

                kolListHtml += `
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        ${$('<div>').append(avatar).html()}
                        <div style="flex: 1;">
                            <div class="fw-600 fs-14 color-gray-700">${name}</div>
                            <div class="fs-12 color-gray-600">${followers}</div>
                        </div>
                        <span style="font-weight: 600; color: var(--primary);">${priceText}</span>
                    </div>
                `;
            });

            $('.preview-card').eq(2).find('h3').text(`KOL đã chọn (${selectedCount})`);
            $('.preview-card').eq(2).find('> div').html(kolListHtml);

            if (selectedCount > 0) {
                var avgCost = totalKOLCost / selectedCount;
                $('.preview-fee').text(`₫${numberFormat(avgCost, 3)}`);
            } else {
                $('.preview-fee').text('₫0');
                $('.preview-card').eq(2).find('> div').html('');
                $('.preview-card').eq(2).find('h3').text('KOL đã chọn (0)');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#select-kol-category').on('change', function() {
                var selectedCat = $(this).val();
                $('.kol-select-card').each(function() {
                    var categories = $(this).data('categories') + '';
                    if (selectedCat === '' || selectedCat === undefined || selectedCat ===
                        'Tất cả danh mục') {
                        $(this).show();
                    } else {
                        if (categories.indexOf(',' + selectedCat + ',') !== -1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Xử lý submit cho 2 nút
            $('.btn-draft, .btn-save').on('click', function(e) {
                e.preventDefault();

                // Xác định status
                let status = $(this).hasClass('btn-draft') ? 'draft' : 'active';

                // Lấy form
                let $form = $(this).closest('form');

                // Xóa input status cũ nếu có
                $form.find('input[name="status"]').remove();

                // Thêm input status mới
                $('<input>').attr({
                    type: 'hidden',
                    name: 'status',
                    value: status
                }).appendTo($form);

                // Submit form
                $form.submit();
            });
        });
    </script>
@endsection
