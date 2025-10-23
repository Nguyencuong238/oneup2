<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('meta')

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
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

        .page-title {
            margin-bottom: 0;
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

        .nav-badge {
            margin-left: auto;
            padding: 2px 8px;
            background: var(--danger);
            color: white;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
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


        .sidebar-footer .dropdown-info {
            display: none;
            background: #fff;
            width: 100%;
            border-radius: 4px;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .sidebar-footer.active .dropdown-info {
            display: block;
        }

        .dropdown-info .nav-link {
            padding: 10px 15px;
            display: block;
            white-space: nowrap;
        }

        .dropdown-info .nav-link:hover::after {
            display: none;
        }

        button:focus,
        a:focus {
            outline: none;
        }
    </style>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('css')
</head>

<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/" class="sidebar-logo">
                    <div class="sidebar-logo-icon">📊</div>
                    <div class="sidebar-logo-text">OneUp KOL</div>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('creator.dashboard') }}"
                    class="nav-item @if (request()->routeIs('creator.dashboard')) active @endif">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Bảng điều khiển</span>
                </a>

                <a href="{{ route('creator.campaign.index') }}"
                    class="nav-item @if (request()->routeIs('creator.campaign.index')) active @endif">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Chiến dịch</span>
                    {{-- <span class="nav-badge">3</span> --}}
                </a>

                <a href="{{ route('creator.analytic') }}" class="nav-item @if (request()->routeIs('creator.analytic')) active @endif">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Phân tích</span>
                </a>

                <a href="{{ route('creator.report') }}" class="nav-item @if (request()->routeIs('creator.report')) active @endif">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v8m5-4h4" />
                    </svg>
                    <span>Báo cáo</span>
                </a>

                <a href="{{ route('creator.setting') }}" class="nav-item @if (request()->routeIs('creator.setting')) active @endif">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Cài đặt</span>
                </a>

                <a href="{{ route('creator.billing') }}" class="nav-item @if (request()->routeIs('creator.billing')) active @endif">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span>Thanh toán</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-profile" onclick="this.parentElement.classList.toggle('active')">
                    @php
                        $auth = auth()->user();
                        $name = $auth->name;
                        $userAvatar = getFirstCharacter($name);
                    @endphp
                    <div class="user-avatar">{{ getFirstCharacter($name) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ $name }}</div>
                        <div class="user-role color-gray-600">Nhà sáng tạo</div>
                    </div>
                    <svg width="20" height="20" fill="" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="dropdown-info">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="icon-switch2"></i> {{ __('Đăng xuất') }}
                        </a>
                    </form>
                </div>
            </div>
        </aside>
        @yield('page')
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function numberFormat(number, decimal = 0, decimal_separator = ',', thousands_separator = '.') {
            const prefix = number < 0 ? '-' : '';
            const absNumber = Math.abs(number);

            const rounded = Math.round(absNumber * Math.pow(10, decimal)) / Math.pow(10, decimal);

            const valueToFormat = (number > 0 && rounded === 0) ? absNumber : rounded;

            let parts = valueToFormat.toString().split('.');

            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_separator);

            return prefix + parts.join(decimal_separator);
        }

        // Format number with K, M, B suffixes
        function formatDisplayNumber(num, decimal = 2) {
            if (num >= 1000000000) {
                return (num / 1000000000).toFixed(decimal)-0 + 'B';
            }
            if (num >= 1000000) {
                return (num / 1000000).toFixed(decimal)-0 + 'M';
            }
            if (num >= 1000) {
                return (num / 1000).toFixed(decimal)-0 + 'K';
            }
            return num.toString();
        }
    </script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('errors'))
            toastr.error("{{ session('errors')->first() }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @yield('js')
</body>

</html>
