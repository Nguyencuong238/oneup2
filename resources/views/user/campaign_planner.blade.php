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
    <main class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <h1 class="page-title">Campaign Planner</h1>
            </div>

            <div class="topbar-right">
                <button class="btn btn-secondary btn-small">
                    Save Draft
                </button>
                <button class="btn btn-primary btn-small">
                    Launch Campaign
                </button>
            </div>
        </div>

        <!-- Planner Content -->
        <div class="planner-content">
            <!-- Stepper -->
            <div class="stepper-container">
                <div class="stepper">
                    <div class="step completed">
                        <div class="step-indicator">✓</div>
                        <span class="step-label">Basic Info</span>
                    </div>
                    <div class="step active">
                        <div class="step-indicator">2</div>
                        <span class="step-label">Target & Budget</span>
                    </div>
                    <div class="step">
                        <div class="step-indicator">3</div>
                        <span class="step-label">Select KOLs</span>
                    </div>
                    <div class="step">
                        <div class="step-indicator">4</div>
                        <span class="step-label">Content Brief</span>
                    </div>
                    <div class="step">
                        <div class="step-indicator">5</div>
                        <span class="step-label">Review & Launch</span>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="planner-grid">
                <!-- Left Column - Forms -->
                <div>
                    <!-- Campaign Details -->
                    <div class="form-section">
                        <h2 class="section-title">Campaign Details</h2>

                        <div class="form-group">
                            <label class="form-label">Campaign Name *</label>
                            <input type="text" class="form-input" placeholder="e.g., Summer Fashion Collection 2024"
                                value="Summer Fashion Collection 2024">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Start Date *</label>
                                <input type="date" class="form-input" value="2024-08-01">
                            </div>
                            <div class="form-group">
                                <label class="form-label">End Date *</label>
                                <input type="date" class="form-input" value="2024-08-31">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Campaign Category</label>
                            <select class="form-select">
                                <option>Fashion & Beauty</option>
                                <option>Food & Beverage</option>
                                <option>Technology</option>
                                <option>Lifestyle</option>
                                <option>Travel</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Campaign Description</label>
                            <textarea class="form-textarea" placeholder="Describe your campaign objectives and key messages...">Launch our new summer collection with focus on sustainable fashion and youth appeal. Target Gen Z audience with authentic content showcasing daily wear scenarios.</textarea>
                        </div>
                    </div>

                    <!-- Target & Budget -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Target & Budget</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Target Reach</label>
                                <input type="number" class="form-input" placeholder="1000000" value="5000000">
                                <span class="form-help">Estimated total views</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Target Engagement Rate</label>
                                <input type="number" class="form-input" placeholder="5" value="7" step="0.1">
                                <span class="form-help">Minimum engagement %</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Total Budget (VNĐ)</label>
                            <input type="number" class="form-input" placeholder="50000000" value="80000000">
                            <span class="form-help">Including KOL fees and production costs</span>
                        </div>

                        <div class="budget-calculator">
                            <div class="budget-item">
                                <span class="budget-label">KOL Fees (70%)</span>
                                <span class="budget-value">₫56,000,000</span>
                            </div>
                            <div class="budget-item">
                                <span class="budget-label">Content Production (20%)</span>
                                <span class="budget-value">₫16,000,000</span>
                            </div>
                            <div class="budget-item">
                                <span class="budget-label">Management Fee (10%)</span>
                                <span class="budget-value">₫8,000,000</span>
                            </div>
                            <div class="budget-item budget-total">
                                <span class="budget-label">Total Budget</span>
                                <span class="budget-value">₫80,000,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- KOL Selection -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Select KOLs</h2>

                        <div class="form-group">
                            <label class="form-label">Filter by Category</label>
                            <select class="form-select">
                                <option>All Categories</option>
                                <option selected>Fashion & Beauty</option>
                                <option>Lifestyle</option>
                            </select>
                        </div>

                        <div class="kol-selection-grid">
                            <div class="kol-select-card selected">
                                <input type="checkbox" class="kol-checkbox" checked>
                                <div class="kol-avatar">LN</div>
                                <div class="kol-info">
                                    <div class="kol-name">Linh Nguyễn</div>
                                    <div class="kol-stats">
                                        <span>2.3M followers</span>
                                        <span>•</span>
                                        <span>8.5% engagement</span>
                                    </div>
                                </div>
                                <div class="kol-price">
                                    <div class="price-label">Est. Price</div>
                                    <div class="price-value">₫15M</div>
                                </div>
                            </div>

                            <div class="kol-select-card selected">
                                <input type="checkbox" class="kol-checkbox" checked>
                                <div class="kol-avatar"
                                    style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">MT</div>
                                <div class="kol-info">
                                    <div class="kol-name">Minh Trần</div>
                                    <div class="kol-stats">
                                        <span>1.8M followers</span>
                                        <span>•</span>
                                        <span>6.2% engagement</span>
                                    </div>
                                </div>
                                <div class="kol-price">
                                    <div class="price-label">Est. Price</div>
                                    <div class="price-value">₫12M</div>
                                </div>
                            </div>

                            <div class="kol-select-card">
                                <input type="checkbox" class="kol-checkbox">
                                <div class="kol-avatar"
                                    style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">TH</div>
                                <div class="kol-info">
                                    <div class="kol-name">Thu Hương</div>
                                    <div class="kol-stats">
                                        <span>987K followers</span>
                                        <span>•</span>
                                        <span>9.8% engagement</span>
                                    </div>
                                </div>
                                <div class="kol-price">
                                    <div class="price-label">Est. Price</div>
                                    <div class="price-value">₫8M</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Requirements -->
                    <div class="form-section" style="margin-top: 1.5rem;">
                        <h2 class="section-title">Content Requirements</h2>

                        <div class="form-group">
                            <label class="form-label">Content Type</label>
                            <select class="form-select">
                                <option>Video (15-60s)</option>
                                <option>Video Series</option>
                                <option>Live Stream</option>
                                <option>Photo Posts</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Key Messages</label>
                            <div class="tags-input">
                                <span class="tag">
                                    Sustainable Fashion
                                    <span class="tag-remove">×</span>
                                </span>
                                <span class="tag">
                                    Summer Collection
                                    <span class="tag-remove">×</span>
                                </span>
                                <span class="tag">
                                    Youth Style
                                    <span class="tag-remove">×</span>
                                </span>
                                <input type="text" class="tag-input-field" placeholder="Add tag...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hashtags</label>
                            <input type="text" class="form-input"
                                value="#OneUpFashion #SummerVibes #SustainableStyle #GenZFashion">
                        </div>
                    </div>
                </div>

                <!-- Right Column - Preview -->
                <div class="preview-panel">
                    <!-- Campaign Preview -->
                    <div class="preview-card">
                        <h3 class="preview-title">Campaign Summary</h3>

                        <div class="preview-item">
                            <span class="preview-label">Duration</span>
                            <span class="preview-value">31 days</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Selected KOLs</span>
                            <span class="preview-value">2 KOLs</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Total Budget</span>
                            <span class="preview-value">₫80M</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Cost per KOL</span>
                            <span class="preview-value">₫40M avg</span>
                        </div>
                    </div>

                    <!-- Forecast Metrics -->
                    <div class="preview-card">
                        <h3 class="preview-title">Estimated Performance</h3>

                        <div class="forecast-grid">
                            <div class="forecast-card">
                                <div class="forecast-value">8.2M</div>
                                <div class="forecast-label">Est. Reach</div>
                            </div>
                            <div class="forecast-card">
                                <div class="forecast-value">7.5%</div>
                                <div class="forecast-label">Est. Engagement</div>
                            </div>
                            <div class="forecast-card">
                                <div class="forecast-value">₫9.7</div>
                                <div class="forecast-label">CPV</div>
                            </div>
                            <div class="forecast-card">
                                <div class="forecast-value">3.8x</div>
                                <div class="forecast-label">Est. ROI</div>
                            </div>
                        </div>
                    </div>

                    <!-- Selected KOLs -->
                    <div class="preview-card">
                        <h3 class="preview-title">Selected KOLs (2)</h3>

                        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="kol-avatar" style="width: 36px; height: 36px; font-size: 14px;">LN</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500; font-size: 14px;">Linh Nguyễn</div>
                                    <div style="font-size: 12px; color: var(--gray-600);">2.3M followers</div>
                                </div>
                                <span style="font-weight: 600; color: var(--primary);">₫15M</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="kol-avatar"
                                    style="width: 36px; height: 36px; font-size: 14px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    MT</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500; font-size: 14px;">Minh Trần</div>
                                    <div style="font-size: 12px; color: var(--gray-600);">1.8M followers</div>
                                </div>
                                <span style="font-weight: 600; color: var(--primary);">₫12M</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="planner-actions">
                <button class="btn btn-secondary">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"
                        style="margin-right: 0.5rem;">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Previous Step
                </button>

                <div class="action-buttons">
                    <button class="btn btn-secondary">Save as Draft</button>
                    <button class="btn btn-primary">
                        Next Step
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
    </main>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Initialize planner
        document.addEventListener('DOMContentLoaded', function() {
            // KOL selection
            initKOLSelection();

            // Budget calculator
            initBudgetCalculator();

            // Tags input
            initTagsInput();

            // Update forecasts
            updateForecasts();
        });

        function initKOLSelection() {
            document.querySelectorAll('.kol-select-card').forEach(card => {
                const checkbox = card.querySelector('.kol-checkbox');

                card.addEventListener('click', function(e) {
                    if (!e.target.classList.contains('kol-checkbox')) {
                        checkbox.checked = !checkbox.checked;
                        card.classList.toggle('selected', checkbox.checked);
                        updateSelectedKOLs();
                    }
                });

                checkbox.addEventListener('change', function() {
                    card.classList.toggle('selected', this.checked);
                    updateSelectedKOLs();
                });
            });
        }

        function updateSelectedKOLs() {
            const selected = document.querySelectorAll('.kol-checkbox:checked').length;
            document.querySelector('.preview-item:nth-child(2) .preview-value').textContent = `${selected} KOLs`;

            // Update cost calculation
            let totalKOLCost = 0;
            document.querySelectorAll('.kol-select-card.selected').forEach(card => {
                const priceText = card.querySelector('.price-value').textContent;
                const price = parseInt(priceText.replace(/[^\d]/g, '')) * 1000000;
                totalKOLCost += price;
            });

            if (selected > 0) {
                const avgCost = totalKOLCost / selected / 1000000;
                document.querySelector('.preview-item:nth-child(4) .preview-value').textContent =
                    `₫${avgCost.toFixed(0)}M avg`;
            }
        }

        function initBudgetCalculator() {
            const budgetInput = document.querySelector('input[placeholder="50000000"]');
            budgetInput.addEventListener('input', function() {
                const budget = parseInt(this.value) || 0;

                // Update budget breakdown
                document.querySelector('.budget-item:nth-child(1) .budget-value').textContent =
                    `₫${(budget * 0.7 / 1000000).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}M`;
                document.querySelector('.budget-item:nth-child(2) .budget-value').textContent =
                    `₫${(budget * 0.2 / 1000000).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}M`;
                document.querySelector('.budget-item:nth-child(3) .budget-value').textContent =
                    `₫${(budget * 0.1 / 1000000).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}M`;
                document.querySelector('.budget-total .budget-value').textContent =
                    `₫${(budget / 1000000).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}M`;
            });
        }

        function initTagsInput() {
            const tagInput = document.querySelector('.tag-input-field');
            const tagsContainer = document.querySelector('.tags-input');

            tagInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const value = this.value.trim();
                    if (value) {
                        const tag = document.createElement('span');
                        tag.className = 'tag';
                        tag.innerHTML = `${value}<span class="tag-remove">×</span>`;
                        tagsContainer.insertBefore(tag, this);
                        this.value = '';

                        tag.querySelector('.tag-remove').addEventListener('click', function() {
                            tag.remove();
                        });
                    }
                }
            });

            // Remove existing tags
            document.querySelectorAll('.tag-remove').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
        }

        function updateForecasts() {
            // Simulate forecast calculation based on selected KOLs and budget
            const selected = document.querySelectorAll('.kol-checkbox:checked').length;
            if (selected > 0) {
                // Update forecast values with animation
                animateValue(document.querySelector('.forecast-card:nth-child(1) .forecast-value'), 0, 8.2, 1000, 'M');
                animateValue(document.querySelector('.forecast-card:nth-child(2) .forecast-value'), 0, 7.5, 1000, '%');
            }
        }

        function animateValue(element, start, end, duration, suffix) {
            const range = end - start;
            const increment = range / (duration / 10);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                if (current >= end) {
                    current = end;
                    clearInterval(timer);
                }

                element.textContent = current.toFixed(1) + (suffix || '');
            }, 10);
        }
    </script>
@endsection
