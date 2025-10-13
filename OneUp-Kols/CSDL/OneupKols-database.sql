-- =============================================
-- OneUp KOL Analytics Database Schema
-- Version: 1.0
-- Database: MySQL 8.0+
-- =============================================

-- Create Database
CREATE DATABASE IF NOT EXISTS oneup_kol_analytics
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE oneup_kol_analytics;

-- =============================================
-- 1. USER MANAGEMENT TABLES
-- =============================================


GINE=InnoDB;


-- Teams/Organizations
CREATE TABLE organizations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    logo_url VARCHAR(500),
    website VARCHAR(255),
    industry VARCHAR(100),
    size ENUM('1-10', '11-50', '51-200', '201-500', '500+'),
    created_by BIGINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id),
    INDEX idx_slug (slug)
) ENGINE=InnoDB;

-- Organization members
CREATE TABLE organization_members (
    organization_id INT UNSIGNED,
    user_id BIGINT UNSIGNED,
    role ENUM('owner', 'admin', 'member', 'viewer') DEFAULT 'member',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (organization_id, user_id),
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 2. KOL (KEY OPINION LEADER) TABLES
-- =============================================

-- KOL profiles
CREATE TABLE kols (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    platform_id VARCHAR(100) UNIQUE NOT NULL, -- TikTok ID
    username VARCHAR(100) UNIQUE NOT NULL,
    display_name VARCHAR(255),
    bio TEXT,
    avatar_url VARCHAR(500),
    category VARCHAR(50),
    sub_category VARCHAR(50),
    location_country VARCHAR(2), -- ISO country code
    location_city VARCHAR(100),
    language VARCHAR(10),
    is_verified BOOLEAN DEFAULT FALSE,
    tier ENUM('nano', 'micro', 'mid', 'macro', 'mega') DEFAULT 'nano',
    status ENUM('active', 'inactive', 'banned') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_category (category),
    INDEX idx_tier (tier),
    INDEX idx_location (location_country, location_city)
) ENGINE=InnoDB;

-- KOL statistics (updated regularly)
CREATE TABLE kol_stats (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kol_id BIGINT UNSIGNED NOT NULL,
    followers_count BIGINT UNSIGNED DEFAULT 0,
    following_count INT UNSIGNED DEFAULT 0,
    total_posts INT UNSIGNED DEFAULT 0,
    total_likes BIGINT UNSIGNED DEFAULT 0,
    total_comments BIGINT UNSIGNED DEFAULT 0,
    total_shares BIGINT UNSIGNED DEFAULT 0,
    total_views BIGINT UNSIGNED DEFAULT 0,
    avg_engagement_rate DECIMAL(5,2) DEFAULT 0.00, -- percentage
    avg_likes_per_post BIGINT UNSIGNED DEFAULT 0,
    avg_comments_per_post INT UNSIGNED DEFAULT 0,
    avg_shares_per_post INT UNSIGNED DEFAULT 0,
    avg_views_per_post BIGINT UNSIGNED DEFAULT 0,
    avg_completion_rate DECIMAL(5,2) DEFAULT 0.00, -- percentage
    posts_per_week DECIMAL(4,2) DEFAULT 0.00,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kol_id) REFERENCES kols(id) ON DELETE CASCADE,
    INDEX idx_kol_date (kol_id, recorded_at),
    INDEX idx_engagement (avg_engagement_rate)
) ENGINE=InnoDB;

-- KOL audience demographics
CREATE TABLE kol_audience (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kol_id BIGINT UNSIGNED NOT NULL,
    gender_male_pct DECIMAL(5,2) DEFAULT 0.00,
    gender_female_pct DECIMAL(5,2) DEFAULT 0.00,
    age_13_17_pct DECIMAL(5,2) DEFAULT 0.00,
    age_18_24_pct DECIMAL(5,2) DEFAULT 0.00,
    age_25_34_pct DECIMAL(5,2) DEFAULT 0.00,
    age_35_44_pct DECIMAL(5,2) DEFAULT 0.00,
    age_45_plus_pct DECIMAL(5,2) DEFAULT 0.00,
    top_countries JSON, -- [{country: "VN", percentage: 45.2}, ...]
    top_cities JSON, -- [{city: "Ho Chi Minh", percentage: 25.3}, ...]
    interests JSON, -- ["fashion", "beauty", "lifestyle"]
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kol_id) REFERENCES kols(id) ON DELETE CASCADE,
    UNIQUE KEY unique_kol (kol_id)
) ENGINE=InnoDB;

