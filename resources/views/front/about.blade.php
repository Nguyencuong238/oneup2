@extends('layouts.front')

@section('meta')
    <title>About Us - OneUp KOL Analytics</title>
    <meta name="description" content="About OneUp KOL Analytics - Leading TikTok influencer marketing platform in Vietnam">

@endsection

@section('css')
    <style>
        .timeline {
            position: relative;
            padding: 2rem 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--gradient);
            transform: translateX(-50%);
        }
        
        .timeline-item {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .timeline-item:nth-child(odd) .timeline-content {
            margin-right: 50%;
            text-align: right;
            padding-right: 3rem;
        }
        
        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 50%;
            padding-left: 3rem;
        }
        
        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--gradient);
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 2px 10px rgba(255, 0, 80, 0.3);
        }
        
        .timeline-content h3 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .team-member {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }
        
        .team-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .team-avatar::after {
            content: '';
            position: absolute;
            inset: -5px;
            background: var(--gradient);
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .team-member:hover .team-avatar::after {
            opacity: 0.3;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .team-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .team-role {
            color: var(--primary);
            font-size: 14px;
            margin-bottom: 1rem;
        }
        
        .team-bio {
            color: var(--gray-light);
            font-size: 14px;
            line-height: 1.6;
        }
        
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .value-card {
            padding: 2rem;
            background: linear-gradient(135deg, white 0%, #F8F9FA 100%);
            border-radius: 20px;
            border: 1px solid rgba(255, 0, 80, 0.1);
            transition: var(--transition);
        }
        
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 0, 80, 0.1);
            border-color: var(--primary);
        }
        
        .value-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 1.5rem;
        }
        
        .partner-logos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 3rem;
            margin-top: 3rem;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s;
        }
        
        .partner-logos:hover {
            filter: grayscale(0);
            opacity: 1;
        }
        
        .partner-logo {
            width: 120px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            color: var(--gray);
        }
        
        @media (max-width: 768px) {
            .timeline::before {
                left: 30px;
            }
            
            .timeline-item .timeline-content {
                margin-left: 80px !important;
                margin-right: 0 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                text-align: left !important;
            }
            
            .timeline-dot {
                left: 30px;
            }
        }
    </style>
@endsection

