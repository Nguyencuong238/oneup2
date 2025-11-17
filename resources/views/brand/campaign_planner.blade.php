@extends('layouts.brand_master')

@section('meta')
    <meta name="description" content="OneUp Campaign Planner - Plan and optimize your TikTok KOL campaigns">
    <title>Campaign Planner - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
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
            flex-wrap: wrap;
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
            overflow: auto;
            flex-wrap: wrap
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

            .kol-info-box {
                display: flex;
                flex: 1;
                gap: 20px;
                align-items: center;
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
                gap: 1rem;
            }

            .step {
                width: 100%;
                flex: unset;
                flex-direction: row;
            }

            .topbar-right {
                position: fixed;
                bottom: 0;
                width: 100%;
                background: #fff;
                z-index: 100;
                justify-content: end;
                right: 0;
                padding: 10px 20px;
                border-top: 1px solid var(--gray-200);
            }

            .topbar {
                padding: 1rem;
            }

        }
    </style>
@endsection

@section('page')
    <!-- Main Content -->
    <form class="main-content" action="{{ route('brand.campaign.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($campaign->id && !request('is_clone'))
            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
        @endif
        <!-- Thanh trên cùng -->
        <div class="topbar">
            <div class="topbar-left">
                <h1 class="page-title">Trình lập kế hoạch chiến dịch</h1>

                <div class="menu-toggle" onclick="$('.sidebar').toggleClass('active');">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="topbar-right">
                @if($campaign->id && $campaign->kols->count() > 0)
                    <a href="{{ route('brand.campaign.export.creators', $campaign->id) }}" class="btn btn-success btn-small" title="Xuất thông tin người sáng tạo">
                        <span style="margin-right: 0.5rem;">📊</span>Xuất Excel
                    </a>
                @endif
                <button type="button" class="btn btn-secondary btn-small btn-draft">
                    Lưu nháp
                </button>
                <button type="button" class="btn btn-primary btn-small btn-save">
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
                            <input type="text" name="name" value="{{ old('name', $campaign->name) }}"
                                class="form-input" placeholder="Tên chiến dịch..." required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Ngày bắt đầu *</label>
                                <input type="date" name="start_date"
                                    value="{{ old('start_date', $campaign->start_date?->format('Y-m-d')) }}" id="start_date"
                                    class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ngày kết thúc *</label>
                                <input type="date" name="end_date"
                                    value="{{ old('end_date', $campaign->end_date?->format('Y-m-d')) }}" id="end_date"
                                    class="form-input" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="campaign_category">
                                <option>-- Chọn --</option>
                                @foreach ($campaignCategories as $item)
                                    <option value="{{ $item->id }}" @if (old('campaign_category', $campaign->category_id) == $item->id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Mô tả chiến dịch</label>
                            <textarea class="form-textarea" name="description" placeholder="Mô tả chiến dịch...">{{ old('description', $campaign->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Mục tiêu & Ngân sách -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Mục tiêu & Ngân sách</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Phạm vi tiếp cận mục tiêu</label>
                                <input type="number" name="target_reach"
                                    value="{{ old('target_reach', $campaign->target_reach) }}" class="form-input"
                                    placeholder="0">
                                <span class="form-help">Lượng người xem dự kiến</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tỷ lệ tương tác mục tiêu</label>
                                <input type="number" name="target_engagement"
                                    value="{{ old('target_engagement', $campaign->target_engagement) }}" class="form-input"
                                    placeholder="0" step="0.1">
                                <span class="form-help">Tỷ lệ tương tác tối thiểu (%)</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tổng ngân sách (VNĐ)</label>
                            <input type="number" name="budget_amount"
                                value="{{ old('budget_amount', $campaign->budget_amount - 0) }}" id="budget_amount"
                                class="form-input" placeholder="0">
                            <span class="form-help">Bao gồm chi phí nhà sáng tạo nội dung và sản xuất nội dung</span>
                        </div>

                        <div class="budget-calculator">
                            <div class="budget-item">
                                <span class="budget-label">Chi phí nhà sáng tạo nội dung (70%)</span>
                                <span
                                    class="budget-value kol-fee">₫{{ formatDisplayNumber($campaign->budget_amount * 0.7) }}</span>
                            </div>
                            <div class="budget-item">
                                <span class="budget-label">Sản xuất nội dung (20%)</span>
                                <span
                                    class="budget-value produce-fee">₫{{ formatDisplayNumber($campaign->budget_amount * 0.2) }}</span>
                            </div>
                            <div class="budget-item">
                                <span class="budget-label">Phí quản lý (10%)</span>
                                <span
                                    class="budget-value manage-fee">₫{{ formatDisplayNumber($campaign->budget_amount * 0.1) }}</span>
                            </div>
                            <div class="budget-item budget-total">
                                <span class="budget-label">Tổng ngân sách</span>
                                <span
                                    class="budget-value totalBudget">₫{{ formatDisplayNumber($campaign->budget_amount) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chọn KOL -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Chọn nhà sáng tạo nội dung</h2>

                        {{-- Ô lọc --}}
                        <div class="form-group">
                            <label class="form-label">Bộ lọc</label>
                            <select class="form-select" id="kol-filter">
                                <option value="">Tất cả danh mục / Mức giá / Mức độ tương tác</option>
                                <optgroup label="Danh mục">
                                    @foreach ($kolCategories as $item)
                                        <option value="category:{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Giá chiến dịch">
                                    <option value="price:low">Dưới 1 triệu</option>
                                    <option value="price:medium">1 - 5 triệu</option>
                                    <option value="price:high">Trên 5 triệu</option>
                                </optgroup>
                                <optgroup label="Engagement">
                                    <option value="eng:low">Dưới 1%</option>
                                    <option value="eng:medium">1% - 5%</option>
                                    <option value="eng:high">Trên 5%</option>
                                </optgroup>
                            </select>
                        </div>

                        {{-- Grid hiển thị KOL --}}
                        <div class="kol-selection-grid" id="kol-grid">
                            @foreach ($kols as $item)
                                <div class="kol-select-card {{ in_array($item->id, old('kols', $campaign->kols->pluck('id')->toArray())) ? 'selected' : '' }}"
                                    data-id="{{ $item->id }}">
                                    <div class="kol-info-box">
                                        <input type="checkbox" class="kol-checkbox" name="kols[]"
                                            value="{{ $item->id }}"
                                            {{ in_array($item->id, old('kols', $campaign->kols->pluck('id')->toArray())) ? 'checked' : '' }}>
                                         <img class="kol-avatar" src="{{ $item->getFirstMediaUrl('media') }}">
                                        <div class="kol-info">
                                            <div class="kol-name">{{ $item->display_name }}</div>
                                            <div class="kol-stats">
                                                <span>{{ formatDisplayNumber($item->followers, 3) }} người theo dõi</span>
                                                <span>•</span>
                                                <span>{{ $item->engagement }}% tương tác</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kol-price">
                                        <div class="price-label">Giá ước tính</div>
                                        <div class="price-value">₫{{ formatDisplayNumber($item->price_campaign, 2) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- Pagination --}}
                        <div id="kol-pagination-container" style="margin-top: 2rem;">
                            {{-- Pagination will be loaded here via AJAX --}}
                        </div>
                        </div>


                    <!-- Thông tin liên hệ thương hiệu -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Thông tin liên hệ thương hiệu</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Số điện thoại Zalo</label>
                                <input type="text" name="zalo_phone" 
                                    value="{{ old('zalo_phone', $campaign->zalo_phone ?? '') }}" 
                                    class="form-input" placeholder="VD: 0901234567">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Liên kết Facebook</label>
                                <input type="url" name="fb_link" 
                                    value="{{ old('fb_link', $campaign->fb_link ?? '') }}" 
                                    class="form-input" placeholder="VD: https://facebook.com/...">
                            </div>
                        </div>
                    </div>

                    <!-- Yêu cầu nội dung -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Yêu cầu nội dung</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Phạm vi chiến dịch</label>
                                <input type="text" name="campaign_area" 
                                    value="{{ old('campaign_area', $campaign->campaign_area ?? '') }}" 
                                    class="form-input" placeholder="VD: Toàn quốc, TP.HCM, Hà Nội">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hình ảnh chiến dịch</label>
                                <input type="file" name="campaign_image" 
                                    class="form-input" accept="image/*">
                                @if(!empty($campaign->campaign_image))
                                    <small class="form-help">Hình ảnh hiện tại: {{ $campaign->campaign_image }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Loại nội dung ưu tiên</label>
                            <select class="form-select" name="priority_content_type" id="priority_content_type">
                                <option value="no_priority" @if (old('priority_content_type', $campaign->priority_content_type ?? '') == 'no_priority') selected @endif>
                                    Không ưu tiên
                                </option>
                                <option value="regular_review" @if (old('priority_content_type', $campaign->priority_content_type ?? '') == 'regular_review') selected @endif>
                                    Review thường xuyên
                                </option>
                                <option value="video_sales" @if (old('priority_content_type', $campaign->priority_content_type ?? '') == 'video_sales') selected @endif>
                                    Video bán hàng
                                </option>
                                <option value="live_sales" @if (old('priority_content_type', $campaign->priority_content_type ?? '') == 'live_sales') selected @endif>
                                    Live bán hàng
                                </option>
                            </select>
                        </div>

                        <div class="form-group" id="sales_link_group" style="display: none;">
                            <label class="form-label">Liên kết bán hàng</label>
                            <input type="url" name="sales_link" 
                                value="{{ old('sales_link', $campaign->sales_link ?? '') }}" 
                                class="form-input" placeholder="Dán liên kết bán hàng của bạn tại đây">
                            <span class="form-help">Nhập liên kết sản phẩm hoặc livestream</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <input type="checkbox" name="free_sample_order" 
                                    value="1" 
                                    {{ old('free_sample_order', $campaign->free_sample_order ?? false) ? 'checked' : '' }}
                                    style="width: 18px; height: 18px; margin-right: 0.5rem; cursor: pointer; accent-color: var(--primary);">
                                Hỗ trợ mẫu miễn phí
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Loại nội dung</label>
                            <select class="form-select" name="content_type">
                                <option value="short_video" @if (old('content_type', $campaign->content_type) == 'short_video') selected @endif>
                                    Video
                                    (15-60s)</option>
                                <option value="videos" @if (old('content_type', $campaign->content_type) == 'videos') selected @endif>
                                    Chuỗi video
                                </option>
                                <option value="livestream" @if (old('content_type', $campaign->content_type) == 'livestream') selected @endif>
                                    Phát trực tiếp
                                </option>
                                <option value="image_post" @if (old('content_type', $campaign->content_type) == 'image_post') selected @endif>
                                    Bài đăng hình ảnh</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Thông điệp chính</label>
                            <textarea type="text" name="content" placeholder="Thêm thông điệp ..." rows="5" class="form-input">{{ old('content', $campaign->content) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hashtag</label>
                            <div class="tags-input">
                                @foreach ($campaign->tags as $tag)
                                    <span class="tag">
                                        {{ $tag->name }}
                                        <span class="tag-remove">&times;</span>
                                    </span>
                                    <input type="hidden" name="tags[]" id="tag-input-{{ $loop->index }}"
                                        value="{{ $tag->name }}">
                                @endforeach
                                <input type="text" class="tag-input-field" placeholder="Enter để thêm thẻ...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột phải - Xem trước -->
                <div class="preview-panel">
                    <!-- Hình ảnh chiến dịch -->
                    <div class="preview-card" id="campaign-image-preview-card">
                        <h3 class="preview-title">Hình ảnh chiến dịch</h3>
                        <div id="campaign-image-preview" style="text-align: center; padding: 1rem 0;">
                            @if(!empty($campaign->campaign_image))
                                <img src="{{ asset('storage/' . $campaign->campaign_image) }}" style="max-width: 100%; height: auto; border-radius: 8px; max-height: 300px;">
                            @else
                                <p style="color: var(--gray-500); font-size: 14px;">Chưa có hình ảnh</p>
                            @endif
                        </div>
                    </div>

                    <!-- Tóm tắt chiến dịch -->
                    <div class="preview-card">
                        <h3 class="preview-title">Tóm tắt chiến dịch</h3>

                        <div class="preview-item">
                            <span class="preview-label">Thời gian</span>
                            <span class="preview-value preview-duration">0 ngày</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Số người sáng tạo nội dung đã chọn</span>
                            <span class="preview-value preview-kols">{{ $campaign->kols->count() }} KOL</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Tổng ngân sách</span>
                            <span
                                class="preview-value preview-budget">₫{{ formatDisplayNumber($campaign->budget_amount) }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Chi phí trung bình / Nhà sáng tạo nội dung</span>
                            <span class="preview-value preview-fee"></span>
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
                        <h3 class="preview-title">
                            Nhà sáng tạo nội dung đã chọn (<span id="selected-count">{{ count($campaign->kols) }}</span>)
                        </h3>

                        <div id="selected-kols"
                            style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                            @foreach ($campaign->kols as $item)
                                <div class="selected-kol" data-id="{{ $item->id }}"
                                    style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img class="kol-avatar" style="width: 36px; height: 36px; font-size: 14px;"
                                        src="{{ $item->getFirstMediaUrl('media') }}">
                                    <div style="flex: 1;">
                                        <div class="fw-600 fs-14 color-gray-700">{{ $item->display_name }}</div>
                                        <div class="fs-12 color-gray-600">
                                            {{ formatDisplayNumber($item->followers, 2) }} người theo dõi
                                        </div>
                                    </div>
                                    <span style="font-weight: 600; color: var(--primary);">
                                        ₫{{ formatDisplayNumber($item->price) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        jQuery(function($) {
            // Cached selectors
            const $doc = $(document);
            const $budgetInput = $('#budget_amount');
            const $kolGrid = $('#kol-grid');
            const $previewCardList = $('#selected-kols');
            const $previewCardHeader = $('#selected-kols').closest('.preview-card').find('h3');
            const $previewFee = $('.preview-fee');
            const $previewDuration = $('.preview-duration');
            const $previewKols = $('.preview-kols');

            let selectedKOLs = new Map();

            // Utility helpers
            const fmt = n => (n || 0).toLocaleString('vi-VN');
            const fmtNum = (n, d=0) => !n || isNaN(n) ? '0' : Number(n).toLocaleString('vi-VN', {minimumFractionDigits:d, maximumFractionDigits:d});
            const formatDisplayNumber = (n, decimals = 0) => {
                if (!n || isNaN(n)) return '0';
                const num = Number(n);
                if (num >= 1000000) return (num / 1000000).toFixed(decimals) + 'M';
                if (num >= 1000) return (num / 1000).toFixed(decimals) + 'K';
                return num.toFixed(decimals);
            };
            const debounce = (fn, w=150) => {let t; return function() {clearTimeout(t); t = setTimeout(() => fn.apply(this, arguments), w);}};
            
            // Get KOL info from card
            const getKolInfo = ($card) => {
                const $avatar = $card.find('img.kol-avatar');
                const avatarUrl = $avatar.attr('src') || '';
                const name = $card.find('.kol-name').text().trim();
                const followersText = $card.find('.kol-stats span').eq(0).text().trim();
                const price = $card.find('.kol-price .price-value').text().trim();
                
                return {
                    name: name || 'N/A',
                    followers: followersText || '0 người theo dõi',
                    price: price || '₫0',
                    avatarUrl: avatarUrl
                };
            };

            // Initialize from DOM
            function initSelectedFromDOM() {
                selectedKOLs.clear();
                
                // First: Extract info from initial preview panel (has all selected KOLs)
                $('#selected-kols .selected-kol').each(function() {
                    const $item = $(this);
                    const id = String($item.data('id'));
                    const $img = $item.find('img.kol-avatar');
                    const name = $item.find('.fw-600').text().trim();
                    const followers = $item.find('.fs-12').text().trim();
                    // Get price - look for span with primary color or containing ₫
                    const $priceSpan = $item.find('span[style*="var(--primary)"]').length ? 
                                      $item.find('span[style*="var(--primary)"]') :
                                      $item.find('span:contains("₫")').first();
                    let priceText = $priceSpan.text().trim();
                    // Extract numeric value and format it
                    const priceNum = parseFloat(priceText.replace(/[^\d.,]/g, '').replace(',', '.')) || 0;
                    const price = '₫' + formatDisplayNumber(priceNum);
                    const avatarUrl = $img.attr('src') || '';
                    
                    selectedKOLs.set(id, {name, followers, price, avatarUrl});
                });
                
                // Second: Update with fresh info from visible grid cards
                $('#kol-grid .kol-select-card').each(function() {
                    const $card = $(this);
                    const id = String($card.data('id'));
                    if (selectedKOLs.has(id)) {
                        $card.addClass('selected').find('.kol-checkbox').prop('checked', true);
                        // Update with fresh info from grid
                        const freshInfo = getKolInfo($card);
                        if (freshInfo.name && freshInfo.name !== 'N/A') {
                            selectedKOLs.set(id, freshInfo);
                        }
                    }
                });
            }

            // Update preview
            function updateSelectedKOLs() {
                const count = selectedKOLs.size;
                $previewCardHeader.text(`Nhà sáng tạo nội dung đã chọn (${count})`);
                $previewKols.text(`${count} KOL`);
                
                let totalCost = 0, html = '';
                selectedKOLs.forEach((info, id) => {
                    const price = parseFloat(info.price.replace(/[^\d.,]/g, '').replace(',', '.')) || 0;
                    totalCost += price;
                    html += `<div class="selected-kol" data-id="${id}" style="display:flex;align-items:center;gap:0.75rem;">
                        <img class="kol-avatar" src="${info.avatarUrl || ''}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                        <div style="flex:1;">
                            <div class="fw-600 fs-14 color-gray-700">${info.name}</div>
                            <div class="fs-12 color-gray-600">${info.followers}</div>
                        </div>
                        <span style="font-weight:600;color:var(--primary);">${info.price}</span>
                        <button type="button" class="remove-selected-kol" data-id="${id}" style="background:none;border:none;color:#999;font-size:18px;cursor:pointer;">✕</button>
                    </div>`;
                });
                
                $previewCardList.html(html);
                $previewFee.text(count > 0 ? `₫${fmtNum(totalCost/count, 3)}M` : '₫0');
            }

            // Event: Card click
            $doc.on('click', '#kol-grid .kol-select-card', function(e) {
                if ($(e.target).is('.kol-checkbox')) return;
                $(this).find('.kol-checkbox').prop('checked', !$(this).find('.kol-checkbox').prop('checked')).trigger('change');
            });

            // Event: Checkbox change
            $doc.on('change', '#kol-grid .kol-checkbox', function() {
                const $card = $(this).closest('.kol-select-card');
                const id = String($card.data('id'));
                if ($(this).is(':checked')) {
                    selectedKOLs.set(id, getKolInfo($card));
                    $card.addClass('selected');
                } else {
                    selectedKOLs.delete(id);
                    $card.removeClass('selected');
                }
                updateSelectedKOLs();
            });

            // Event: Remove from preview
            $doc.on('click', '.remove-selected-kol', function() {
                const id = String($(this).data('id'));
                selectedKOLs.delete(id);
                $(`#kol-grid .kol-select-card[data-id="${id}"]`).removeClass('selected').find('.kol-checkbox').prop('checked', false);
                updateSelectedKOLs();
            });

            // Store current filter
            let currentFilter = '';

            // Load KOL with filter & pagination
            function loadKols(page = 1) {
                $.ajax({
                    url: "{{ route('kols.ajaxFilter') }}",
                    type: "GET",
                    data: {filter: currentFilter, page: page},
                    beforeSend: () => $kolGrid.html('<p style="text-align:center;padding:2rem;">Đang tải dữ liệu...</p>'),
                    success: (res) => {
                        $kolGrid.html(res.html);
                        $('#kol-pagination-container').html(res.pagination);
                        // Restore selections for KOLs in the filtered grid
                        // Only update info for KOLs that are actually present in the new grid
                        selectedKOLs.forEach((info, id) => {
                            const $c = $(`#kol-grid .kol-select-card[data-id="${id}"]`);
                            if ($c.length) {
                                $c.find('.kol-checkbox').prop('checked', true).closest('.kol-select-card').addClass('selected');
                                // Update info only if found in grid (in case it changed)
                                const newInfo = getKolInfo($c);
                                if (newInfo.name && newInfo.name !== 'N/A') {
                                    selectedKOLs.set(id, newInfo);
                                }
                                // Otherwise keep the previously stored info
                            }
                        });
                        updateSelectedKOLs();
                    },
                    error: () => $kolGrid.html('<p style="color:red;text-align:center;">Lỗi khi tải dữ liệu.</p>')
                });
            }

            // Event: Filter change
            $doc.on('change', '#kol-filter', function() {
                currentFilter = $(this).val();
                loadKols(1);
            });

            // Event: Pagination
            $doc.on('click', '.kol-prev-page, .kol-next-page, .kol-goto-page', function() {
                const page = $(this).data('page');
                loadKols(page);
                window.scrollTo(0, $kolGrid.offset().top - 100);
            });

            // Budget & forecast
            $budgetInput.on('input', debounce(function() {
                const b = parseInt($(this).val()) || 0;
                $('.kol-fee').text(`₫${fmtNum(b * 0.7)}`);
                $('.produce-fee').text(`₫${fmtNum(b * 0.2)}`);
                $('.manage-fee').text(`₫${fmtNum(b * 0.1)}`);
                $('.totalBudget, .preview-budget').text(`₫${fmtNum(b)}`);
            }, 150));

            $doc.on('input', 'input[name="target_reach"], input[name="target_engagement"]', debounce(updateForecast, 150));

            function updateForecast() {
                const reach = parseInt($('input[name="target_reach"]').val()) || 0;
                const eng = parseFloat($('input[name="target_engagement"]').val()) || 0;
                const budget = parseInt($budgetInput.val()) || 0;
                $('.forecast-card').eq(0).find('.forecast-value').text(reach > 0 ? fmt(reach) : '0');
                $('.forecast-card').eq(1).find('.forecast-value').text(eng > 0 ? fmt(eng) + '%' : '0%');
                const cpv = reach > 0 ? (budget / reach) : 0;
                $('.forecast-card').eq(2).find('.forecast-value').text(cpv > 0 ? '₫' + fmt(cpv) : '₫0');
                const roi = budget > 0 ? ((reach * (eng / 100)) / (budget / 1000000)) : 0;
                $('.forecast-card').eq(3).find('.forecast-value').text(roi > 0 ? fmt(roi) + 'x' : '0x');
            }

            // Tag input (as original)
            const $tagsInput = $('.tags-input');
            let tagIndex = {{ $campaign->tags->count() }};
            $tagsInput.on('keypress', '.tag-input-field', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const value = $(this).val().trim();
                    if (!value) return;
                    tagIndex++;
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'tags[]',
                        id: 'tag-input-' + tagIndex,
                        value
                    }).appendTo($tagsInput);
                    const $tag = $(
                        `<span class="tag">${value}<span class="tag-remove" data-index="${tagIndex}">×</span></span>`
                    );
                    $tag.insertBefore(this);
                    $(this).val('');
                }
            });
            $tagsInput.on('click', '.tag-remove', function() {
                const index = $(this).data('index');
                $(`#tag-input-${index}`).remove();
                $(this).parent().remove();
            });

            // Duration
            $('#start_date, #end_date').on('change', function() {
                campaignDuration();
            });

            function campaignDuration() {
                const d1 = new Date($('#start_date').val()),
                    d2 = new Date($('#end_date').val());
                if (!isNaN(d1) && !isNaN(d2) && d2 > d1) {
                    const diffDays = Math.ceil((d2 - d1) / (1000 * 60 * 60 * 24));
                    $previewDuration.text(diffDays + ' ngày');
                } else $previewDuration.text('0 ngày');
            }

            // Save / Draft: add status and submit
            $doc.on('click', '.btn-draft, .btn-save', function(e) {
                e.preventDefault();
                const status = $(this).hasClass('btn-draft') ? 'draft' : 'pending';
                const $form = $(this).closest('form');

                $form.find('input[name="kols[]"]').remove();
                selectedKOLs.forEach((info, id) => {
                    $form.append(`<input type="hidden" name="kols[]" value="${id}">`);
                });

                $form.find('input[name="status"]').remove();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'status',
                    value: status
                }).appendTo($form);
                $form.submit();
            });

            // Handle priority content type visibility for sales link
            $('#priority_content_type').on('change', function() {
                const value = $(this).val();
                if (value === 'video_sales' || value === 'live_sales') {
                    $('#sales_link_group').show();
                } else {
                    $('#sales_link_group').hide();
                }
            }).trigger('change');

            // Handle campaign image preview
            $('input[name="campaign_image"]').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#campaign-image-preview').html(
                            `<img src="${event.target.result}" style="max-width: 100%; height: auto; border-radius: 8px; max-height: 300px;">`
                        );
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Init
            initSelectedFromDOM();
            updateSelectedKOLs();
            updateForecast();
            campaignDuration();
        });
    </script>
@endsection
