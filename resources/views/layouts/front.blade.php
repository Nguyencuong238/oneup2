<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="OneUp KOL Analytics - Platform phân tích và quản lý TikTok KOL Marketing hàng đầu Việt Nam">
    <title>OneUp KOL Analytics - TikTok Influencer Marketing Platform</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .color-dark-blue {
            color: var(--dark-blue);
        }

        .color-dark {
            color: var(--dark);
        }

        .color-gray-100 {
            color: var(--gray-100);
        }

        .color-gray-200 {
            color: var(--gray-200);
        }

        .color-gray-300 {
            color: var(--gray-300);
        }

        .color-gray-400 {
            color: var(--gray-400);
        }

        .color-gray-500 {
            color: var(--gray-500);
        }

        .color-gray-600 {
            color: var(--gray-600);
        }

        .color-gray-700 {
            color: var(--gray-700);
        }

        .color-gray-800 {
            color: var(--gray-800);
        }

        .color-gray-900 {
            color: var(--gray-900);
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
    @yield('css')
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">
                <div class="logo-icon">📊</div>
                <span class="gradient-text">OneUp KOL</span>
            </a>

            <div class="nav-links">
                <a href="/" class="nav-link @if (request()->routeIs('home')) active @endif">Home</a>
                <a href="{{ route('kols') }}" class="nav-link @if (request()->routeIs('kols')) active @endif">KOLs</a>
                <a href="{{ route('about') }}"
                    class="nav-link @if (request()->routeIs('about')) active @endif">About</a>
                <a href="{{ route('pricing') }}"
                    class="nav-link @if (request()->routeIs('pricing')) active @endif">Pricing</a>
                <a href="{{ route('resources') }}"
                    class="nav-link @if (request()->routeIs('resources')) active @endif">Resources</a>
                <a href="{{ route('help') }}" class="nav-link @if (request()->routeIs('help')) active @endif">Help</a>
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
                            <a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a>
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
                    <a href="{{ route('user.login') }}" class="btn btn-outline btn-small">{{ __('Log In') }}</a>
                    <a href="{{ route('user.register') }}" class="btn btn-primary btn-small">Get Started</a>
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
                    <div class="footer-logo">📊 OneUp KOL</div>
                    <p class="footer-description">
                        The most comprehensive TikTok KOL analytics platform for Vietnamese market.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">f</a>
                        <a href="#" class="social-link">t</a>
                        <a href="#" class="social-link">in</a>
                        <a href="#" class="social-link">@</a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4>Product</h4>
                    <ul class="footer-links">
                        <li><a href="#">Features</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Integrations</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="help.html">Help Center</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Status</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    © 2025 OneUp.vn. All rights reserved.
                </div>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
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
    @yield('js')
</body>

</html>