-- KOL trust score factors
CREATE TABLE kol_trust_scores (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kol_id BIGINT UNSIGNED NOT NULL,
    overall_score INT DEFAULT 0, -- 0-100
    authentic_followers_pct DECIMAL(5,2) DEFAULT 0.00,
    engagement_quality_score INT DEFAULT 0,
    comment_authenticity_score INT DEFAULT 0,
    growth_consistency_score INT DEFAULT 0,
    content_quality_score INT DEFAULT 0,
    brand_safety_score INT DEFAULT 0,
    calculated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kol_id) REFERENCES kols(id) ON DELETE CASCADE,
    INDEX idx_kol_score (kol_id, overall_score)
) ENGINE=InnoDB;

-- KOL pricing estimates
CREATE TABLE kol_pricing (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kol_id BIGINT UNSIGNED NOT NULL,
    content_type ENUM('tiktok_video', 'instagram_post', 'instagram_story', 'instagram_reel', 'youtube_video', 'youtube_short'),
    currency VARCHAR(3) DEFAULT 'VND',
    price_min DECIMAL(12,2),
    price_max DECIMAL(12,2),
    package_deal TEXT, -- JSON with package details
    notes TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kol_id) REFERENCES kols(id) ON DELETE CASCADE,
    INDEX idx_kol_content (kol_id, content_type)
) ENGINE=InnoDB;

-- =============================================
-- 3. CONTENT & PERFORMANCE TABLES
-- =============================================

-- KOL content/posts
CREATE TABLE kol_content (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kol_id BIGINT UNSIGNED NOT NULL,
    platform_post_id VARCHAR(100) UNIQUE,
    content_type ENUM('video', 'image', 'carousel'),
    title TEXT,
    description TEXT,
    hashtags JSON, -- ["fashion", "ootd", "style"]
    thumbnail_url VARCHAR(500),
    video_url VARCHAR(500),
    duration_seconds INT,
    posted_at TIMESTAMP,
    likes_count BIGINT UNSIGNED DEFAULT 0,
    comments_count INT UNSIGNED DEFAULT 0,
    shares_count INT UNSIGNED DEFAULT 0,
    views_count BIGINT UNSIGNED DEFAULT 0,
    completion_rate DECIMAL(5,2),
    engagement_rate DECIMAL(5,2),
    is_sponsored BOOLEAN DEFAULT FALSE,
    brand_mentioned VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kol_id) REFERENCES kols(id) ON DELETE CASCADE,
    INDEX idx_kol_posted (kol_id, posted_at),
    INDEX idx_sponsored (is_sponsored)
) ENGINE=InnoDB;

-- =============================================
-- 4. CAMPAIGN MANAGEMENT TABLES
-- =============================================

-- Marketing campaigns
CREATE TABLE campaigns (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    objective ENUM('awareness', 'engagement', 'traffic', 'conversions', 'sales'),
    budget_amount DECIMAL(12,2),
    budget_currency VARCHAR(3) DEFAULT 'VND',
    start_date DATE,
    end_date DATE,
    target_reach BIGINT UNSIGNED,
    target_engagement BIGINT UNSIGNED,
    target_conversions INT UNSIGNED,
    status ENUM('draft', 'active', 'paused', 'completed', 'cancelled') DEFAULT 'draft',
    created_by BIGINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id),
    FOREIGN KEY (created_by) REFERENCES users(id),
    INDEX idx_org_status (organization_id, status),
    INDEX idx_dates (start_date, end_date)
) ENGINE=InnoDB;

