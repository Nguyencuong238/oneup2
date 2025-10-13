@extends('layouts.front')

@section('meta')
    <title>Help Center - OneUp KOL Analytics</title>
    <meta name="description"
        content="Help Center - Get support and find answers about OneUp KOL Analytics platform">
@endsection

@section('css')
    <style>
        .search-box {
            max-width: 600px;
            margin: 0 auto 3rem;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 20px 60px 20px 24px;
            font-size: 18px;
            border: 2px solid #E0E0E0;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(255, 0, 80, 0.1);
        }
        
        .search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: var(--gradient);
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
        }
        
        .help-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .help-category {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .help-category:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }
        
        .help-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, rgba(255, 0, 80, 0.1) 0%, rgba(0, 242, 234, 0.1) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            transition: all 0.3s;
        }
        
        .help-category:hover .help-icon {
            transform: scale(1.1) rotate(5deg);
            background: var(--gradient);
        }
        
        .help-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .help-description {
            color: var(--gray-light);
            font-size: 14px;
        }
        
        .faq-section {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .faq-item {
            background: white;
            border-radius: 16px;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .faq-item:hover {
            box-shadow: var(--shadow-md);
        }
        
        .faq-question {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .faq-question:hover {
            background: linear-gradient(90deg, rgba(255, 0, 80, 0.05) 0%, rgba(0, 242, 234, 0.05) 100%);
        }
        
        .faq-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }
        
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            color: var(--gray-light);
            line-height: 1.8;
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 0 1.5rem 1.5rem;
        }
        
        .contact-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .video-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .video-thumbnail {
            width: 100%;
            height: 180px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .play-btn {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary);
            transition: all 0.3s;
        }
        
        .video-card:hover .play-btn {
            transform: scale(1.2);
            background: white;
        }
        
        .video-info {
            padding: 1rem;
        }
        
        .video-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .video-duration {
            color: var(--gray-light);
            font-size: 14px;
        }
        
        .quick-links {
            background: linear-gradient(135deg, #F8F9FA 0%, white 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .quick-link {
            color: var(--primary);
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .quick-link:hover {
            background: rgba(255, 0, 80, 0.1);
            padding-left: 1rem;
        }
    </style>
@endsection

@section('page')
    
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 80px; background: var(--gradient);">
        <div class="container">
            <div class="text-center" style="color: white;">
                <h1 class="mb-3 fade-in">How Can We Help You?</h1>
                <p class="mb-4 fade-in" style="font-size: 20px; opacity: 0.9;">
                    Search our knowledge base or browse categories below
                </p>
                
                <!-- Search Box -->
                <div class="search-box fade-in">
                    <input type="text" class="search-input" placeholder="Search for articles, guides, or topics..." id="searchInput">
                    <button class="search-btn" onclick="performSearch()">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                
                <div class="fade-in" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <span style="opacity: 0.9;">Popular searches:</span>
                    <a href="#" style="color: white; text-decoration: underline;">API documentation</a>
                    <a href="#" style="color: white; text-decoration: underline;">Campaign setup</a>
                    <a href="#" style="color: white; text-decoration: underline;">Billing questions</a>
                    <a href="#" style="color: white; text-decoration: underline;">KOL verification</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Categories -->
    <section class="section" style="padding-top: 0; margin-top: -40px;">
        <div class="container">
            <div class="help-categories">
                <div class="help-category fade-in" onclick="showCategory('getting-started')">
                    <div class="help-icon">🚀</div>
                    <h3 class="help-title">Getting Started</h3>
                    <p class="help-description">Learn the basics of using OneUp KOL Analytics platform</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.1s;" onclick="showCategory('account')">
                    <div class="help-icon">👤</div>
                    <h3 class="help-title">Account & Billing</h3>
                    <p class="help-description">Manage your account, subscription, and payment methods</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.2s;" onclick="showCategory('campaigns')">
                    <div class="help-icon">📈</div>
                    <h3 class="help-title">Campaigns</h3>
                    <p class="help-description">Create, manage, and track your influencer campaigns</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.3s;" onclick="showCategory('analytics')">
                    <div class="help-icon">📊</div>
                    <h3 class="help-title">Analytics & Reports</h3>
                    <p class="help-description">Understanding metrics, insights, and generating reports</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.4s;" onclick="showCategory('kol-discovery')">
                    <div class="help-icon">🔍</div>
                    <h3 class="help-title">KOL Discovery</h3>
                    <p class="help-description">Find and evaluate the right influencers for your brand</p>
                </div>
                
                <div class="help-category fade-in" style="animation-delay: 0.5s;" onclick="showCategory('api')">
                    <div class="help-icon">⚙️</div>
                    <h3 class="help-title">API & Integrations</h3>
                    <p class="help-description">Connect OneUp with your existing tools and workflows</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Articles -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="text-center mb-4">Popular Help Articles</h2>
            
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How do I start my first campaign?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>To start your first campaign:</p>
                        <ol style="margin-left: 20px; margin-top: 10px;">
                            <li>Navigate to the Campaigns section in your dashboard</li>
                            <li>Click "Create New Campaign"</li>
                            <li>Set your campaign objectives and budget</li>
                            <li>Use our KOL Discovery tool to find suitable influencers</li>
                            <li>Review and launch your campaign</li>
                        </ol>
                        <p style="margin-top: 10px;">For detailed instructions, check our <a href="#" style="color: var(--primary);">Campaign Setup Guide</a>.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How accurate is the fraud detection system?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Our fraud detection system uses advanced AI algorithms to analyze multiple signals including:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>Follower growth patterns</li>
                            <li>Engagement rate consistency</li>
                            <li>Comment authenticity</li>
                            <li>Audience demographics distribution</li>
                        </ul>
                        <p style="margin-top: 10px;">The system has a 95% accuracy rate in detecting fake followers and engagement manipulation.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Can I export data to Excel or CSV?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! You can export data in multiple formats:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>CSV for raw data analysis</li>
                            <li>Excel (XLSX) for formatted reports</li>
                            <li>PDF for presentation-ready reports</li>
                        </ul>
                        <p style="margin-top: 10px;">Simply click the "Export" button on any data table or report page and select your preferred format.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>What's included in the API access?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>API access includes:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>RESTful API endpoints for all major features</li>
                            <li>Real-time webhooks for campaign events</li>
                            <li>Rate limits based on your subscription plan</li>
                            <li>Comprehensive documentation and code examples</li>
                            <li>SDK libraries for Python, JavaScript, and PHP</li>
                        </ul>
                        <p style="margin-top: 10px;">Check our <a href="#" style="color: var(--primary);">API Documentation</a> for implementation details.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>How do I upgrade or downgrade my plan?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>You can change your plan anytime from your account settings:</p>
                        <ol style="margin-left: 20px; margin-top: 10px;">
                            <li>Go to Settings → Billing</li>
                            <li>Click "Change Plan"</li>
                            <li>Select your new plan</li>
                            <li>Confirm the changes</li>
                        </ol>
                        <p style="margin-top: 10px;">Upgrades take effect immediately. Downgrades apply at the next billing cycle. Unused credits are prorated.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Tutorials -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-4">Video Tutorials</h2>
            <p class="text-center mb-4" style="color: var(--gray-light);">
                Learn how to use OneUp KOL Analytics with our step-by-step video guides
            </p>
            
            <div class="video-grid">
                <div class="video-card fade-in">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Platform Overview</div>
                        <div class="video-duration">5 min • Beginner</div>
                    </div>
                </div>
                
                <div class="video-card fade-in" style="animation-delay: 0.1s;">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Setting Up Your First Campaign</div>
                        <div class="video-duration">8 min • Beginner</div>
                    </div>
                </div>
                
                <div class="video-card fade-in" style="animation-delay: 0.2s;">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Advanced Analytics Features</div>
                        <div class="video-duration">12 min • Advanced</div>
                    </div>
                </div>
                
                <div class="video-card fade-in" style="animation-delay: 0.3s;">
                    <div class="video-thumbnail">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="video-info">
                        <div class="video-title">Using the API</div>
                        <div class="video-duration">15 min • Developer</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container">
            <h2 class="text-center mb-3">Still Need Help?</h2>
            <p class="text-center mb-4" style="color: var(--gray-light);">
                Our support team is here to assist you
            </p>
            
            <div class="contact-cards">
                <div class="contact-card fade-in">
                    <div class="contact-icon">💬</div>
                    <h3>Live Chat</h3>
                    <p style="color: var(--gray-light); margin: 1rem 0;">
                        Chat with our support team in real-time
                    </p>
                    <p style="color: var(--success); font-weight: 600; margin-bottom: 1rem;">
                        Available Mon-Fri, 9AM-6PM GMT+7
                    </p>
                    <button class="btn btn-primary">Start Chat</button>
                </div>
                
                <div class="contact-card fade-in" style="animation-delay: 0.1s;">
                    <div class="contact-icon">✉️</div>
                    <h3>Email Support</h3>
                    <p style="color: var(--gray-light); margin: 1rem 0;">
                        Send us a detailed message
                    </p>
                    <p style="font-weight: 600; margin-bottom: 1rem;">
                        support@oneup.vn
                    </p>
                    <button class="btn btn-outline">Send Email</button>
                </div>
                
                <div class="contact-card fade-in" style="animation-delay: 0.2s;">
                    <div class="contact-icon">📞</div>
                    <h3>Phone Support</h3>
                    <p style="color: var(--gray-light); margin: 1rem 0;">
                        Speak directly with our team
                    </p>
                    <p style="font-weight: 600; margin-bottom: 1rem;">
                        +84 28 1234 5678
                    </p>
                    <button class="btn btn-outline">Call Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="section">
        <div class="container">
            <div class="quick-links">
                <h3 class="mb-3">Quick Links</h3>
                <div class="quick-links-grid">
                    <a href="#" class="quick-link">
                        <span>📚</span> Documentation
                    </a>
                    <a href="#" class="quick-link">
                        <span>🔧</span> API Reference
                    </a>
                    <a href="#" class="quick-link">
                        <span>📝</span> Release Notes
                    </a>
                    <a href="#" class="quick-link">
                        <span>🔒</span> Security & Privacy
                    </a>
                    <a href="#" class="quick-link">
                        <span>💡</span> Feature Requests
                    </a>
                    <a href="#" class="quick-link">
                        <span>🐛</span> Report a Bug
                    </a>
                    <a href="#" class="quick-link">
                        <span>📊</span> System Status
                    </a>
                    <a href="#" class="quick-link">
                        <span>👥</span> Community Forum
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Toggle FAQ
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            
            // Close other FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('active');
                }
            });
            
            // Toggle current FAQ
            faqItem.classList.toggle('active');
        }
        
        // Search function
        function performSearch() {
            const query = document.getElementById('searchInput').value;
            if (query) {
                alert(`Searching for: ${query}\nThis would typically redirect to search results.`);
            }
        }
        
        // Handle Enter key in search
        document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        // Show category
        function showCategory(category) {
            alert(`Navigating to ${category} category...`);
        }
    </script>
@endsection
