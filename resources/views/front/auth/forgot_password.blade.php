@extends('layouts.guest')

@section('meta')
    <meta name="description" content="Reset your OneUp KOL Analytics password">
    <title>Quên mật khẩu - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Inherit auth styles */
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
            max-width: 480px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 3rem;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .auth-logo-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-blue);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.2);
        }

        .auth-logo-text {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
        }

        .auth-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .auth-subtitle {
            color: var(--gray-600);
            margin-bottom: 2rem;
            font-size: 16px;
            text-align: center;
            line-height: 1.6;
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

        .btn-auth-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-auth-secondary:hover {
            border-color: var(--primary);
            background: var(--primary-lighter);
        }

        .link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
            color: var(--gray-600);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .success-state {
            display: none;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
            color: var(--success);
        }

        .success-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }

        .success-message {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .reset-steps {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .reset-step {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .reset-step:last-child {
            margin-bottom: 0;
        }

        .step-number {
            width: 28px;
            height: 28px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .step-description {
            font-size: 14px;
            color: var(--gray-600);
            line-height: 1.5;
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 1rem;
            background: var(--primary-lighter);
            border-radius: 8px;
            margin-top: 1.5rem;
        }

        .security-icon {
            color: var(--primary);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .security-text {
            font-size: 13px;
            color: var(--gray-700);
            line-height: 1.5;
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

        @media (max-width: 540px) {
            .auth-container {
                padding: 2rem;
                margin: 1rem;
            }

            .auth-title {
                font-size: 24px;
            }

            .reset-steps {
                padding: 1rem;
            }
        }
    </style>
@endsection

@section('page')
    <div class="auth-container">
        <!-- Logo -->
        <div class="auth-logo">
            <div class="auth-logo-icon">📊</div>
            <div class="auth-logo-text">OneUp KOL</div>
        </div>

        <!-- Reset Form State -->
        <div id="resetForm">
            <h1 class="auth-title">Quên mật khẩu?</h1>
            <p class="auth-subtitle">
                Đừng lo! Nhập địa chỉ email của bạn và chúng tôi sẽ gửi hướng dẫn đặt lại mật khẩu.
            </p>

            <form id="forgotPasswordForm">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" id="email" class="form-input" placeholder="Nhập email" required>
                    </div>
                    <span class="form-error">Vui lòng nhập email hợp lệ</span>
                </div>

                <button type="submit" class="btn-auth btn-auth-primary">
                    Gửi hướng dẫn đặt lại mật khẩu
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </button>
            </form>

            <div class="reset-steps">
                <div class="reset-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-title">Kiểm tra email của bạn</div>
                        <div class="step-description">Chúng tôi sẽ gửi link đặt lại mật khẩu vào email của bạn</div>
                    </div>
                </div>
                <div class="reset-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-title">Bấm vào liên kết đặt lại mật khẩu</div>
                        <div class="step-description">Hãy mở email và bấm vào liên kết đặt lại mật khẩu an toàn</div>
                    </div>
                </div>
                <div class="reset-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-title">Tạo mật khẩu mới</div>
                        <div class="step-description">Hãy tạo một mật khẩu mới thật mạnh cho tài khoản của bạn</div>
                    </div>
                </div>
            </div>

            <div class="security-note">
                <svg class="security-icon" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <div class="security-text">
                    Vì lý do bảo mật, liên kết đặt lại mật khẩu chỉ có hiệu lực trong 1 giờ. Nếu sau 5 phút bạn vẫn chưa
                    nhận được email, vui lòng kiểm tra thư mục spam.
                </div>
            </div>

            <a href="{{ route('login') }}" class="back-link">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Quay lại đăng nhập
            </a>
        </div>

        <!-- Success State -->
        <div id="successState" class="success-state">
            <div class="success-icon">
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <h2 class="success-title">Kiểm tả email của bạn!</h2>
            <p class="success-message">
                Chúng tôi đã gửi hướng dẫn khôi phục mật khẩu đến<br>
                <strong id="emailDisplay">địa chỉ email của bạn</strong>
            </p>

            <button onclick="openEmailClient()" class="btn-auth btn-auth-primary">
                Mở email
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                </svg>
            </button>

            <button onclick="resendEmail()" class="btn-auth btn-auth-secondary">
                Gửi lại
            </button>

            <div class="security-note">
                <svg class="security-icon" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div class="security-text">
                    Nếu bạn chưa nhận được email, vui lòng kiểm tra thư mục spam hoặc thử gửi lại. Trường hợp vẫn gặp vấn
                    đề, hãy liên hệ với bộ phận hỗ trợ của chúng tôi.
                </div>
            </div>

            <a href="{{ route('login') }}" class="back-link">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Quay lại đăng nhập
            </a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Form submission
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const emailInput = document.getElementById('email');

            // Reset error state
            emailInput.classList.remove('error');

            // Basic email validation
            if (!email || !email.includes('@')) {
                emailInput.classList.add('error');
                return;
            }

            // Show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner"></span> Đang gửi...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success state
                document.getElementById('resetForm').style.display = 'none';
                document.getElementById('successState').style.display = 'block';
                document.getElementById('emailDisplay').textContent = email;

                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });

        // Remove error state on input
        document.getElementById('email').addEventListener('input', function() {
            this.classList.remove('error');
        });

        // Open email client
        function openEmailClient() {
            window.location.href = 'mailto:';
        }

        // Resend email
        function resendEmail() {
            const resendBtn = event.target;
            const originalText = resendBtn.innerHTML;

            resendBtn.innerHTML = '<span class="spinner"></span> Đang gửi lại...';
            resendBtn.disabled = true;

            setTimeout(() => {
                resendBtn.innerHTML = originalText;
                resendBtn.disabled = false;
                alert('Hướng dẫn khôi phục mật khẩu đã được gửi lại đến địa chỉ email của bạn.');
            }, 2000);
        }

        // Add spinner styles if not exists
        if (!document.getElementById('spinner-styles')) {
            const styles = document.createElement('style');
            styles.id = 'spinner-styles';
            styles.innerHTML = `
                .spinner {
                    display: inline-block;
                    width: 16px;
                    height: 16px;
                    border: 2px solid rgba(255, 255, 255, 0.3);
                    border-top-color: white;
                    border-radius: 50%;
                    animation: spin 0.8s linear infinite;
                }
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(styles);
        }
    </script>
@endsection
