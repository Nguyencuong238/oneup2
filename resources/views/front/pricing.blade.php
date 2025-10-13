@extends('layouts.front')

@section('meta')
    <title>Pricing Plans - OneUp KOL Analytics</title>
    <meta name="description"
        content="OneUp KOL Analytics Pricing - Choose the perfect plan for your TikTok influencer marketing needs">
@endsection

@section('css')
    <style>
        /* Additional styles for pricing page */
        .pricing-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background: #E0E0E0;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .toggle-switch.active {
            background: var(--gradient);
        }
        
        .toggle-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .toggle-switch.active .toggle-slider {
            transform: translateX(30px);
        }
        
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3rem;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }
        
        .comparison-table th,
        .comparison-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #E0E0E0;
            color: var(--dark-blue);
        }
        
        .comparison-table th {
            background: #F8F9FA;
            font-weight: 600;
        }
        
        .comparison-table tr:hover {
            background: #F8F9FA;
        }
        
        .check-icon {
            color: var(--success);
            font-size: 20px;
        }
        
        .x-icon {
            color: #CCC;
            font-size: 20px;
        }
        
        .faq-item {
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            background: white;
        }
        
        .faq-question {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: 600;
    color: var(--dark-blue);
        }
        
        .faq-question:hover {
            background: #F8F9FA;
        }
        
        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            color: var(--gray-light);
            line-height: 1.8;
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 0 1.5rem 1.5rem;
        }
        .faq-answer p {
            color: var(--gray-700)
        }
        .faq-icon {
            transition: transform 0.3s;
            color: var(--gray-light);
        }
        
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
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
            position: relative;
            background: white;
            border-radius: 20px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            z-index: 1;
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
        
        .filter-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        
        .filter-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        textarea.filter-input {
            resize: vertical;
            font-family: inherit;
        }
        .pricing-name {
            color: var(--gray-100);
        }
        .pricing-features li {
            color: var(--gray-400)
        }
    </style>
@endsection

