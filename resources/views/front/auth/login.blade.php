@extends('layouts.guest')

@section('meta')
    <meta name="description" content="Login to OneUp KOL Analytics Platform">
    <title>Đăng nhập - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Auth Pages Specific Styles */
        body {
            background: linear-gradient(135deg, var(--primary-lighter) 0%, white 50%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 600px;
        }

        .auth-left {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-right {
            background: var(--gradient-blue);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .auth-right::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            top: -50%;
            right: -50%;
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .auth-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .auth-logo-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.2);
        }

        .auth-logo-text {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
        }

        .auth-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: var(--gray-600);
            margin-bottom: 2rem;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-blue);
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
        }

        .form-error {
            color: var(--danger);
            font-size: 13px;
            margin-top: 0.25rem;
            display: none;
        }

        .form-input.error+.form-error {
            display: block;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            width: 20px;
            height: 20px;
        }

        .input-group .form-input {
            padding-left: 44px;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-500);
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .checkbox-group label {
            color: var(--gray-700);
            font-size: 14px;
            cursor: pointer;
        }

        .link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .btn-auth {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-auth-primary {
            background: var(--gradient-blue);
            color: white;
            margin-bottom: 1rem;
        }

        .btn-auth-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 102, 255, 0.3);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 2rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gray-200);
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            color: var(--gray-500);
            font-size: 14px;
        }

        .social-login {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-social {
            padding: 12px;
            border: 1px solid var(--gray-300);
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
            color: var(--gray-700);
        }

        .btn-social:hover {
            border-color: var(--primary);
            background: var(--primary-lighter);
            transform: translateY(-2px);
        }

        .signup-prompt {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
            color: var(--gray-600);
        }

        .feature-list {
            list-style: none;
            margin: 2rem 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .feature-text h4 {
            font-size: 18px;
            margin-bottom: 0.25rem;
        }

        .feature-text p {
            font-size: 14px;
            opacity: 0.9;
        }

        .auth-visual {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .auth-visual img {
            max-width: 100%;
            height: auto;
        }

        .auth-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(10px);
        }

        .auth-stat {
            text-align: center;
        }

        .auth-stat-value {
            font-size: 24px;
            font-weight: 700;
            display: block;
        }

        .auth-stat-label {
            font-size: 12px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .back-to-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .back-to-home:hover {
            color: var(--primary);
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .auth-container {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .auth-right {
                display: none;
            }

            .social-login {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('page')
    <div class="auth-container">
        <!-- Left Side - Login Form -->
        <div class="auth-left">
            <div class="auth-logo">
                <div class="auth-logo-icon">📊</div>
                <div class="auth-logo-text">OneUp KOL</div>
            </div>

            <h1 class="auth-title">Chào mừng trở lại!</h1>
            <p class="auth-subtitle">Đăng nhập để xem bảng phân tích KOL của bạn</p>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" name="email" id="email" class="form-input" placeholder="Nhập email"
                            required>
                    </div>
                    <span class="form-error">Vui lòng nhập email hợp lệ</span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Mật khẩu</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Nhập mật khẩu"
                            required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <span class="form-error">Vui lòng nhập mật khẩu</span>
                </div>

                <div class="form-options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ghi nhớ mật khẩu</label>
                    </div>
                    <a href="{{ route('forgotPassword') }}" class="link">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn-auth btn-auth-primary">
                    Đăng nhập
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

            <div class="divider">
                <span>Hoặc tiếp tục với</span>
            </div>

            <div class="social-login">
                <button class="btn-social" onclick="window.location='{{ route('login.provider', 'google') }}'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    Google
                </button>
                <button class="btn-social" onclick="window.location='{{ route('login.provider', 'facebook') }}'">
                    <svg width="20" height="20" fill="#1877F2" viewBox="0 0 24 24">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                    Facebook
                </button>
            </div>

            <div class="signup-prompt">
                Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="link">Tạo tài khoản miễn phí</a>
            </div>
        </div>

        <!-- Right Side - Visual -->
        <div class="auth-right">
            <div class="auth-visual">
                <h2 style="font-size: 28px; margin-bottom: 1rem;">Mở khóa sức mạnh phân tích vượt trội</h2>
                <p style="font-size: 16px; opacity: 0.9; margin-bottom: 2rem;">
                    Tham gia cùng hơn 500 thương hiệu đang sử dụng OneUp KOL để tối ưu hóa các chiến dịch influencer trên
                    TikTok
                </p>

                <ul class="feature-list">
                    <li>
                        <div class="feature-icon">🎯</div>
                        <div class="feature-text">
                            <h4>Tìm kiếm KOL thông minh</h4>
                            <p>Tìm đúng influencer nhờ gợi ý thông minh từ AI</p>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">📊</div>
                        <div class="feature-text">
                            <h4>Phân tích theo thời gian thực</h4>
                            <p>Theo dõi hiệu quả chiến dịch theo thời gian thực</p>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">💰</div>
                        <div class="feature-text">
                            <h4>Tối ưu hóa ROI</h4>
                            <p>Tăng lợi nhuận nhờ phân tích dữ liệu thông minh</p>

                        </div>
                    </li>
                </ul>

                <div class="auth-stats">
                    <div class="auth-stat">
                        <span class="auth-stat-value">10K+</span>
                        <span class="auth-stat-label">KOLs</span>
                    </div>
                    <div class="auth-stat">
                        <span class="auth-stat-value">500+</span>
                        <span class="auth-stat-label">Nhãn hiệu</span>
                    </div>
                    <div class="auth-stat">
                        <span class="auth-stat-value">98%</span>
                        <span class="auth-stat-label">Chính xác</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                // Show error states
                if (!email) document.getElementById('email').classList.add('error');
                if (!password) document.getElementById('password').classList.add('error');
                return;
            }

            // Show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner"></span> Đang đăng nhập...';
            submitBtn.disabled = true;

            document.getElementById('loginForm').submit();
        });

        // Remove error state on input
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    </script>
@endsection
