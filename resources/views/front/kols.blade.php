@extends('layouts.front')

@section('meta')
    <title>KOL Directory - OneUp KOL Analytics</title>
    <meta name="description" content="Browse and discover 10,000+ verified TikTok KOLs in Vietnam">

@endsection

@section('css')
    <style>
        /* KOL List Page Specific Styles */
        .filters-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }
        
        .filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--gray-200);
        }
        
        .filters-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filters-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .filters-toggle:hover {
            color: var(--primary);
        }
        
        .filters-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .filters-content.collapsed {
            display: none;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .filter-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }
        
        .filter-select {
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            background: white;
            color: var(--dark-blue);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .filter-select:hover {
            border-color: var(--primary);
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }
        
        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .filter-chip {
            padding: 6px 14px;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        
        .filter-chip:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .filter-chip.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .filter-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }
        
        .active-filters {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--primary-lighter);
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .active-filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 4px 12px;
            background: white;
            border-radius: 20px;
            font-size: 13px;
            color: var(--dark-blue);
        }
        
        .active-filter-tag button {
            background: none;
            border: none;
            color: var(--gray-500);
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }
        
        .active-filter-tag button:hover {
            color: var(--danger);
        }
        
        .kol-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }
        
        .kol-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid var(--gray-200);
            position: relative;
        }
        
        .kol-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-light);
        }
        
        .kol-card-header {
            position: relative;
            height: 200px;
            background: linear-gradient(135deg, var(--primary-lighter) 0%, var(--secondary) 100%);
            overflow: hidden;
        }
        
        .kol-cover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }
        
        .kol-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .kol-badge.verified {
            background: var(--success);
            color: white;
        }
        
        .kol-badge.rising {
            background: var(--warning);
            color: white;
        }
        
        .kol-avatar-wrapper {
            position: absolute;
            bottom: -40px;
            left: 20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .kol-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: var(--gradient-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 700;
        }
        
        .kol-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .kol-card-body {
            padding: 1.5rem;
            padding-top: 3rem;
        }
        
        .kol-info {
            margin-bottom: 1rem;
        }
        
        .kol-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .verified-icon {
            width: 16px;
            height: 16px;
            color: var(--primary);
        }
        
        .kol-handle {
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .kol-category {
            display: inline-block;
            padding: 4px 10px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .kol-bio {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.5;
            margin: 1rem 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .kol-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            padding: 1rem 0;
            border-top: 1px solid var(--gray-200);
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 1rem;
        }
        
        .kol-stat {
            text-align: center;
        }
        
        .kol-stat-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-blue);
            display: block;
        }
        
        .kol-stat-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }
        
        .kol-metrics {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        
        .metric-tag {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            background: var(--gray-100);
            border-radius: 6px;
            font-size: 12px;
            color: var(--gray-700);
        }
        
        .metric-tag.good {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .metric-tag.warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .kol-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        .search-bar {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }
        
        .search-input-group {
            display: flex;
            gap: 1rem;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }
        
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .results-count {
            font-size: 14px;
            color: var(--gray-600);
        }
        
        .results-count strong {
            color: var(--gray-100);
            font-weight: 600;
        }
        
        .results-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .view-toggle {
            display: flex;
            gap: 0.5rem;
        }
        
        .view-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .view-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .view-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .sort-dropdown {
            padding: 8px 16px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .sort-dropdown:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }
        
        .page-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
        }
        
        .page-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .trending-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--danger);
        }
        
        @media (max-width: 1200px) {
            .kol-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .filters-content {
                grid-template-columns: 1fr;
            }
            
            .kol-grid {
                grid-template-columns: 1fr;
            }
            
            .results-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 60px; background: linear-gradient(135deg, var(--primary-lighter) 0%, white 100%);">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-3 fade-in color-dark-blue">
                    Discover <span class="gradient-text">10,000+ TikTok KOLs</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Browse verified influencers with detailed analytics and real-time tracking
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section" style="padding-top: 0; margin-top: -40px;">
        <div class="container">
            <!-- Search Bar -->
            <div class="search-bar fade-in">
                <div class="search-input-group">
                    <input type="text" class="search-input" placeholder="Search by name, handle, or keyword...">
                    <button class="btn btn-primary">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                        Search
                    </button>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section fade-in">
                <div class="filters-header">
                    <div class="filters-title">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                        </svg>
                        Filters
                    </div>
                    <div class="filters-toggle" onclick="toggleFilters()">
                        <span id="filterToggleText">Hide Filters</span>
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                
                <div class="filters-content" id="filtersContent">
                    <div class="filter-group">
                        <label class="filter-label">Category</label>
                        <select class="filter-select">
                            <option>All Categories</option>
                            <option>Fashion & Style</option>
                            <option>Beauty & Makeup</option>
                            <option>Food & Cooking</option>
                            <option>Travel & Tourism</option>
                            <option>Technology</option>
                            <option>Fitness & Health</option>
                            <option>Entertainment</option>
                            <option>Education</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Followers Range</label>
                        <select class="filter-select">
                            <option>All Ranges</option>
                            <option>Nano (1K - 10K)</option>
                            <option>Micro (10K - 100K)</option>
                            <option>Mid-tier (100K - 500K)</option>
                            <option>Macro (500K - 1M)</option>
                            <option>Mega (1M+)</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Engagement Rate</label>
                        <select class="filter-select">
                            <option>Any Rate</option>
                            <option>Above 1%</option>
                            <option>Above 3%</option>
                            <option>Above 5%</option>
                            <option>Above 8%</option>
                            <option>Above 10%</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Location</label>
                        <select class="filter-select">
                            <option>All Locations</option>
                            <option>Hà Nội</option>
                            <option>TP. Hồ Chí Minh</option>
                            <option>Đà Nẵng</option>
                            <option>Cần Thơ</option>
                            <option>Hải Phòng</option>
                            <option>Other</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Language</label>
                        <select class="filter-select">
                            <option>All Languages</option>
                            <option>Vietnamese</option>
                            <option>English</option>
                            <option>Bilingual</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Verification</label>
                        <div class="filter-chips">
                            <button class="filter-chip active">All</button>
                            <button class="filter-chip">Verified Only</button>
                            <button class="filter-chip">Rising Stars</button>
                        </div>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <button class="btn btn-primary">Apply Filters</button>
                    <button class="btn btn-outline">Clear All</button>
                    <span style="margin-left: auto; color: var(--gray-600); font-size: 14px;">
                        3 filters applied
                    </span>
                </div>
            </div>

            <!-- Active Filters (shown when filters are applied) -->
            {{-- <div class="active-filters" style="display: none;">
                <span style="font-weight: 600; color: var(--dark-blue);">Active Filters:</span>
                <span class="active-filter-tag">
                    Fashion & Style
                    <button onclick="removeFilter(this)">×</button>
                </span>
                <span class="active-filter-tag">
                    100K - 500K Followers
                    <button onclick="removeFilter(this)">×</button>
                </span>
                <span class="active-filter-tag">
                    Above 5% Engagement
                    <button onclick="removeFilter(this)">×</button>
                </span>
                <button class="btn btn-outline btn-small" style="margin-left: auto;">Clear All</button>
            </div> --}}

            <!-- Results Header -->
            <div class="results-header fade-in">
                <div class="results-count">
                    Showing <strong>1-12</strong> of <strong>2,847</strong> KOLs
                </div>
                <div class="results-controls">
                    <select class="sort-dropdown">
                        <option>Most Relevant</option>
                        <option>Highest Engagement</option>
                        <option>Most Followers</option>
                        <option>Recently Active</option>
                        <option>Fastest Growing</option>
                        <option>Best Value</option>
                    </select>
                    <div class="view-toggle">
                        <button class="view-btn active" title="Grid View">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/>
                            </svg>
                        </button>
                        <button class="view-btn" title="List View">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- KOL Cards Grid -->
            <div class="kol-grid">
                <!-- KOL Card 1 -->
                <div class="kol-card fade-in">
                    <div class="kol-card-header">
                        <img src="https://via.placeholder.com/400x200/FF0050/ffffff?text=Fashion+Content" alt="Cover" class="kol-cover-image">
                        <span class="kol-badge verified">Verified</span>
                        <div class="trending-tag">
                            🔥 Trending
                        </div>
                        <div class="kol-avatar-wrapper">
                            <div class="kol-avatar">NT</div>
                        </div>
                    </div>
                    <div class="kol-card-body">
                        <div class="kol-info">
                            <div class="kol-name">
                                Ngọc Trinh
                                <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                            </div>
                            <div class="kol-handle">@ngoctrinh.official</div>
                            <span class="kol-category">Fashion & Style</span>
                        </div>
                        <p class="kol-bio">
                            Fashion influencer sharing daily outfit inspirations and style tips. Brand ambassador for luxury fashion brands.
                        </p>
                        <div class="kol-stats">
                            <div class="kol-stat">
                                <span class="kol-stat-value">2.8M</span>
                                <span class="kol-stat-label">Followers</span>
                            </div>
                            <div class="kol-stat">
                                <span class="kol-stat-value">5.8%</span>
                                <span class="kol-stat-label">Engagement</span>
                            </div>
                            <div class="kol-stat">
                                <span class="kol-stat-value">450K</span>
                                <span class="kol-stat-label">Avg Views</span>
                            </div>
                        </div>
                        <div class="kol-metrics">
                            <span class="metric-tag good">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                                High Quality
                            </span>
                            <span class="metric-tag">
                                📍 Hà Nội
                            </span>
                            <span class="metric-tag">
                                💰 Premium
                            </span>
                        </div>
                        <div class="kol-actions">
                            <button class="btn btn-primary" style="flex: 1;">View Profile</button>
                            <button class="btn btn-outline btn-icon">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KOL Card 2 -->
                <div class="kol-card fade-in" style="animation-delay: 0.1s;">
                    <div class="kol-card-header">
                        <img src="https://via.placeholder.com/400x200/00D4AA/ffffff?text=Beauty+Tutorials" alt="Cover" class="kol-cover-image">
                        <span class="kol-badge rising">Rising Star</span>
                        <div class="kol-avatar-wrapper">
                            <div class="kol-avatar">MH</div>
                        </div>
                    </div>
                    <div class="kol-card-body">
                        <div class="kol-info">
                            <div class="kol-name">
                                Minh Hằng
                                <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                            </div>
                            <div class="kol-handle">@minhang.beauty</div>
                            <span class="kol-category">Beauty & Makeup</span>
                        </div>
                        <p class="kol-bio">
                            Professional makeup artist sharing beauty tutorials, skincare routines, and product reviews.
                        </p>
                        <div class="kol-stats">
                            <div class="kol-stat">
                                <span class="kol-stat-value">1.5M</span>
                                <span class="kol-stat-label">Followers</span>
                            </div>
                            <div class="kol-stat">
                                <span class="kol-stat-value">7.2%</span>
                                <span class="kol-stat-label">Engagement</span>
                            </div>
                            <div class="kol-stat">
                                <span class="kol-stat-value">280K</span>
                                <span class="kol-stat-label">Avg Views</span>
                            </div>
                        </div>
                        <div class="kol-metrics">
                            <span class="metric-tag good">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Top Rated
                            </span>
                            <span class="metric-tag">
                                📍 TP.HCM
                            </span>
                            <span class="metric-tag">
                                ⚡ Fast Growing
                            </span>
                        </div>
                        <div class="kol-actions">
                            <button class="btn btn-primary" style="flex: 1;">View Profile</button>
                            <button class="btn btn-outline btn-icon">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                 <!-- KOL Card 2 -->
                <div class="kol-card fade-in" style="animation-delay: 0.1s;">
                    <div class="kol-card-header">
                        <img src="https://via.placeholder.com/400x200/00D4AA/ffffff?text=Beauty+Tutorials" alt="Cover" class="kol-cover-image">
                        <span class="kol-badge rising">Rising Star</span>
                        <div class="kol-avatar-wrapper">
                            <div class="kol-avatar">MH</div>
                        </div>
                    </div>
                    <div class="kol-card-body">
                        <div class="kol-info">
                            <div class="kol-name">
                                Minh Hằng
                                <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                            </div>
                            <div class="kol-handle">@minhang.beauty</div>
                            <span class="kol-category">Beauty & Makeup</span>
                        </div>
                        <p class="kol-bio">
                            Professional makeup artist sharing beauty tutorials, skincare routines, and product reviews.
                        </p>
                        <div class="kol-stats">
                            <div class="kol-stat">
                                <span class="kol-stat-value">1.5M</span>
                                <span class="kol-stat-label">Followers</span>
                            </div>
                            <div class="kol-stat">
                                <span class="kol-stat-value">7.2%</span>
                                <span class="kol-stat-label">Engagement</span>
                            </div>
                            <div class="kol-stat">
                                <span class="kol-stat-value">280K</span>
                                <span class="kol-stat-label">Avg Views</span>
                            </div>
                        </div>
                        <div class="kol-metrics">
                            <span class="metric-tag good">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Top Rated
                            </span>
                            <span class="metric-tag">
                                📍 TP.HCM
                            </span>
                            <span class="metric-tag">
                                ⚡ Fast Growing
                            </span>
                        </div>
                        <div class="kol-actions">
                            <button class="btn btn-primary" style="flex: 1;">View Profile</button>
                            <button class="btn btn-outline btn-icon">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- More KOL Cards... (3-12) -->
                <!-- Truncated for brevity - would include all 12 cards as in original -->
                
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn" disabled>
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/>
                    </svg>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">5</button>
                <span style="padding: 0 0.5rem; color: var(--gray-600);">...</span>
                <button class="page-btn">237</button>
                <button class="page-btn">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Toggle Filters
        function toggleFilters() {
            const filtersContent = document.getElementById('filtersContent');
            const toggleText = document.getElementById('filterToggleText');
            
            if (filtersContent.classList.contains('collapsed')) {
                filtersContent.classList.remove('collapsed');
                toggleText.textContent = 'Hide Filters';
            } else {
                filtersContent.classList.add('collapsed');
                toggleText.textContent = 'Show Filters';
            }
        }
        
        // Filter chips functionality
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                // Clear other chips in the same group
                const siblings = this.parentElement.querySelectorAll('.filter-chip');
                siblings.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Remove filter tag
        function removeFilter(button) {
            button.parentElement.remove();
        }

        // View toggle
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Pagination
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.disabled) {
                    document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
        
        // Apply filters
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                // Show active filters section when filters are applied
                if (this.value !== this.options[0].value) {
                    document.querySelector('.active-filters').style.display = 'flex';
                }
            });
        });
    </script>
@endsection
