@extends('layouts.front')

@section('css')
    <style>
        /* Additional styles for homepage */
        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-text h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--dark-blue);
        }

        .hero-visual {
            position: relative;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .hero-stat {
            text-align: left;
        }

        .hero-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .hero-stat-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .kol-showcase {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-xl);
            position: relative;
        }

        .kol-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .kol-card-mini {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--gray-100);
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .kol-card-mini:hover {
            background: var(--primary-lighter);
            transform: translateX(5px);
        }

        .kol-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .kol-info-mini {
            flex: 1;
        }

        .kol-name-mini {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .kol-followers {
            font-size: 12px;
            color: var(--gray-600);
        }

        .kol-engagement {
            padding: 2px 6px;
            background: var(--success);
            color: white;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .trust-badges {
            display: flex;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            flex-wrap: wrap;
        }

        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .trust-badge span {
            color: var(--dark-blue);
        }

        .trust-badge-icon {
            width: 24px;
            height: 24px;
            color: var(--primary);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-box {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .feature-box:hover::before {
            transform: scaleX(1);
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .feature-number {
            width: 32px;
            height: 32px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .kol-list-section {
            background: var(--gray-100);
            padding: 4rem 0;
        }

        .kol-filter-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .filter-tab {
            padding: 0.5rem 1.5rem;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .filter-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .kol-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .kol-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .kol-table th {
            background: var(--gray-100);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--gray-200);
        }

        .kol-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-200);
            color: var(--dark-blue);
        }

        .kol-table tr:hover {
            background: var(--primary-lighter);
        }

        .kol-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .kol-avatar-large {
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

        .kol-details {
            flex: 1;
        }

        .kol-handle {
            font-size: 12px;
            color: var(--gray-600);
        }

        .metric-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .metric-badge.high {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .metric-badge.medium {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .metric-badge.low {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .cta-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .cta-features {
            list-style: none;
            margin: 2rem 0;
        }

        .cta-features li {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
        }

        .cta-features li::before {
            content: '✓';
            width: 24px;
            height: 24px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .section-dark .section-title {
            color: var(--gray-100)
        }

        .section-dark .card-title,
        .section-dark h1,
        .section-dark h2,
        .section-dark h3,
        .section-dark h4,
        .section-dark h5,
        .section-dark h6 {
            color: var(--dark-blue);
        }
        .section-dark p {
            color: var(--gray-600);
        }


        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .cta-split {
                grid-template-columns: 1fr;
            }

            .kol-table {
                overflow-x: auto;
            }

            .kol-table table {
                min-width: 600px;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 140px 0 80px;">
        <div class="hero-content">
            <div class="hero-text fade-in">
                <div class="badge badge-primary mb-3">🚀 AI-Powered Platform</div>
                <h1>
                    Discover & Analyze <span class="gradient-text">TikTok KOLs</span>
                    That Drive Results
                </h1>
                <p style="font-size: 1.25rem; color: var(--gray-600); margin-bottom: 2rem;">
                    Access real-time data on 10,000+ Vietnamese TikTok creators.
                    Make data-driven decisions with confidence.
                </p>

                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('user.register') }}" class="btn btn-primary btn-large">
                        Start Free Trial
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" />
                        </svg>
                    </a>
                    <a href="#demo" class="btn btn-outline btn-large">
                        Watch Demo
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-value">10,000+</div>
                        <div class="hero-stat-label">Verified KOLs</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">2.5B+</div>
                        <div class="hero-stat-label">Total Reach</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">98%</div>
                        <div class="hero-stat-label">Accuracy Rate</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual fade-in" style="animation-delay: 0.2s;">
                <div class="kol-showcase">
                    <h4 style="margin-bottom: 1.5rem; color: var(--dark-blue);">🔥 Trending KOLs Today</h4>
                    <div class="kol-grid">
                        <div class="kol-card-mini">
                            <div class="kol-avatar">NT</div>
                            <div class="kol-info-mini">
                                <div class="kol-name-mini">Ngọc Trinh</div>
                                <div class="kol-followers">2.8M followers</div>
                            </div>
                            <div class="kol-engagement">5.8%</div>
                        </div>
                        <div class="kol-card-mini">
                            <div class="kol-avatar">MH</div>
                            <div class="kol-info-mini">
                                <div class="kol-name-mini">Minh Hằng</div>
                                <div class="kol-followers">1.5M followers</div>
                            </div>
                            <div class="kol-engagement">7.2%</div>
                        </div>
                        <div class="kol-card-mini">
                            <div class="kol-avatar">TL</div>
                            <div class="kol-info-mini">
                                <div class="kol-name-mini">Thùy Linh</div>
                                <div class="kol-followers">890K followers</div>
                            </div>
                            <div class="kol-engagement">9.1%</div>
                        </div>
                        <div class="kol-card-mini">
                            <div class="kol-avatar">HA</div>
                            <div class="kol-info-mini">
                                <div class="kol-name-mini">Hương An</div>
                                <div class="kol-followers">650K followers</div>
                            </div>
                            <div class="kol-engagement">8.5%</div>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <a href="#kol-list" style="color: var(--primary); font-weight: 600;">
                            View All KOLs →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section style="background: var(--gray-100); padding: 2rem 0;">
        <div class="container">
            <div class="trust-badges">
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 1 1 0 000 2H6a2 2 0 100 4h2a2 2 0 100-4h2a1 1 0 100-2 2 2 0 00-2 2v11a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2H6z" />
                    </svg>
                    <span>Real-time Data</span>
                </div>
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                    </svg>
                    <span>Verified Profiles</span>
                </div>
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                    <span>Advanced Analytics</span>
                </div>
                <div class="trust-badge">
                    <svg class="trust-badge-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" />
                    </svg>
                    <span>Secure Platform</span>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section section-dark">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">HOW IT WORKS</div>
                <h2 class="section-title fade-in">Your Success in 4 Simple Steps</h2>
            </div>

            <div class="grid grid-3">
                <div class="feature-box fade-in">
                    <div class="feature-number">1</div>
                    <h4>Search & Filter</h4>
                    <p>Use advanced filters to find KOLs by niche, location, followers, engagement rate, and more.</p>
                </div>

                <div class="feature-box fade-in" style="animation-delay: 0.1s;">
                    <div class="feature-number">2</div>
                    <h4>Analyze Performance</h4>
                    <p>Review detailed metrics including audience demographics, content performance, and authenticity
                        scores.</p>
                </div>

                <div class="feature-box fade-in" style="animation-delay: 0.2s;">
                    <div class="feature-number">3</div>
                    <h4>Plan Campaign</h4>
                    <p>Use AI recommendations to select the optimal KOL mix for your budget and objectives.</p>
                </div>

                <div class="feature-box fade-in" style="animation-delay: 0.3s;">
                    <div class="feature-number">4</div>
                    <h4>Track Results</h4>
                    <p>Monitor real-time performance, ROI, and get actionable insights to optimize your campaigns.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KOL List Section -->
    <section id="kol-list" class="kol-list-section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">TOP PERFORMERS</div>
                <h2 class="section-title fade-in">Featured TikTok KOLs</h2>
                <p class="section-description fade-in">
                    Discover verified influencers with proven track records
                </p>
            </div>

            <div class="kol-filter-tabs">
                <button class="filter-tab active">All Categories</button>
                <button class="filter-tab">Fashion</button>
                <button class="filter-tab">Beauty</button>
                <button class="filter-tab">Food</button>
                <button class="filter-tab">Tech</button>
                <button class="filter-tab">Travel</button>
                <button class="filter-tab">Lifestyle</button>
            </div>

            <div class="kol-table">
                <table>
                    <thead>
                        <tr>
                            <th>KOL Profile</th>
                            <th>Category</th>
                            <th>Followers</th>
                            <th>Engagement</th>
                            <th>Avg. Views</th>
                            <th>Trust Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="kol-profile">
                                    <div class="kol-avatar-large">NT</div>
                                    <div class="kol-details">
                                        <div style="font-weight: 600;">Ngọc Trinh</div>
                                        <div class="kol-handle">@ngoctrinh.official</div>
                                    </div>
                                </div>
                            </td>
                            <td>Fashion</td>
                            <td><strong>2.8M</strong></td>
                            <td><span class="metric-badge high">5.8%</span></td>
                            <td>450K</td>
                            <td><span class="metric-badge high">92/100</span></td>
                            <td>
                                <button class="btn btn-primary btn-small">View Profile</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="kol-profile">
                                    <div class="kol-avatar-large">ST</div>
                                    <div class="kol-details">
                                        <div style="font-weight: 600;">Sơn Tùng</div>
                                        <div class="kol-handle">@sontung.mtp</div>
                                    </div>
                                </div>
                            </td>
                            <td>Music</td>
                            <td><strong>4.2M</strong></td>
                            <td><span class="metric-badge high">7.2%</span></td>
                            <td>850K</td>
                            <td><span class="metric-badge high">95/100</span></td>
                            <td>
                                <button class="btn btn-primary btn-small">View Profile</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="kol-profile">
                                    <div class="kol-avatar-large">CP</div>
                                    <div class="kol-details">
                                        <div style="font-weight: 600;">Chi Pu</div>
                                        <div class="kol-handle">@chipupu</div>
                                    </div>
                                </div>
                            </td>
                            <td>Entertainment</td>
                            <td><strong>1.5M</strong></td>
                            <td><span class="metric-badge medium">3.2%</span></td>
                            <td>220K</td>
                            <td><span class="metric-badge medium">78/100</span></td>
                            <td>
                                <button class="btn btn-primary btn-small">View Profile</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="kol-profile">
                                    <div class="kol-avatar-large">LH</div>
                                    <div class="kol-details">
                                        <div style="font-weight: 600;">Lan Hương</div>
                                        <div class="kol-handle">@lanhuong.beauty</div>
                                    </div>
                                </div>
                            </td>
                            <td>Beauty</td>
                            <td><strong>890K</strong></td>
                            <td><span class="metric-badge high">8.5%</span></td>
                            <td>180K</td>
                            <td><span class="metric-badge high">88/100</span></td>
                            <td>
                                <button class="btn btn-primary btn-small">View Profile</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="kol-profile">
                                    <div class="kol-avatar-large">TN</div>
                                    <div class="kol-details">
                                        <div style="font-weight: 600;">Thanh Nam</div>
                                        <div class="kol-handle">@thanhnam.tech</div>
                                    </div>
                                </div>
                            </td>
                            <td>Technology</td>
                            <td><strong>650K</strong></td>
                            <td><span class="metric-badge high">9.2%</span></td>
                            <td>150K</td>
                            <td><span class="metric-badge high">90/100</span></td>
                            <td>
                                <button class="btn btn-primary btn-small">View Profile</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('user.register') }}" class="btn btn-primary btn-large">
                    View All 10,000+ KOLs
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">POWERFUL FEATURES</div>
                <h2 class="section-title color-gray-100 fade-in">Everything You Need to Succeed</h2>
            </div>

            <div class="grid grid-2">
                <div class="feature-card fade-in">
                    <div class="feature-icon">🔍</div>
                    <h3 class="card-title">Smart Discovery</h3>
                    <p class="card-description color-gray-500">
                        AI-powered search with 50+ filters to find perfect KOLs for your brand
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.1s">
                    <div class="feature-icon">📊</div>
                    <h3 class="card-title">Real-time Analytics</h3>
                    <p class="card-description color-gray-500">
                        Track performance metrics, engagement rates, and ROI in real-time
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.2s">
                    <div class="feature-icon">🎯</div>
                    <h3 class="card-title">Campaign Planner</h3>
                    <p class="card-description color-gray-500">
                        Plan, execute, and optimize campaigns with data-driven insights
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.3s">
                    <div class="feature-icon">🛡️</div>
                    <h3 class="card-title">Fraud Detection</h3>
                    <p class="card-description color-gray-500">
                        Advanced AI detects fake followers and engagement manipulation
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.4s">
                    <div class="feature-icon">💰</div>
                    <h3 class="card-title">ROI Calculator</h3>
                    <p class="card-description color-gray-500">
                        Calculate and predict campaign ROI before you spend
                    </p>
                </div>

                <div class="feature-card fade-in" style="animation-delay: 0.5s">
                    <div class="feature-icon">📈</div>
                    <h3 class="card-title">Growth Tracking</h3>
                    <p class="card-description color-gray-500">
                        Monitor KOL growth trends and identify rising stars early
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section" style="background: var(--gray-100);">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">SUCCESS STORIES</div>
                <h2 class="section-title fade-in">Trusted by Leading Brands</h2>
            </div>

            <div class="grid grid-3">
                <div class="card fade-in">
                    <div class="d-flex gap-1 mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="mb-3" style="font-style: italic; color: var(--gray-400);">
                        "OneUp KOL helped us increase our ROI by 300% in just 3 months. The AI recommendations are
                        incredibly accurate."
                    </p>
                    <div class="d-flex align-center gap-2">
                        <div class="kol-avatar">NT</div>
                        <div>
                            <strong>Nguyễn Thảo</strong><br>
                            <small class="color-gray-500">Marketing Director, Fashion Brand</small>
                        </div>
                    </div>
                </div>

                <div class="card fade-in" style="animation-delay: 0.1s">
                    <div class="d-flex gap-1 mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="mb-3" style="font-style: italic; color: var(--gray-400);">
                        "The fraud detection feature saved us from wasting budget on fake influencers. Essential tool for
                        any marketer."
                    </p>
                    <div class="d-flex align-center gap-2">
                        <div class="kol-avatar">LM</div>
                        <div>
                            <strong>Lê Minh</strong><br>
                            <small class="color-gray-500">CEO, Tech Startup</small>
                        </div>
                    </div>
                </div>

                <div class="card fade-in" style="animation-delay: 0.2s">
                    <div class="d-flex gap-1 mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="mb-3" style="font-style: italic; color: var(--gray-400);">
                        "Real-time tracking helps us optimize campaigns on the fly. We've seen 5x improvement in engagement
                        rates."
                    </p>
                    <div class="d-flex align-center gap-2">
                        <div class="kol-avatar">PH</div>
                        <div>
                            <strong>Phạm Hương</strong><br>
                            <small class="color-gray-500">CMO, Beauty Company</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: var(--gradient-blue); color: white;">
        <div class="container">
            <div class="cta-split">
                <div class="cta-content">
                    <h2 style="color: white;">Ready to Transform Your TikTok Marketing?</h2>
                    <p style="font-size: 1.25rem; opacity: 0.95; margin-bottom: 2rem; color: #fefefe;">
                        Join 500+ brands using OneUp KOL to optimize their influencer campaigns
                    </p>

                    <ul class="cta-features">
                        <li>Access to 10,000+ verified KOL profiles</li>
                        <li>Real-time analytics and ROI tracking</li>
                        <li>AI-powered recommendations</li>
                        <li>Dedicated customer support</li>
                    </ul>

                    <div class="d-flex gap-2" style="margin-top: 2rem;">
                        <a href="{{ route('user.register') }}" class="btn"
                            style="background: white; color: var(--primary);">
                            Start Free Trial
                        </a>
                        <a href="{{ route('pricing') }}" class="btn"
                            style="background: rgba(255,255,255,0.2); color: white; border: 2px solid white;">
                            View Pricing
                        </a>
                    </div>
                </div>

                <div style="text-align: center;">
                    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: var(--shadow-2xl);">
                        <h3 style="color: var(--dark-blue); margin-bottom: 1.5rem;">Get Started in Minutes</h3>
                        <div style="text-align: left;">
                            <div
                                style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--primary); font-size: 24px; font-weight: 700;">1</span>
                                <span style="color: var(--gray-700);">Sign up for free account</span>
                            </div>
                            <div
                                style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--primary); font-size: 24px; font-weight: 700;">2</span>
                                <span style="color: var(--gray-700);">Search and analyze KOLs</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0;">
                                <span style="color: var(--primary); font-size: 24px; font-weight: 700;">3</span>
                                <span style="color: var(--gray-700);">Launch your first campaign</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Filter tabs functionality
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
    <script>
        // $(function() {

        //     $('.contact-form').on('submit', function(e) {
        //         e.preventDefault();

        //         $(this).find('button').prop('disabled', true);

        //         var data = {
        //             name: $(this).find('input[name="name"]').val(),
        //             phone: $(this).find('input[name="phone"]').val(),
        //             email: $(this).find('input[name="email"]').val(),
        //             product: $(this).find('select[name="product"]').val(),
        //             message: $(this).find('textarea[name="message"]').val()
        //         };

        //         $.ajax({
        //             type: 'post',
        //             url: '{{ route('newsletters') }}',
        //             data: data,
        //         }).then(function(res) {
        //             if (res.success) {
        //                 toastr.success(
        //                     'Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
        //                 $('.contact-form')[0].reset();
        //             } else {
        //                 toastr.error(res.msg);
        //             }
        //         });
        //         $(this).find('button').prop('disabled', false);
        //     });
        // });
    </script>
@endsection
