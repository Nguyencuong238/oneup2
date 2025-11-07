<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="OneUp KOL Analytics - Platform phân tích và quản lý TikTok Nhà sáng tạo nội dung Marketing hàng đầu Việt Nam">
    <title>OneUp Nhà sáng tạo nội dung Analytics - TikTok Influencer Marketing Platform</title>

    {{-- <img src="{{ asset('assets/logo.png') }}" alt="OneUp KOL Logo" style="max-height:65px;"> --}}
    <link rel="icon" type="image/png" href="{{  asset('assets/logo.png') }}">


    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>


    <style>
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
            border-radius: 50%;
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
            color: var(--gray-600);
            font-size: 14px;
        }

        .user-dropdown-container {
            position: relative;
        }

        .dropdown-info {
            position: absolute;
            z-index: 100;
        }

        .user-dropdown-container .dropdown-info {
            display: none;
            background: #fff;
            width: 100%;
            border-radius: 4px;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .user-dropdown-container.active .dropdown-info {
            display: block;
        }

        nav {
            position: relative;
        }

        .dropdown-info .nav-link {
            padding: 10px 15px;
            display: block;
        }

        .dropdown-info .nav-link:hover::after {
            display: none;
        }
    </style>

    <style>
        .language-dropdown {
            position: relative;
            display: inline-block;
            font-family: Arial, sans-serif;
        }

        .language-btn {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 6px 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .language-btn img {
            width: 20px;
            height: 15px;
            border-radius: 2px;
        }

        .language-btn .arrow {
            font-size: 12px;
            margin-left: 4px;
            color: #777;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            border-radius: 8px;
            min-width: 140px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            margin-top: 6px;
            z-index: 99;
            overflow: hidden;
        }

        .dropdown-content a {
            color: #333;
            padding: 8px 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-content a:hover {
            background-color: #f5f5f5;
        }

        .dropdown-content img {
            width: 20px;
            height: 15px;
            border-radius: 2px;
        }
    </style>

    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            z-index: 1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .modal-close:hover {
            background: #F0F0F0;
        }

        @media (max-width: 768px) {
            .modal-content {
                padding: 1rem;
            }
            .footer-brand {
                max-width: 100%;
            }
            .nav-container .nav-links {
                gap: 20px;
                align-items: start;
            }
        }
    </style>

    @yield('css')
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">
                <img src="{{ asset('assets/logo.png') }}" alt="OneUp KOL Logo" style="max-height:65px;">
            </a>

            <div class="nav-links">
                <a href="/" class="nav-link @if (request()->routeIs('home')) active @endif">Trang chủ</a>
                <a href="{{ route('kols') }}" class="nav-link @if (request()->routeIs('kols')) active @endif">Nhà sáng tạo nội dung</a>
                <a href="{{ route('about') }}" class="nav-link @if (request()->routeIs('about')) active @endif">Về chúng
                    tôi</a>
                <a href="{{ route('pricing') }}" class="nav-link @if (request()->routeIs('pricing')) active @endif">Bảng
                    giá</a>
                <a href="{{ route('resources') }}" class="nav-link @if (request()->routeIs('resources')) active @endif">Tin
                    tức</a>
                <a href="{{ route('help') }}" class="nav-link @if (request()->routeIs('help')) active @endif">Hỗ
                    trợ</a>

                {{-- <div class="language-dropdown">
                    <button class="language-btn" onclick="toggleDropdown()">
                        <img src="https://flagcdn.com/24x18/{{ app()->getLocale() == 'vi' ? 'vn' : 'us' }}.png" alt="flag">
                        <span>{{ app()->getLocale() == 'vi' ? 'Tiếng Việt' : 'English' }}</span>
                        <span class="arrow">▼</span>
                    </button>

                    <div id="dropdown" class="dropdown-content">
                        <a href="{{ route('lang.switch', 'en') }}">
                            <img src="https://flagcdn.com/24x18/us.png" alt="US Flag">
                            English
                        </a>
                        <a href="{{ route('lang.switch', 'vi') }}">
                            <img src="https://flagcdn.com/24x18/vn.png" alt="VN Flag">
                            Tiếng Việt
                        </a>
                    </div>
                </div> --}}

                @auth()
                    <div class="user-dropdown-container">
                        <div class="user-profile" onclick="this.parentElement.classList.toggle('active')">
                            @php
                                $auth = auth()->user();
                                $name = $auth->name;
                                $role = $auth->getRoleNames()->first();
                                $userAvatar = getFirstCharacter($name);
                            @endphp
                            <div class="user-avatar">{{ getFirstCharacter($name) }}</div>
                            <div class="user-info">
                                <div class="user-name">{{ $name }}</div>
                            </div>
                            <svg width="20" height="20" fill="#475569" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="dropdown-info">
                            <a href="{{ auth()->user()->type == 'brand' ? route('brand.dashboard') : route('creator.dashboard') }}"
                                class="nav-link" style="white-space: nowrap;">Bảng điều khiển</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();this.closest('form').submit();">
                                    <i class="icon-switch2"></i> {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-small">{{ __('Log In') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-small">Bắt đầu</a>
                @endauth

            </div>

            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('page')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-brand">
                    {{-- <div class="footer-logo">
                        <a href="/">
                            <img src="{{ asset('assets/logo.png') }}" alt="OneUp KOL Logo" style="max-height:65px;">
                        </a>
                    </div> --}}
                    <p class="footer-description">
                        Nền tảng phân tích Nhà sáng tạo nội dung Creator Community toàn diện nhất dành cho thị trường Việt Nam.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">f</a>
                        <a href="#" class="social-link">t</a>
                        <a href="#" class="social-link">in</a>
                        <a href="#" class="social-link">@</a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4>Công ty</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('resources') }}">Tin tức</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Hỗ trợ</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('help') }}">Trung tâm trợ giúp</a></li>
                        <li><a href="{{ route('privacy') }}">Chính sách bảo mật </a></li>
                        <li><a href="{{ route('terms') }}">Điều khoản dịch vụ</a></li>
                        <li><a href="{{ route('resources') }}">Tài liệu</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Sản phẩm</h4>
                    <ul class="footer-links">
                        <li><a href="#">Dịch vụ kết nối nhà sáng tạo nội dung</a></li>
                        <li><a href="#">Dịch vụ tư vấn và setup chiến dịch</a></li>
                        <li><a href="#">Dịch vụ tư vấn Marketing toàn diện</a></li>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    © 2025 OneUp.vn. Mọi quyền được bảo lưu.
                </div>
                <div class="footer-legal">
                    <a href="{{ route('privacy') }}">Chính sách bảo mật</a>
                    <a href="{{ route('terms') }}">Điều khoản dịch vụ</a>
                    <a href="#">Chính sách Cookie</a>
                </div>
            </div>
        </div>
    </footer>

    <div id="typeAccountModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h3 class="mb-3 color-dark-blue fs-30">Bạn là Nhà sáng tạo nội dung hay Nhãn hàng?</h3>
            <form id="typeAccountForm" action="{{ route('setType') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <input type="radio" name="type" id="type-kols" value="kols" class="filter-input" required>
                    <label for="type-kols" class="color-gray-600">Tôi là Nhà sáng tạo nội dung</label>
                </div>
                <div class="mb-3">
                    <input type="radio" name="type" id="type-brand" value="brand" class="filter-input" required>
                    <label for="type-brand" class="color-gray-600">Tôi là Nhãn hàng</label>
                </div>

                <button type="submit" class="btn btn-primary justify-center" style="width: 100%;">Gửi</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            document.addEventListener("click", function hideDropdown(e) {
                if (!e.target.closest(".language-dropdown")) {
                    dropdown.style.display = "none";
                    document.removeEventListener("click", hideDropdown);
                }
            });
        }
    </script>
    <script>
        // Modal Functions
        @if (auth()->check() && !auth()->user()->type)
            $('#typeAccountModal').show();
            $('body').css('overflow', 'hidden');
        @endif
    </script>
    @yield('js')
</body>

</html>
