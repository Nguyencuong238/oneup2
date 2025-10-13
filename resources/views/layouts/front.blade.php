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
                <a href="/" class="nav-link @if(request()->routeIs('home')) active @endif">Home</a>
                <a href="{{route('kols')}}" class="nav-link @if(request()->routeIs('kols')) active @endif">KOLs</a>
                <a href="{{route('about')}}" class="nav-link @if(request()->routeIs('about')) active @endif">About</a>
                <a href="{{route('pricing')}}" class="nav-link @if(request()->routeIs('pricing')) active @endif">Pricing</a>
                <a href="{{route('resources')}}" class="nav-link @if(request()->routeIs('resources')) active @endif">Resources</a>
                <a href="{{route('help')}}" class="nav-link @if(request()->routeIs('help')) active @endif">Help</a>
                <a href="{{route('login')}}" class="btn btn-outline btn-small">Login</a>
                <a href="{{route('register')}}" class="btn btn-primary btn-small">Get Started</a>
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
</body>

</html>