@section('page')
    <!-- Hero Section -->
    <section class="hero" style="padding: 120px 0 60px;">
        <div class="container">
            <div class="text-center">
                <div class="badge badge-success mb-3 fade-in">💰 Save 20% with Annual Plans</div>
                <h1 class="mb-3 color-dark-blue fade-in">
                    Simple, Transparent <span class="gradient-text">Pricing</span>
                </h1>
                <p class="section-description mb-4 fade-in">
                    Choose the perfect plan for your TikTok influencer marketing needs
                </p>
                
                <!-- Pricing Toggle -->
                <div class="pricing-toggle fade-in">
                    <span class="color-dark-blue">Monthly</span>
                    <div class="toggle-switch" id="billingToggle">
                        <div class="toggle-slider"></div>
                    </div>
                    <span class="color-dark-blue">Annual <span class="badge badge-success">-20%</span></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="pricing-container">
                <!-- Starter Plan -->
                <div class="pricing-card fade-in">
                    <div class="pricing-header">
                        <h3 class="pricing-name">Starter</h3>
                        <div class="pricing-price">
                            <span class="monthly-price">₫2.9M</span>
                            <span class="annual-price" style="display: none;">₫2.3M</span>
                        </div>
                        <div class="pricing-period">per month</div>
                    </div>
                    <ul class="pricing-features">
                        <li>Up to 100 KOL searches/month</li>
                        <li>Basic analytics dashboard</li>
                        <li>5 campaign slots</li>
                        <li>Export to CSV</li>
                        <li>Email support</li>
                        <li>7-day data history</li>
                    </ul>
                    <a href="{{route('user.register', ['plan' => 'starter'])}}" class="btn btn-outline btn-large" style="width: 100%;">
                        Start Free Trial
                    </a>
                </div>

                <!-- Professional Plan -->
                <div class="pricing-card featured fade-in" style="animation-delay: 0.1s;">
                    <div class="pricing-header">
                        <h3 class="pricing-name">Professional</h3>
                        <div class="pricing-price">
                            <span class="monthly-price">₫9.9M</span>
                            <span class="annual-price" style="display: none;">₫7.9M</span>
                        </div>
                        <div class="pricing-period">per month</div>
                    </div>
                    <ul class="pricing-features">
                        <li>Unlimited KOL searches</li>
                        <li>Advanced analytics & AI insights</li>
                        <li>20 campaign slots</li>
                        <li>API access (1000 calls/day)</li>
                        <li>Priority support</li>
                        <li>90-day data history</li>
                        <li>Custom reports</li>
                        <li>Team collaboration (5 users)</li>
                    </ul>
                    <a href="{{route('user.register', ['plan' => 'professional'])}}" class="btn btn-primary btn-large" style="width: 100%;">
                        Start Free Trial
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card fade-in" style="animation-delay: 0.2s;">
                    <div class="pricing-header">
                        <h3 class="pricing-name">Enterprise</h3>
                        <div class="pricing-price">Custom</div>
                        <div class="pricing-period">tailored to your needs</div>
                    </div>
                    <ul class="pricing-features">
                        <li>Everything in Professional</li>
                        <li>Unlimited campaigns</li>
                        <li>Unlimited API calls</li>
                        <li>Dedicated account manager</li>
                        <li>Custom integrations</li>
                        <li>Unlimited data history</li>
                        <li>SLA guarantee</li>
                        <li>Unlimited team members</li>
                    </ul>
                    <button class="btn btn-secondary btn-large" style="width: 100%;" onclick="openContactModal()">
                        Contact Sales
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Comparison -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="text-center color-dark-blue mb-4">Detailed Feature Comparison</h2>
            
            <div style="overflow-x: auto;">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Features</th>
                            <th>Starter</th>
                            <th>Professional</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">KOL Discovery</td>
                        </tr>
                        <tr>
                            <td>KOL Search</td>
                            <td>100/month</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Advanced Filters</td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                        </tr>
                        <tr>
                            <td>AI Recommendations</td>
                            <td><span class="x-icon">✕</span></td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Analytics</td>
                        </tr>
                        <tr>
                            <td>Basic Metrics</td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                        </tr>
                        <tr>
                            <td>Audience Demographics</td>
                            <td>Basic</td>
                            <td>Advanced</td>
                            <td>Advanced</td>
                        </tr>
                        <tr>
                            <td>Fraud Detection</td>
                            <td><span class="x-icon">✕</span></td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                        </tr>
                        <tr>
                            <td>Competitor Analysis</td>
                            <td><span class="x-icon">✕</span></td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Campaign Management</td>
                        </tr>
                        <tr>
                            <td>Active Campaigns</td>
                            <td>5</td>
                            <td>20</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Real-time Tracking</td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                            <td><span class="check-icon">✓</span></td>
                        </tr>
                        <tr>
                            <td>ROI Calculator</td>
                            <td>Basic</td>
                            <td>Advanced</td>
                            <td>Custom</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background: #F0F0F0; font-weight: 600;">Support & Service</td>
                        </tr>
                        <tr>
                            <td>Support</td>
                            <td>Email</td>
                            <td>Priority Email & Chat</td>
                            <td>24/7 Phone & Dedicated Manager</td>
                        </tr>
                        <tr>
                            <td>Training</td>
                            <td>Self-service</td>
                            <td>Webinars</td>
                            <td>Custom onboarding</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Can I change my plan anytime?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! You can upgrade or downgrade your plan at any time. When upgrading, you'll have immediate access to new features. When downgrading, changes take effect at the next billing cycle.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Is there a free trial?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! All plans come with a 14-day free trial. No credit card required. You can explore all features and cancel anytime during the trial period.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>What payment methods do you accept?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>We accept all major credit cards (Visa, MasterCard, American Express), bank transfers, and popular Vietnamese payment methods including MoMo, ZaloPay, and VNPay.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Can I get a refund?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>We offer a 30-day money-back guarantee for all new customers. If you're not satisfied with our platform, contact us within 30 days of your purchase for a full refund.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Do you offer discounts for agencies?</span>
                        <span class="faq-icon">▼</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! We offer special pricing for agencies managing multiple brands. Contact our sales team to discuss custom packages and volume discounts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);">
        <div class="container text-center">
            <h2 class="mb-3 color-dark-blue">Ready to Get Started?</h2>
            <p class="mb-4 color-gray-600" style="font-size: 18px;">
                Join 500+ brands optimizing their TikTok influencer campaigns
            </p>
            <div class="d-flex gap-2 justify-center">
                <a href="{{route('user.register')}}" class="btn btn-primary btn-large">
                    Start 14-Day Free Trial
                </a>
                <button class="btn btn-outline btn-large" onclick="openContactModal()">
                    Schedule Demo
                </button>
            </div>
            <p class="mt-3" style="color: var(--gray-light);">
                No credit card required • Cancel anytime
            </p>
        </div>
    </section>
    <!-- Contact Modal -->
    <div id="contactModal" class="modal">
        <div class="modal-overlay" onclick="closeContactModal()"></div>
        <div class="modal-content">
            <button class="modal-close" onclick="closeContactModal()">×</button>
            <h3 class="mb-3">Contact Sales Team</h3>
            <form onsubmit="handleContactForm(event)">
                <div class="mb-3">
                    <input type="text" class="filter-input" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="filter-input" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="filter-input" placeholder="Company Name">
                </div>
                <div class="mb-3">
                    <textarea class="filter-input" rows="4" placeholder="Tell us about your needs"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
        // Billing Toggle
        const billingToggle = document.getElementById('billingToggle');
        const monthlyPrices = document.querySelectorAll('.monthly-price');
        const annualPrices = document.querySelectorAll('.annual-price');
        
        billingToggle?.addEventListener('click', function() {
            this.classList.toggle('active');
            
            if (this.classList.contains('active')) {
                monthlyPrices.forEach(price => price.style.display = 'none');
                annualPrices.forEach(price => price.style.display = 'block');
            } else {
                monthlyPrices.forEach(price => price.style.display = 'block');
                annualPrices.forEach(price => price.style.display = 'none');
            }
        });
        
        // FAQ Toggle
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
        
        // Modal Functions
        function openContactModal() {
            document.getElementById('contactModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeContactModal() {
            document.getElementById('contactModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        
        function handleContactForm(event) {
            event.preventDefault();
            // Simulate form submission
            alert('Thank you for contacting us! We will get back to you within 24 hours.');
            closeContactModal();
            event.target.reset();
        }
        
        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeContactModal();
            }
        });
    </script>
    
    <script>

        $(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                $(this).find('button').prop('disabled', true);
                
                var data = {
                        name: $('#name').val(),
                        phone: $('#phone').val(),
                        email: $('#email').val(),
                        product: $('#product').val(),
                        schedule: $('#schedule').val(),
                        message: $('#message').val()
                    };
                    
                $.ajax({
                    type: 'post',
                    url: "{{ route('newsletters') }}",
                    data: data,
                }).then(function(res) {
                    
                    if (res.success) {
                        toastr.success('Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
                        $('#contactForm')[0].reset();
                    } else {
                        toastr.error(res.msg);
                    }
                    

                });
                $(this).find('button').prop('disabled', false);
            });
        });
    </script>
@endsection