@section('page') 
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 80px;">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 fade-in">
                    Empowering Brands with <span class="gradient-text">Data-Driven</span><br>
                    Influencer Marketing
                </h1>
                <p class="section-description mb-4 fade-in">
                    We're on a mission to revolutionize how brands connect with TikTok creators in Vietnam
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section" style="background: var(--gradient); color: white; padding: 60px 0;">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item fade-in">
                    <div class="stat-number" data-counter="2019">0</div>
                    <div class="stat-label">Founded</div>
                </div>
                <div class="stat-item fade-in" style="animation-delay: 0.1s;">
                    <div class="stat-number" data-counter="45">0</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="stat-item fade-in" style="animation-delay: 0.2s;">
                    <div class="stat-number" data-counter="500">0</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-item fade-in" style="animation-delay: 0.3s;">
                    <div class="stat-number">₫50B+</div>
                    <div class="stat-label">Campaign Value Tracked</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">OUR STORY</div>
                <h2 class="section-title fade-in">How It All Started</h2>
            </div>
            
            <div class="grid grid-2 align-center gap-5">
                <div class="slide-in-left">
                    <p class="mb-3" style="font-size: 18px; line-height: 1.8; color: var(--gray-light);">
                        OneUp KOL Analytics was born from a simple observation: Vietnamese brands were struggling to navigate the rapidly growing TikTok influencer landscape. Traditional methods of finding and vetting KOLs were time-consuming, expensive, and often ineffective.
                    </p>
                    <p class="mb-3" style="font-size: 18px; line-height: 1.8; color: var(--gray-light);">
                        Our founding team, with backgrounds in data science, digital marketing, and software engineering, came together in 2019 with a vision to democratize access to influencer marketing intelligence.
                    </p>
                    <p style="font-size: 18px; line-height: 1.8; color: var(--gray-light);">
                        Today, we're proud to be Vietnam's leading TikTok KOL analytics platform, helping hundreds of brands make data-driven decisions and achieve remarkable ROI on their influencer campaigns.
                    </p>
                </div>
                <div class="slide-in-right">
                    <div style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%); border-radius: 20px; padding: 3rem; text-align: center;">
                        <div style="font-size: 64px; margin-bottom: 1rem;">🚀</div>
                        <h3 class="gradient-text">Our Mission</h3>
                        <p style="color: var(--gray); margin-top: 1rem; font-style: italic;">
                            "To empower every brand in Vietnam with the tools and insights needed to run successful influencer marketing campaigns"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="text-center mb-5">Our Journey</h2>
            
            <div class="timeline">
                <div class="timeline-item fade-in">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2019</h3>
                        <h4>Company Founded</h4>
                        <p>Started with a team of 3 founders and a vision to transform influencer marketing</p>
                    </div>
                </div>
                
                <div class="timeline-item fade-in" style="animation-delay: 0.1s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2020</h3>
                        <h4>Beta Launch</h4>
                        <p>Released beta version with 50 early adopter brands</p>
                    </div>
                </div>
                
                <div class="timeline-item fade-in" style="animation-delay: 0.2s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2021</h3>
                        <h4>Series A Funding</h4>
                        <p>Raised $2M to expand platform capabilities and team</p>
                    </div>
                </div>
                
                <div class="timeline-item fade-in" style="animation-delay: 0.3s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2022</h3>
                        <h4>AI Integration</h4>
                        <p>Launched AI-powered KOL recommendations and fraud detection</p>
                    </div>
                </div>
                
                <div class="timeline-item fade-in" style="animation-delay: 0.4s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2023</h3>
                        <h4>Market Leader</h4>
                        <p>Became Vietnam's #1 TikTok KOL analytics platform</p>
                    </div>
                </div>
                
                <div class="timeline-item fade-in" style="animation-delay: 0.5s;">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2024</h3>
                        <h4>Regional Expansion</h4>
                        <p>Expanded to Thailand, Philippines, and Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">CORE VALUES</div>
                <h2 class="section-title fade-in">What Drives Us</h2>
            </div>
            
            <div class="values-grid">
                <div class="value-card fade-in">
                    <div class="value-icon">🎯</div>
                    <h3>Data-Driven</h3>
                    <p>We believe in the power of data to drive better decisions. Every feature we build is designed to provide actionable insights.</p>
                </div>
                
                <div class="value-card fade-in" style="animation-delay: 0.1s;">
                    <div class="value-icon">🤝</div>
                    <h3>Customer Success</h3>
                    <p>Your success is our success. We're committed to helping every client achieve their influencer marketing goals.</p>
                </div>
                
                <div class="value-card fade-in" style="animation-delay: 0.2s;">
                    <div class="value-icon">💡</div>
                    <h3>Innovation</h3>
                    <p>We continuously innovate to stay ahead of the rapidly evolving social media landscape.</p>
                </div>
                
                <div class="value-card fade-in" style="animation-delay: 0.3s;">
                    <div class="value-icon">🔍</div>
                    <h3>Transparency</h3>
                    <p>We believe in transparent pricing, clear metrics, and honest communication with all stakeholders.</p>
                </div>
                
                <div class="value-card fade-in" style="animation-delay: 0.4s;">
                    <div class="value-icon">⚡</div>
                    <h3>Speed</h3>
                    <p>In the fast-paced world of social media, speed matters. We help you move quickly without sacrificing quality.</p>
                </div>
                
                <div class="value-card fade-in" style="animation-delay: 0.5s;">
                    <div class="value-icon">🌟</div>
                    <h3>Excellence</h3>
                    <p>We strive for excellence in everything we do, from product development to customer support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">OUR TEAM</div>
                <h2 class="section-title fade-in">Meet the People Behind OneUp</h2>
                <p class="section-description fade-in">
                    A diverse team of experts passionate about influencer marketing
                </p>
            </div>
            
            <div class="team-grid">
                <div class="team-member fade-in">
                    <div class="team-avatar">NT</div>
                    <div class="team-name">Nguyễn Thành</div>
                    <div class="team-role">CEO & Co-Founder</div>
                    <div class="team-bio">10+ years in digital marketing. Former Head of Digital at Unilever Vietnam.</div>
                </div>
                
                <div class="team-member fade-in" style="animation-delay: 0.1s;">
                    <div class="team-avatar">LH</div>
                    <div class="team-name">Lê Hương</div>
                    <div class="team-role">CTO & Co-Founder</div>
                    <div class="team-bio">AI/ML expert. Previously Senior Engineer at Google Singapore.</div>
                </div>
                
                <div class="team-member fade-in" style="animation-delay: 0.2s;">
                    <div class="team-avatar">PM</div>
                    <div class="team-name">Phạm Minh</div>
                    <div class="team-role">Head of Product</div>
                    <div class="team-bio">Product visionary with experience at Grab and Shopee.</div>
                </div>
                
                <div class="team-member fade-in" style="animation-delay: 0.3s;">
                    <div class="team-avatar">TD</div>
                    <div class="team-name">Trần Dung</div>
                    <div class="team-role">Head of Data Science</div>
                    <div class="team-bio">PhD in Data Science. Expert in social media analytics.</div>
                </div>
                
                <div class="team-member fade-in" style="animation-delay: 0.4s;">
                    <div class="team-avatar">VL</div>
                    <div class="team-name">Vũ Linh</div>
                    <div class="team-role">Head of Customer Success</div>
                    <div class="team-bio">Passionate about helping brands succeed with influencer marketing.</div>
                </div>
                
                <div class="team-member fade-in" style="animation-delay: 0.5s;">
                    <div class="team-avatar">HN</div>
                    <div class="team-name">Hoàng Nam</div>
                    <div class="team-role">Head of Marketing</div>
                    <div class="team-bio">Growth hacker with track record of scaling B2B SaaS companies.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle fade-in">TRUSTED BY</div>
                <h2 class="section-title fade-in">Our Partners & Clients</h2>
            </div>
            
            <div class="partner-logos">
                <div class="partner-logo">Vingroup</div>
                <div class="partner-logo">FPT</div>
                <div class="partner-logo">Viettel</div>
                <div class="partner-logo">Shopee</div>
                <div class="partner-logo">Grab</div>
                <div class="partner-logo">Unilever</div>
                <div class="partner-logo">L'Oréal</div>
                <div class="partner-logo">Samsung</div>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container text-center">
            <h2 class="mb-4">Awards & Recognition</h2>
            
            <div class="grid grid-4">
                <div class="fade-in">
                    <div class="card">
                        <div style="font-size: 48px; margin-bottom: 1rem;">🏆</div>
                        <h4>Best MarTech Startup</h4>
                        <p style="color: var(--gray-light);">Vietnam Tech Awards 2023</p>
                    </div>
                </div>
                
                <div class="fade-in" style="animation-delay: 0.1s;">
                    <div class="card">
                        <div style="font-size: 48px; margin-bottom: 1rem;">⭐</div>
                        <h4>Top 10 Startups</h4>
                        <p style="color: var(--gray-light);">Southeast Asia 2023</p>
                    </div>
                </div>
                
                <div class="fade-in" style="animation-delay: 0.2s;">
                    <div class="card">
                        <div style="font-size: 48px; margin-bottom: 1rem;">🚀</div>
                        <h4>Fastest Growing</h4>
                        <p style="color: var(--gray-light);">Tech in Asia 2022</p>
                    </div>
                </div>
                
                <div class="fade-in" style="animation-delay: 0.3s;">
                    <div class="card">
                        <div style="font-size: 48px; margin-bottom: 1rem;">💎</div>
                        <h4>Innovation Award</h4>
                        <p style="color: var(--gray-light);">Digital Marketing Asia 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: var(--gradient); color: white;">
        <div class="container text-center">
            <h2 class="mb-3">Join Us on Our Mission</h2>
            <p class="mb-4" style="font-size: 18px; opacity: 0.9;">
                Be part of the influencer marketing revolution in Southeast Asia
            </p>
            <div class="d-flex gap-2 justify-center">
                <a href="{{route('register')}}" class="btn" style="background: white; color: var(--primary);">
                    Start Free Trial
                </a>
                <a href="#" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid white;">
                    View Open Positions
                </a>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script></script>
@endsection