-- Campaign KOLs
CREATE TABLE campaign_kols (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    campaign_id BIGINT UNSIGNED NOT NULL,
    kol_id BIGINT UNSIGNED NOT NULL,
    status ENUM('invited', 'negotiating', 'confirmed', 'rejected', 'completed') DEFAULT 'invited',
    contracted_amount DECIMAL(12,2),
    contracted_deliverables TEXT, -- JSON
    performance_bonus DECIMAL(12,2),
    notes TEXT,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    confirmed_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    FOREIGN KEY (campaign_id) REFERENCES campaigns(id) ON DELETE CASCADE,
    FOREIGN KEY (kol_id) REFERENCES kols(id),
    UNIQUE KEY unique_campaign_kol (campaign_id, kol_id),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Campaign performance tracking
CREATE TABLE campaign_performance (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    campaign_id BIGINT UNSIGNED NOT NULL,
    date DATE NOT NULL,
    total_reach BIGINT UNSIGNED DEFAULT 0,
    total_impressions BIGINT UNSIGNED DEFAULT 0,
    total_engagements BIGINT UNSIGNED DEFAULT 0,
    total_clicks INT UNSIGNED DEFAULT 0,
    total_conversions INT UNSIGNED DEFAULT 0,
    total_sales DECIMAL(12,2) DEFAULT 0.00,
    avg_engagement_rate DECIMAL(5,2) DEFAULT 0.00,
    cost_per_view DECIMAL(10,4) DEFAULT 0.00,
    cost_per_engagement DECIMAL(10,4) DEFAULT 0.00,
    cost_per_click DECIMAL(10,4) DEFAULT 0.00,
    cost_per_conversion DECIMAL(10,4) DEFAULT 0.00,
    roi_percentage DECIMAL(8,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (campaign_id) REFERENCES campaigns(id) ON DELETE CASCADE,
    UNIQUE KEY unique_campaign_date (campaign_id, date),
    INDEX idx_date (date)
) ENGINE=InnoDB;

-- =============================================
-- 5. BILLING & SUBSCRIPTION TABLES
-- =============================================

-- Subscription plans
CREATE TABLE subscription_plans (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE,
    description TEXT,
    price_monthly DECIMAL(10,2),
    price_yearly DECIMAL(10,2),
    currency VARCHAR(3) DEFAULT 'VND',
    max_users INT,
    max_kols_tracking INT,
    max_campaigns INT,
    max_api_calls INT,
    storage_gb INT,
    features JSON, -- ["feature1", "feature2", ...]
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB;

-- User/Organization subscriptions
CREATE TABLE subscriptions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,
    plan_id INT UNSIGNED NOT NULL,
    status ENUM('trial', 'active', 'cancelled', 'expired', 'suspended') DEFAULT 'trial',
    billing_cycle ENUM('monthly', 'yearly') DEFAULT 'monthly',
    current_period_start DATE,
    current_period_end DATE,
    trial_ends_at DATE,
    cancelled_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id),
    FOREIGN KEY (plan_id) REFERENCES subscription_plans(id),
    INDEX idx_org_status (organization_id, status),
    INDEX idx_period (current_period_end)
) ENGINE=InnoDB;

-- Payment methods
CREATE TABLE payment_methods (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,
    type ENUM('credit_card', 'debit_card', 'bank_transfer', 'paypal', 'stripe'),
    is_default BOOLEAN DEFAULT FALSE,
    card_brand VARCHAR(20), -- Visa, Mastercard, etc.
    card_last4 VARCHAR(4),
    card_exp_month TINYINT,
    card_exp_year SMALLINT,
    billing_name VARCHAR(255),
    billing_email VARCHAR(255),
    billing_phone VARCHAR(20),
    billing_address TEXT,
    stripe_payment_method_id VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    INDEX idx_org_default (organization_id, is_default)
) ENGINE=InnoDB;

-- Invoices
CREATE TABLE invoices (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invoice_number VARCHAR(50) UNIQUE NOT NULL,
    organization_id INT UNSIGNED NOT NULL,
    subscription_id BIGINT UNSIGNED,
    amount DECIMAL(12,2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'VND',
    status ENUM('draft', 'pending', 'paid', 'failed', 'cancelled') DEFAULT 'pending',
    due_date DATE,
    paid_at TIMESTAMP NULL,
    payment_method_id BIGINT UNSIGNED,
    stripe_invoice_id VARCHAR(255),
    items JSON, -- Line items details
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id),
    FOREIGN KEY (subscription_id) REFERENCES subscriptions(id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id),
    INDEX idx_number (invoice_number),
    INDEX idx_org_status (organization_id, status),
    INDEX idx_due (due_date)
) ENGINE=InnoDB;

-- =============================================
-- 6. ANALYTICS & REPORTING TABLES
-- =============================================

-- Saved reports
CREATE TABLE saved_reports (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    type ENUM('campaign', 'kol', 'performance', 'custom'),
    filters JSON, -- Saved filter settings
    columns JSON, -- Selected columns
    chart_settings JSON,
    schedule ENUM('none', 'daily', 'weekly', 'monthly') DEFAULT 'none',
    recipients JSON, -- Email addresses
    created_by BIGINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id),
    INDEX idx_org_type (organization_id, type)
) ENGINE=InnoDB;

