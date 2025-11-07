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
    <form class="main-content" action="{{ route('brand.campaign.store') }}" method="POST">
        @csrf

        @if ($campaign->id && !request('is_clone'))
            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
        @endif
        <!-- Thanh trên cùng -->
        <div class="topbar">
            <div class="topbar-left">
                <h1 class="page-title">Trình lập kế hoạch chiến dịch</h1>
            </div>

            <div class="topbar-right">
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
                                    <div class="kol-price">
                                        <div class="price-label">Giá ước tính</div>
                                        <div class="price-value">₫{{ formatDisplayNumber($item->price_campaign, 2) }}</div>
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
                                    <input type="hidden" name="tags[]" id="tag-input-{{$loop->index}}" value="{{ $tag->name }}">
                                @endforeach
                                <input type="text" class="tag-input-field" placeholder="Enter để thêm thẻ...">
                            </div>
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

                        <div id="selected-kols" style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                            @foreach ($campaign->kols as $item)
                                <div class="selected-kol" data-id="{{ $item->id }}" style="display: flex; align-items: center; gap: 0.75rem;">
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
            const $kolGrid = $('#kol-grid'); // use #kol-grid container
            const $previewCardList = $('.preview-card').eq(2).find('> div');
            const $previewCardHeader = $('.preview-card').eq(2).find('h3');
            const $previewFee = $('.preview-fee');
            const $previewDuration = $('.preview-duration');
            const $previewKols = $('.preview-kols');

            // Map: id (string) => info object
            let selectedKOLs = new Map();

            // Utility
            function debounce(fn, wait = 150) {
                let t;
                return function() { clearTimeout(t); t = setTimeout(() => fn.apply(this, arguments), wait); };
            }

            function numberFormat(n) { return (n||0).toLocaleString('vi-VN'); }
            function formatDisplayNumber(num, digits = 0) {
                if (num === null || num === undefined || isNaN(num)) return '0';
                return Number(num).toLocaleString('vi-VN', { minimumFractionDigits: digits, maximumFractionDigits: digits });
            }

            // Initialize selectedKOLs from checkboxes already checked (server-rendered)
            function initSelectedFromDOM() {
                selectedKOLs.clear();
                $(`#kol-grid .kol-select-card`).each(function() {
                    const $card = $(this);
                    const $chk = $card.find('.kol-checkbox').first();
                    if ($chk.length && $chk.prop('checked')) {
                        const id = String($card.data('id'));
                        const info = {
                            name: $card.find('.kol-name').text().trim(),
                            followers: $card.find('.kol-stats span').first().text().trim(),
                            price: $card.find('.price-value').text().trim(),
                            avatar: $card.find('.kol-avatar').prop('outerHTML') || ''
                        };
                        selectedKOLs.set(id, info);
                        $card.addClass('selected');
                    } else {
                        $card.removeClass('selected');
                    }
                });
            }

            // Update preview (render from selectedKOLs Map)
            function updateSelectedKOLs() {
                const count = selectedKOLs.size;
                $previewCardHeader.text(`Nhà sáng tạo nội dung đã chọn (${count})`);
                $previewKols.text(`${count} KOL`);

                const parts = [];
                let totalCost = 0;
                selectedKOLs.forEach((info, id) => {
                    const priceNum = parseFloat((info.price||'').replace(/[^\d.,]/g,'').replace(',', '.')) || 0;
                    totalCost += priceNum;
                    parts.push(`
                        <div class="selected-kol" data-id="${id}" style="display:flex;align-items:center;gap:0.75rem;">
                            ${info.avatar}
                            <div style="flex:1;">
                                <div class="fw-600 fs-14 color-gray-700">${info.name}</div>
                                <div class="fs-12 color-gray-600">${info.followers}</div>
                            </div>
                            <span style="font-weight:600;color:var(--primary);">${info.price}</span>
                            <button type="button" class="remove-selected-kol" data-id="${id}" style="background:none;border:none;color:#999;font-size:18px;cursor:pointer;">✕</button>
                        </div>
                    `);
                });

                $previewCardList.html(parts.join(''));

                if (count > 0) {
                    const avg = totalCost / count;
                    $previewFee.text(`₫${formatDisplayNumber(avg, 3)}M`);
                } else {
                    $previewFee.text('₫0');
                    $previewCardList.html('');
                }
            }

            // When user clicks card (toggle)
            $doc.on('click', '#kol-grid .kol-select-card', function(e) {
                // allow clicking directly on checkbox to also trigger change
                if ($(e.target).is('.kol-checkbox')) return;
                const $card = $(this);
                const $chk = $card.find('.kol-checkbox').first();
                if (!$chk.length) return;
                $chk.prop('checked', !$chk.prop('checked')).trigger('change');
            });

            // When checkbox change -> update Map and preview
            $doc.on('change', '#kol-grid .kol-checkbox', function() {
                const $chk = $(this);
                const $card = $chk.closest('.kol-select-card');
                const id = String($card.data('id'));
                if ($chk.prop('checked')) {
                    // add
                    const info = {
                        name: $card.find('.kol-name').text().trim(),
                        followers: $card.find('.kol-stats span').first().text().trim(),
                        price: $card.find('.price-value').text().trim(),
                        avatar: $card.find('.kol-avatar').prop('outerHTML') || ''
                    };
                    selectedKOLs.set(id, info);
                    $card.addClass('selected');
                } else {
                    // remove
                    selectedKOLs.delete(id);
                    $card.removeClass('selected');
                }
                updateSelectedKOLs();
            });

            // Remove from preview (click ✕)
            $doc.on('click', '.remove-selected-kol', function() {
                const id = String($(this).data('id'));
                // remove from Map
                selectedKOLs.delete(id);
                // uncheck checkbox in grid if present
                const $card = $(`#kol-grid .kol-select-card[data-id="${id}"]`);
                $card.removeClass('selected');
                $card.find('.kol-checkbox').prop('checked', false);
                updateSelectedKOLs();
            });

            // AJAX filter - reload grid html then restore checks from Map
            $doc.on('change', '#kol-filter', function() {
                const value = $(this).val();
                $.ajax({
                    url: "{{ route('kols.ajaxFilter') }}",
                    type: "GET",
                    data: { filter: value },
                    beforeSend() { $('#kol-grid').html('<p>Đang tải dữ liệu...</p>'); },
                    success(res) {
                        $('#kol-grid').html(res.html);

                        // restore checked from map (only set checkboxes; don't alter Map)
                        selectedKOLs.forEach((info, id) => {
                            const $card = $(`#kol-grid .kol-select-card[data-id="${id}"]`);
                            if ($card.length) {
                                $card.find('.kol-checkbox').prop('checked', true);
                                $card.addClass('selected');
                            }
                        });

                        // also initialize any checkbox listeners remain delegated so no rebind needed
                        updateSelectedKOLs();
                    },
                    error() { $('#kol-grid').html('<p>Lỗi khi tải dữ liệu.</p>'); }
                });
            });

            // Budget & forecast (reuse your original logic)
            $budgetInput.on('input', debounce(function() {
                const budget = parseInt($(this).val()) || 0;
                $('.kol-fee').text(`₫${formatDisplayNumber(budget * 0.7)}`);
                $('.produce-fee').text(`₫${formatDisplayNumber(budget * 0.2)}`);
                $('.manage-fee').text(`₫${formatDisplayNumber(budget * 0.1)}`);
                $('.totalBudget, .preview-budget').text(`₫${formatDisplayNumber(budget)}`);
            }, 150));

            $doc.on('input', 'input[name="target_reach"], input[name="target_engagement"]', debounce(function() {
                updateForecastFromInputs();
            }, 150));

            function updateForecastFromInputs() {
                const reach = parseInt($('input[name="target_reach"]').val()) || 0;
                const engagement = parseFloat($('input[name="target_engagement"]').val()) || 0;
                const budget = parseInt($budgetInput.val()) || 0;
                $('.forecast-card').eq(0).find('.forecast-value').text(reach > 0 ? numberFormat(reach) : '0');
                $('.forecast-card').eq(1).find('.forecast-value').text(engagement > 0 ? numberFormat(engagement) + '%' : '0%');
                const cpv = reach > 0 ? (budget / reach) : 0;
                $('.forecast-card').eq(2).find('.forecast-value').text(cpv > 0 ? '₫' + numberFormat(cpv) : '₫0');
                const roi = budget > 0 ? ((reach * (engagement / 100)) / (budget / 1000000)) : 0;
                $('.forecast-card').eq(3).find('.forecast-value').text(roi > 0 ? numberFormat(roi) + 'x' : '0x');
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
                    $('<input>').attr({ type: 'hidden', name: 'tags[]', id: 'tag-input-' + tagIndex, value }).appendTo($tagsInput);
                    const $tag = $(`<span class="tag">${value}<span class="tag-remove" data-index="${tagIndex}">×</span></span>`);
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
            $('#start_date, #end_date').on('change', function(){ campaignDuration(); });
            function campaignDuration() {
                const d1 = new Date($('#start_date').val()), d2 = new Date($('#end_date').val());
                if (!isNaN(d1) && !isNaN(d2) && d2 > d1) {
                    const diffDays = Math.ceil((d2 - d1)/(1000*60*60*24));
                    $previewDuration.text(diffDays + ' ngày');
                } else $previewDuration.text('0 ngày');
            }

            // Save / Draft: add status and submit
            $doc.on('click', '.btn-draft, .btn-save', function(e) {
                e.preventDefault();
                const status = $(this).hasClass('btn-draft') ? 'draft' : 'pending';
                const $form = $(this).closest('form');
                // ensure checkboxes reflect Map: in case any selectedKOL doesn't have checkbox in DOM (e.g., filtered out),
                // we can't create hidden inputs here because earlier we avoided duplication; instead we must ensure checkboxes exist.
                // However normally the grid contains all KOL options; if some selectedKOLs are currently filtered out (not in DOM),
                // we append hidden inputs here for those missing IDs so server still receives them.
                $form.find('input[name="kols_hidden[]"]').remove(); // cleanup previous
                selectedKOLs.forEach((info, id) => {
                    // if checkbox for this id not present in DOM currently, add a hidden input to submit it
                    if ($form.find(`input[name="kols[]"][value="${id}"]`).length === 0) {
                        $form.append(`<input type="hidden" name="kols_hidden[]" value="${id}">`);
                    }
                });

                $form.find('input[name="status"]').remove();
                $('<input>').attr({ type: 'hidden', name: 'status', value: status }).appendTo($form);
                $form.submit();
            });

            // On submit in controller, merge kols_hidden into kols: in PHP you can do:
            // $kols = array_merge($request->input('kols', []), $request->input('kols_hidden', []));

            // Init: read existing checked boxes => populate Map, render preview, run forecast/duration
            initSelectedFromDOM();
            updateSelectedKOLs();
            updateForecastFromInputs();
            campaignDuration();
        });
    </script>
@endsection


