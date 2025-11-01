@extends('layouts.creator_master')

@section('meta')
    <meta name="description" content="Account Settings - OneUp KOL Analytics Dashboard">
    <title>Cài đặt - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 0;
            background: #F8F9FA;
            min-height: 100vh;
        }

        /* Settings Header */
        .settings-header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem;
        }

        .settings-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .settings-subtitle {
            color: var(--gray-600);
            font-size: 15px;
        }

        /* Settings Layout */
        .settings-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Settings Sidebar */
        .settings-sidebar {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid var(--gray-200);
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--gray-600);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .settings-nav-item:hover {
            background: var(--gray-100);
            color: var(--primary);
        }

        .settings-nav-item.active {
            background: var(--primary-lighter);
            color: var(--primary);
        }

        .settings-nav-icon {
            width: 18px;
            height: 18px;
        }

        /* Settings Content */
        .settings-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            border: 1px solid var(--gray-200);
        }

        .settings-section {
            margin-bottom: 3rem;
        }

        .settings-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .section-description {
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 1.5rem;
        }

        /* Form Elements */
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
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .form-input:disabled {
            background: var(--gray-100);
            cursor: not-allowed;
        }

        .form-helper {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Avatar Upload */
        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: 600;
            position: relative;
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            border: 3px solid white;
            transition: all 0.2s;
        }

        .avatar-upload-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
        }

        .avatar-info {
            flex: 1;
        }

        .avatar-title {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .avatar-description {
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 0.75rem;
        }

        /* Toggle Switch */
        .toggle-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .toggle-info {
            flex: 1;
        }

        .toggle-label {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .toggle-description {
            font-size: 13px;
            color: var(--gray-600);
        }

        .toggle-switch {
            position: relative;
            width: 48px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--gray-300);
            transition: .3s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: var(--primary);
        }

        input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        /* Select Dropdown */
        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        /* Alert Cards */
        .alert-card {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: start;
            gap: 1rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .alert-success .alert-icon {
            color: var(--success);
        }

        .alert-warning .alert-icon {
            color: var(--warning);
        }

        .alert-danger .alert-icon {
            color: var(--danger);
        }

        .alert-content {
            flex: 1;
            font-size: 14px;
            color: var(--gray-700);
        }

        /* API Keys Table */
        .api-table {
            width: 100%;
            border-collapse: collapse;
        }

        .api-table th {
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

        .api-table td {
            padding: 16px 12px;
            border-bottom: 1px solid var(--gray-100);
        }

        .api-key-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .api-key-text {
            font-family: monospace;
            font-size: 13px;
            background: var(--gray-100);
            padding: 4px 8px;
            border-radius: 4px;
        }

        .api-key-hidden {
            filter: blur(4px);
        }

        .api-status {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .api-status.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .api-status.inactive {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
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

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #DC2626;
            transform: translateY(-2px);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Plans Grid */
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .plan-card {
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
            transition: all 0.3s;
        }

        .plan-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .plan-card.current {
            border-color: var(--primary);
            background: var(--primary-lighter);
        }

        .plan-badge {
            position: absolute;
            top: -12px;
            right: 20px;
            background: var(--primary);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .plan-name {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .plan-price {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .plan-period {
            font-size: 14px;
            color: var(--gray-600);
            margin-bottom: 1.5rem;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }

        .plan-feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0;
            font-size: 14px;
            color: var(--gray-700);
        }

        .plan-feature-icon {
            width: 16px;
            height: 16px;
            color: var(--success);
            flex-shrink: 0;
        }

        /* Activity Log */
        .activity-log {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 8px;
        }

        .activity-icon-wrapper {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-details {
            flex: 1;
        }

        .activity-action {
            font-size: 14px;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .activity-meta {
            display: flex;
            gap: 1rem;
            font-size: 12px;
            color: var(--gray-600);
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

            .settings-layout {
                grid-template-columns: 1fr;
            }

            .settings-sidebar {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .plans-grid {
                grid-template-columns: 1fr;
            }

            .avatar-upload {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Settings Header -->
        <div class="settings-header">
            <h1 class="settings-title">Cài đặt tài khoản</h1>
            <p class="settings-subtitle">Quản lý cài đặt và tùy chọn tài khoản của bạn</p>
        </div>

        <!-- Settings Layout -->
        <div class="settings-layout">
            <!-- Settings Sidebar -->
            <aside class="settings-sidebar">
                <a href="#profile" class="settings-nav-item active">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>

                <a href="#notifications" class="settings-nav-item">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span>Thông báo</span>
                </a>

                {{-- <a href="#security" class="settings-nav-item">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Bảo vệ</span>
                </a> --}}

                {{-- <a href="#api" class="settings-nav-item">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    <span>API Keys</span>
                </a> --}}

                {{-- <a href="#integrations" class="settings-nav-item">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-3-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <span>Tích hợp</span>
                </a>

                <a href="#billing" class="settings-nav-item">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span>Thanh toán</span>
                </a>

                <a href="#activity" class="settings-nav-item">
                    <svg class="settings-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Nhật ký hoạt động</span>
                </a> --}}
            </aside>

            <!-- Settings Content -->
            <form class="settings-content" action="{{ route('creator.setting.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Profile Section -->
                <div class="settings-section" id="profile">
                    <h2 class="section-title">Thông tin hồ sơ</h2>
                    <p class="section-description">Cập nhật thông tin cá nhân và cài đặt hồ sơ của bạn</p>

                    <!-- Avatar Upload -->
                    <div class="form-group">
                        <div class="avatar-upload">
                            <div class="avatar-preview" id="avatar-dropzone" style="position: relative;">
                                <img src="{{ asset($user->avatar ? $user->avatar : 'assets/default-avatar.jpg') }}" alt="Avatar" class="avatar-image"
                                    style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                <div class="avatar-upload-btn"
                                    style="position: absolute; right: 8px; bottom: 8px; cursor: pointer;">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </div>
                                
                                <input type="file" name="avatar" id="avatarFileInput"
                                    accept="image/png, image/jpeg, image/gif" style="display:none">
                            </div>
                            <div class="avatar-info">
                                <div class="avatar-title">Ảnh đại diện</div>
                                <div class="avatar-description">JPG, GIF or PNG. Max size 2MB</div>
                                <div style="display:flex;gap:.5rem;align-items:center;">
                                    <button type="button" class="btn btn-secondary" id="avatarChooseBtn">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        Tải ảnh mới lên
                                    </button>
                                    <div class="avatar-error text-danger"
                                        style="display:none;font-size:13px;margin-left:.5rem;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-input" value="{{old('name', $user->name)}}" name='name'>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Địa chỉ email</label>
                        <input type="email" name='email' class="form-input" value="{{ old('email', $user->email) }}">
                        <span class="form-helper">Email này sẽ được sử dụng để đăng nhập và nhận thông báo</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Số điện thoại</label>
                        <input type="tel" name='phone' class="form-input" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Công ty</label>
                            <input type="text" name="company" class="form-input"
                                value="{{ old('company', $user->company) }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Chức danh công việc</label>
                            <input type="text" name="job_title" class="form-input"
                                value="{{ old('job_title', $user->job_title) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tiểu sử</label>
                        <textarea class="form-input" name="description" rows="4" 
                            placeholder="Giới thiệu bản thân...">{{ old('description', $user->description) }}</textarea>
                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="settings-section" id="notifications">
                    <h2 class="section-title">Tùy chọn thông báo</h2>
                    <p class="section-description">Chọn cách bạn muốn được thông báo về hoạt động</p>

                    <div class="toggle-group">
                        <div class="toggle-info">
                            <div class="toggle-label">Thông báo qua email</div>
                            <div class="toggle-description">Nhận cập nhật qua email về các chiến dịch của bạn</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="notifications[email_notifications]" 
                                @if(@$notifications['email_notifications']) checked @endif>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="toggle-group">
                        <div class="toggle-info">
                            <div class="toggle-label">Cảnh báo chiến dịch</div>
                            <div class="toggle-description">Nhận thông báo khi chiến dịch đạt đến cột mốc</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="notifications[campaign_alerts]"
                                @if(@$notifications['campaign_alerts']) checked @endif>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="toggle-group">
                        <div class="toggle-info">
                            <div class="toggle-label">Cập nhật nhà sáng tạo nội dung</div>
                            <div class="toggle-description">Thông báo về nhà sáng tạo nội dung đã lưu và hiệu suất của họ</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="notifications[kol_updates]"
                                @if(@$notifications['kol_updates']) checked @endif>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="toggle-group">
                        <div class="toggle-info">
                            <div class="toggle-label">Báo cáo hàng tuần</div>
                            <div class="toggle-description">Nhận tóm tắt hàng tuần về các chiến dịch của bạn</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="notifications[weekly_reports]"
                                @if(@$notifications['weekly_reports']) checked @endif>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="toggle-group">
                        <div class="toggle-info">
                            <div class="toggle-label">Cập nhật sản phẩm</div>
                            <div class="toggle-description">Tin tức về các tính năng mới và cải tiến</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="notifications[product_updates]"
                                @if(@$notifications['product_updates']) checked @endif>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Security Section -->
                {{-- <div class="settings-section" id="security">
                    <h2 class="section-title">Cài đặt bảo mật</h2>
                    <p class="section-description">Giữ tài khoản của bạn an toàn với các cài đặt này</p>

                    <div class="alert-card alert-success">
                        <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 0016 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="alert-content">
                            Tài khoản của bạn được bảo vệ bằng xác thực hai yếu tố
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-input" placeholder="Enter current password">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-input" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-input" placeholder="Confirm new password">
                        </div>
                    </div>

                    <div class="toggle-group">
                        <div class="toggle-info">
                            <div class="toggle-label">Xác thực hai yếu tố</div>
                            <div class="toggle-description">Thêm một lớp bảo mật bổ sung cho tài khoản của bạn</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phiên đăng nhập</label>
                        <div class="activity-log">
                            <div class="activity-item">
                                <div class="activity-icon-wrapper">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="activity-details">
                                    <div class="activity-action">Chrome trên Windows - Phiên hiện tại</div>
                                    <div class="activity-meta">
                                        <span>192.168.1.1</span>
                                        <span>Đang hoạt động</span>
                                    </div>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon-wrapper">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                        <path
                                            d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                    </svg>
                                </div>
                                <div class="activity-details">
                                    <div class="activity-action">Safari trên iPhone</div>
                                    <div class="activity-meta">
                                        <span>192.168.1.2</span>
                                        <span>2 giờ trước</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- API Keys Section -->
                {{-- <div class="settings-section" id="api">
                    <h2 class="section-title">API Keys</h2>
                    <p class="section-description">Quản lý khóa API của bạn để tích hợp với bên thứ ba</p>

                    <div class="alert-card alert-warning">
                        <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="alert-content">
                            Giữ khóa API của bạn an toàn. Không bao giờ chia sẻ chúng công khai hoặc cam kết chúng với cơ quan quản lý phiên bản.
                        </div>
                    </div>

                    <table class="api-table">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Khóa</th>
                                <th>Trạng thái</th>
                                <th>Đã tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Production API</td>
                                <td>
                                    <div class="api-key-display">
                                        <span class="api-key-text api-key-hidden">sk_live_abcd1234efgh5678</span>
                                        <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">
                                            Xem
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <span class="api-status active">
                                        <span
                                            style="width: 6px; height: 6px; background: currentColor; border-radius: 50%;"></span>
                                        Hoạt động
                                    </span>
                                </td>
                                <td>Jan 15, 2025</td>
                                <td>
                                    <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">
                                        Tái tạo
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Phát triển API</td>
                                <td>
                                    <div class="api-key-display">
                                        <span class="api-key-text api-key-hidden">sk_test_wxyz9876ijkl5432</span>
                                        <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">
                                            Xem
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <span class="api-status active">
                                        <span
                                            style="width: 6px; height: 6px; background: currentColor; border-radius: 50%;"></span>
                                        Hoạt động
                                    </span>
                                </td>
                                <td>Dec 20, 2024</td>
                                <td>
                                    <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;">
                                        Tái tạo
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn btn-primary" style="margin-top: 1rem;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                       Tạo khóa API mới
                    </button>
                </div> --}}

                <!-- Billing Section -->
                {{-- <div class="settings-section" id="billing">
                    <h2 class="section-title">Thanh toán & Gói cước</h2>
                    <p class="section-description">Quản lý thông tin đăng ký và thanh toán của bạn</p>

                    <div class="plans-grid">
                        <div class="plan-card">
                            <div class="plan-name">Người mới bắt đầu</div>
                            <div class="plan-price">Miễn phí</div>
                            <div class="plan-period">Mãi mãi</div>
                            <ul class="plan-features">
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Theo dõi tối đa 10 KOL
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Phân tích cơ bản
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                   1 tài khoản người dùng
                                </li>
                            </ul>
                            <button class="btn btn-secondary" style="width: 100%;">Kế hoạch hiện tại</button>
                        </div>

                        <div class="plan-card current">
                            <span class="plan-badge">Hiện hành</span>
                            <div class="plan-name">Chuyên nghiệp</div>
                            <div class="plan-price">₫2.5M</div>
                            <div class="plan-period">mỗi tháng</div>
                            <ul class="plan-features">
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Theo dõi KOL không giới hạn
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Phân tích nâng cao
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Tối đa 5 thành viên trong nhóm
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Truy cập API
                                </li>
                            </ul>
                            <button class="btn btn-primary" style="width: 100%;">Current Plan</button>
                        </div>

                        <div class="plan-card">
                            <div class="plan-name">Doanh nghiệp</div>
                            <div class="plan-price">Phong tục</div>
                            <div class="plan-period">Liên hệ bán hàng</div>
                            <ul class="plan-features">
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Mọi thứ Pro
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Số lượng thành viên trong nhóm không giới hạn
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Hỗ trợ ưu tiên
                                </li>
                                <li class="plan-feature">
                                    <svg class="plan-feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Tích hợp tùy chỉnh
                                </li>
                            </ul>
                            <button class="btn btn-secondary" style="width: 100%;">Liên hệ bán hàng</button>
                        </div>
                    </div>
                </div> --}}

                <!-- Save Button -->
                <div class="btn-group">
                    <button class="btn btn-primary">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('js')
    <script>
        // Settings page interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Settings navigation
            const settingsNavItems = document.querySelectorAll('.settings-nav-item');
            const settingsSections = document.querySelectorAll('.settings-section');

            settingsNavItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all items
                    settingsNavItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');

                    // Hide all sections
                    settingsSections.forEach(section => {
                        section.style.display = 'none';
                    });

                    // Show selected section
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.style.display = 'block';
                    }
                });
            });

            // Show/hide API keys
            document.querySelectorAll('.api-key-display button').forEach(btn => {
                btn.addEventListener('click', function() {
                    const keyText = this.previousElementSibling;
                    if (keyText.classList.contains('api-key-hidden')) {
                        keyText.classList.remove('api-key-hidden');
                        this.textContent = 'Hide';
                    } else {
                        keyText.classList.add('api-key-hidden');
                        this.textContent = 'Show';
                    }
                });
            });

            // Avatar upload (jQuery preview only)
            // This uses jQuery to handle file selection and preview into <img class="avatar-image">.
            
            (function($) {
                const $file = $('#avatarFileInput');
                const $img = $('.avatar-image');
                const $error = $('.avatar-error');
                const $drop = $('#avatar-dropzone');
                const maxSize = 2 * 1024 * 1024; // 2MB

                function showError(msg) {
                    if ($error.length) {
                        $error.text(msg).show();
                    } else {
                        alert(msg);
                    }
                }

                function clearError() {
                    if ($error.length) $error.hide().text('');
                }

                // Click handlers to open file picker
                $(document).on('click', '#avatarChooseBtn, .avatar-upload-btn', function(e) {
                    e.preventDefault();
                    $file.trigger('click');
                });

                // Drag & drop support
                $drop.on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                });
                $drop.on('dragleave drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');
                });
                $drop.on('drop', function(e) {
                    e.preventDefault();
                    const dt = e.originalEvent.dataTransfer;
                    if (dt && dt.files && dt.files.length) {
                        handleFile(dt.files[0]);
                    }
                });

                // Handle file input change
                $file.on('change', function() {
                    if (this.files && this.files[0]) {
                        handleFile(this.files[0]);
                    }
                    // clear input so selecting same file again triggers change
                    // $(this).val('');
                });

                function handleFile(file) {
                    clearError();
                    if (!file.type.match('image.*')) {
                        showError('Vui lòng chọn file ảnh (jpg, png, gif).');
                        return;
                    }
                    if (file.size > maxSize) {
                        showError('Kích thước ảnh vượt quá 2MB.');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $img.attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            })(jQuery);

            // Save changes button
            const saveBtn = document.querySelector('.btn-primary');
            if (saveBtn) {
                saveBtn.addEventListener('click', function() {
                    // Show success message
                    const alert = document.createElement('div');
                    alert.className = 'alert-card alert-success';
                    alert.style.position = 'fixed';
                    alert.style.top = '20px';
                    alert.style.right = '20px';
                    alert.style.zIndex = '1000';
                    alert.innerHTML = `
                        <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 0016 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div class="alert-content">Settings saved successfully!</div>
                    `;
                    document.body.appendChild(alert);

                    setTimeout(() => {
                        alert.remove();
                    }, 3000);
                });
            }

            // Initially show only profile section
            settingsSections.forEach((section, index) => {
                if (index !== 0) {
                    section.style.display = 'none';
                }
            });
        });
    </script>
@endsection