-- User saved KOLs (favorites)
CREATE TABLE user_saved_kols (
    user_id BIGINT UNSIGNED,
    kol_id BIGINT UNSIGNED,
    notes TEXT,
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, kol_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (kol_id) REFERENCES kols(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 7. SYSTEM & AUDIT TABLES
-- =============================================

-- API usage tracking
CREATE TABLE api_usage (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_id INT UNSIGNED NOT NULL,
    endpoint VARCHAR(255),
    method VARCHAR(10),
    response_code INT,
    response_time_ms INT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id),
    INDEX idx_org_date (organization_id, created_at),
    INDEX idx_endpoint (endpoint)
) ENGINE=InnoDB;

-- Activity logs
CREATE TABLE activity_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    organization_id INT UNSIGNED,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(50), -- 'campaign', 'kol', 'report', etc.
    entity_id BIGINT UNSIGNED,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (organization_id) REFERENCES organizations(id),
    INDEX idx_user_date (user_id, created_at),
    INDEX idx_entity (entity_type, entity_id),
    INDEX idx_action (action)
) ENGINE=InnoDB;

-- Notifications
CREATE TABLE notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    type VARCHAR(50) NOT NULL,
    title VARCHAR(255),
    message TEXT,
    data JSON, -- Additional data
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_unread (user_id, is_read),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- =============================================
-- 8. INITIAL DATA INSERTS
-- =============================================


-- Insert subscription plans
INSERT INTO subscription_plans (name, slug, description, price_monthly, price_yearly, max_users, max_kols_tracking, max_campaigns, max_api_calls, storage_gb, features) VALUES
('Starter', 'starter', 'Perfect for small teams', 0, 0, 1, 10, 2, 1000, 5, '["Basic Analytics", "Email Support"]'),
('Professional', 'professional', 'For growing businesses', 2500000, 25000000, 5, 9999, 9999, 100000, 50, '["Advanced Analytics", "API Access", "Priority Support", "Custom Reports"]'),
('Enterprise', 'enterprise', 'Custom solutions for large organizations', NULL, NULL, 9999, 9999, 9999, 9999999, 500, '["Everything in Pro", "Dedicated Support", "Custom Integrations", "SLA"]');

-- =============================================
-- 9. INDEXES FOR PERFORMANCE
-- =============================================

-- Additional performance indexes
CREATE INDEX idx_kol_stats_latest ON kol_stats(kol_id, recorded_at DESC);
CREATE INDEX idx_campaign_active ON campaigns(status, start_date, end_date);
CREATE INDEX idx_invoice_recent ON invoices(created_at DESC);
CREATE INDEX idx_content_recent ON kol_content(posted_at DESC);

-- =============================================
-- 10. VIEWS FOR COMMON QUERIES
-- =============================================

-- View: Current KOL stats
CREATE VIEW v_kol_current_stats AS
SELECT 
    k.*,
    ks.followers_count,
    ks.avg_engagement_rate,
    ks.total_posts,
    kt.overall_score as trust_score
FROM kols k
LEFT JOIN (
    SELECT kol_id, MAX(recorded_at) as latest_date
    FROM kol_stats
    GROUP BY kol_id
) latest ON k.id = latest.kol_id
LEFT JOIN kol_stats ks ON ks.kol_id = latest.kol_id AND ks.recorded_at = latest.latest_date
LEFT JOIN kol_trust_scores kt ON kt.kol_id = k.id
WHERE k.status = 'active';

-- View: Campaign summary
CREATE VIEW v_campaign_summary AS
SELECT 
    c.*,
    o.name as organization_name,
    COUNT(DISTINCT ck.kol_id) as total_kols,
    SUM(ck.contracted_amount) as total_contracted,
    MAX(cp.total_reach) as current_reach,
    MAX(cp.total_engagements) as current_engagements
FROM campaigns c
LEFT JOIN organizations o ON c.organization_id = o.id
LEFT JOIN campaign_kols ck ON c.id = ck.campaign_id
LEFT JOIN campaign_performance cp ON c.id = cp.campaign_id
GROUP BY c.id;

-- =============================================
-- END OF SCHEMA
-- =============================================