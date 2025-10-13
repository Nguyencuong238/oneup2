@extends('layouts.front')

@section('meta')
    <title>Resources - OneUp KOL Analytics</title>
    <meta name="description"
        content="Resources - Blog, guides, case studies and insights about TikTok influencer marketing">



@section('css')
    <style>
        .resource-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }
        
        .tab-btn {
            padding: 12px 24px;
            background: white;
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .tab-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .tab-btn.active {
            background: var(--gradient);
            color: white;
            border-color: transparent;
        }
        
        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .resource-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }
        
        .resource-image {
            width: 100%;
            height: 200px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            position: relative;
            overflow: hidden;
        }
        
        .resource-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
        }
        
        .resource-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 6px 12px;
            background: rgba(255,255,255,0.9);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            z-index: 1;
    color: var(--dark-blue);
        }
        
        .resource-content {
            padding: 1.5rem;
        }
        
        .resource-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.3;
    color: var(--dark-blue);
        }
        
        .resource-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 14px;
            color: var(--gray-light);
        }
        
        .resource-excerpt {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .resource-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: gap 0.3s;
        }
        
        .resource-link:hover {
            gap: 1rem;
        }
        
        .featured-resource {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: linear-gradient(135deg, white 0%, #F8F9FA 100%);
        }
        
        .featured-resource .resource-image {
            height: 100%;
            min-height: 300px;
        }
        
        .featured-resource .resource-content {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .download-card {
            background: var(--gradient);
            color: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .download-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        .download-card p {
            color: var(--gray-300);
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .newsletter-form {
            display: flex;
            gap: 1rem;
            max-width: 500px;
            margin: 2rem auto 0;
        }
        
        .newsletter-input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        
        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .filter-sidebar {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 100px;
        }
        
        .filter-group {
            margin-bottom: 2rem;
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }
        
        .filter-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        @media (max-width: 1024px) {
            .featured-resource {
                grid-column: span 1;
                grid-template-columns: 1fr;
            }
            
            .featured-resource .resource-image {
                min-height: 200px;
            }
        }
        
        @media (max-width: 768px) {
            .resource-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('page')
    
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 60px; background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 color-dark-blue fade-in">
                    Resources & <span class="gradient-text">Insights</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Learn everything about TikTok influencer marketing with our guides, case studies, and industry reports
                </p>
                
                <!-- Resource Tabs -->
                <div class="resource-tabs fade-in">
                    <button class="tab-btn active" onclick="filterResources('all')">All Resources</button>
                    <button class="tab-btn" onclick="filterResources('blog')">Blog Posts</button>
                    <button class="tab-btn" onclick="filterResources('guides')">Guides</button>
                    <button class="tab-btn" onclick="filterResources('cases')">Case Studies</button>
                    <button class="tab-btn" onclick="filterResources('reports')">Reports</button>
                    <button class="tab-btn" onclick="filterResources('webinars')">Webinars</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Resource -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="resource-grid">
                <!-- Featured Article -->
                <div class="featured-resource resource-card fade-in">
                    <div class="resource-image">
                        <span class="resource-category">Featured Report</span>
                        <span style="font-size: 72px;">📈</span>
                    </div>
                    <div class="resource-content">
                        <div class="badge badge-primary mb-2">NEW</div>
                        <h2 class="resource-title">2025 TikTok KOL Marketing Report: Vietnam Market</h2>
                        <div class="resource-meta">
                            <span>📅 Jan 15, 2025</span>
                            <span>⏱ 15 min read</span>
                            <span>👁 5.2K views</span>
                        </div>
                        <p class="resource-excerpt">
                            Comprehensive analysis of TikTok influencer marketing trends in Vietnam. Discover average engagement rates, pricing benchmarks, and successful campaign strategies from 500+ campaigns.
                        </p>
                        <a href="#" class="resource-link">
                            Download Free Report
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Blog Posts -->
                <div class="resource-card fade-in" data-category="blog">
                    <div class="resource-image">
                        <span class="resource-category">Blog</span>
                        <span>💡</span>
                    </div>
                    <div class="resource-content">
                        <h3 class="resource-title">10 Signs of Fake TikTok Followers You Should Know</h3>
                        <div class="resource-meta">
                            <span>Jan 12, 2025</span>
                            <span>8 min read</span>
                        </div>
                        <p class="resource-excerpt">
                            Learn how to identify fake followers and ensure you're partnering with authentic TikTok creators...
                        </p>
                        <a href="#" class="resource-link">
                            Read More →
                        </a>
                    </div>
                </div>

                <div class="resource-card fade-in" data-category="guides">
                    <div class="resource-image">
                        <span class="resource-category">Guide</span>
                        <span>📚</span>
                    </div>
                    <div class="resource-content">
                        <h3 class="resource-title">Complete Guide to TikTok Campaign Planning</h3>
                        <div class="resource-meta">
                            <span>Jan 10, 2025</span>
                            <span>20 min read</span>
                        </div>
                        <p class="resource-excerpt">
                            Step-by-step guide to planning, executing, and measuring successful TikTok influencer campaigns...
                        </p>
                        <a href="#" class="resource-link">
                            Read Guide →
                        </a>
                    </div>
                </div>

                <div class="resource-card fade-in" data-category="cases">
                    <div class="resource-image">
                        <span class="resource-category">Case Study</span>
                        <span>🎯</span>
                    </div>
                    <div class="resource-content">
                        <h3 class="resource-title">How Brand X Achieved 500% ROI with Micro-Influencers</h3>
                        <div class="resource-meta">
                            <span>Jan 8, 2025</span>
                            <span>12 min read</span>
                        </div>
                        <p class="resource-excerpt">
                            Discover how a local fashion brand leveraged micro-influencers to drive massive sales growth...
                        </p>
                        <a href="#" class="resource-link">
                            View Case Study →
                        </a>
                    </div>
                </div>

                <div class="resource-card fade-in" data-category="blog">
                    <div class="resource-image">
                        <span class="resource-category">Blog</span>
                        <span>🚀</span>
                    </div>
                    <div class="resource-content">
                        <h3 class="resource-title">TikTok Algorithm Changes: What Marketers Need to Know</h3>
                        <div class="resource-meta">
                            <span>Jan 5, 2025</span>
                            <span>6 min read</span>
                        </div>
                        <p class="resource-excerpt">
                            Latest updates to TikTok's algorithm and how they impact your influencer marketing strategy...
                        </p>
                        <a href="#" class="resource-link">
                            Read More →
                        </a>
                    </div>
                </div>

                <div class="resource-card fade-in" data-category="reports">
                    <div class="resource-image">
                        <span class="resource-category">Report</span>
                        <span>📊</span>
                    </div>
                    <div class="resource-content">
                        <h3 class="resource-title">Q4 2024 TikTok Performance Benchmarks</h3>
                        <div class="resource-meta">
                            <span>Dec 28, 2024</span>
                            <span>25 min read</span>
                        </div>
                        <p class="resource-excerpt">
                            Industry benchmarks for engagement rates, CPM, and conversion rates across different niches...
                        </p>
                        <a href="#" class="resource-link">
                            Download Report →
                        </a>
                    </div>
                </div>

                <div class="resource-card fade-in" data-category="webinars">
                    <div class="resource-image">
                        <span class="resource-category">Webinar</span>
                        <span>🎥</span>
                    </div>
                    <div class="resource-content">
                        <h3 class="resource-title">Mastering TikTok Analytics: Live Workshop</h3>
                        <div class="resource-meta">
                            <span>Feb 1, 2025</span>
                            <span>2:00 PM GMT+7</span>
                        </div>
                        <p class="resource-excerpt">
                            Join our live workshop to learn advanced analytics techniques for measuring campaign success...
                        </p>
                        <a href="#" class="resource-link">
                            Register Now →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <div class="grid grid-3">
                <div class="download-card fade-in">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📱</div>
                    <h3 style="margin-bottom: 1rem;">TikTok KOL Checklist</h3>
                    <p style="opacity: 0.9; margin-bottom: 1.5rem;">
                        Essential checklist for vetting TikTok influencers
                    </p>
                    <button class="btn" style="background: white; color: var(--primary);">
                        Download Free
                    </button>
                </div>

                <div class="download-card fade-in" style="animation-delay: 0.1s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📋</div>
                    <h3 style="margin-bottom: 1rem;">Campaign Template</h3>
                    <p style="opacity: 0.9; margin-bottom: 1.5rem;">
                        Ready-to-use template for planning TikTok campaigns
                    </p>
                    <button class="btn" style="background: white; color: var(--primary);">
                        Get Template
                    </button>
                </div>

                <div class="download-card fade-in" style="animation-delay: 0.2s;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">💰</div>
                    <h3 style="margin-bottom: 1rem;">ROI Calculator</h3>
                    <p style="opacity: 0.9; margin-bottom: 1.5rem;">
                        Excel template to calculate campaign ROI instantly
                    </p>
                    <button class="btn" style="background: white; color: var(--primary);">
                        Download Tool
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="section">
        <div class="container text-center">
            <div class="section-header">
                <div class="section-subtitle fade-in">STAY UPDATED</div>
                <h2 class="section-title color-gray-100 fade-in">Get Weekly Insights</h2>
                <p class="section-description color-gray-600 fade-in">
                    Join 5,000+ marketers receiving our weekly newsletter with the latest<br>
                    TikTok trends, case studies, and platform updates
                </p>
            </div>
            
            <form class="newsletter-form fade-in" onsubmit="handleNewsletter(event)">
                <input type="email" class="newsletter-input" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
            
            <p class="mt-3" style="color: var(--gray-light); font-size: 14px;">
                No spam. Unsubscribe anytime.
            </p>
        </div>
    </section>

    <!-- Popular Topics -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <h2 class="text-center color-dark-blue mb-4">Popular Topics</h2>
            
            <div class="d-flex flex-wrap justify-center gap-2">
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #TikTokMarketing
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #InfluencerROI
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #MicroInfluencers
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #ContentStrategy
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #CampaignAnalytics
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #ViralMarketing
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #BrandCollabs
                </a>
                <a href="#" class="badge" style="padding: 10px 20px; font-size: 14px; background: white; color: var(--gray-600); border: 1px solid #E0E0E0;">
                    #TikTokTrends
                </a>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Filter Resources
        function filterResources(category) {
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Filter cards
            const cards = document.querySelectorAll('.resource-card');
            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Handle Newsletter
        function handleNewsletter(event) {
            event.preventDefault();
            const email = event.target.querySelector('input[type="email"]').value;
            alert(`Thank you for subscribing with ${email}! Check your inbox for confirmation.`);
            event.target.reset();
        }
    </script>
@endsection
