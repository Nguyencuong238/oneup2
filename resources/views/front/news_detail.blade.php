@extends('layouts.front')

@section('meta')
    <title>{{ $post->title }} | Vinhomes Green Paradise</title>
    <meta name="description" content="{{ $post->exerpt }}">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->exerpt }}">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:locale" content="vi_VN">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->exerpt }}">
    <meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">
@endsection

@section('css')
    <!-- Custom CSS for News Detail -->
    <style>
        .breadcrumb-section {
            background: linear-gradient(135deg, #05668d 0%, #00a896 100%);
            padding: 120px 0 60px;
            margin-top: 0;
        }

        ol.breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 10px;
            color: #fff;
            list-style: none;

        }

        /* Article Header */
        .article-header {
            padding: 40px 0;
            background: #f8f9fa;
        }

        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .breadcrumb-nav a {
            color: #6c757d;
            transition: color 0.3s;
        }

        .breadcrumb-nav a:hover {
            color: #00a896;
        }

        .article-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .article-meta span {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: #6c757d;
        }

        .article-category {
            background: linear-gradient(135deg, #00a896 0%, #02c39a 100%);
            color: white !important;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px !important;
        }

        .article-title {
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .article-lead {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .article-author {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            flex-wrap: wrap;
        }

        .article-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .author-info {
            flex: 1;
            display: flex;
        }

        .author-info strong {
            display: block;
            margin-bottom: 3px;
        }

        .author-info span {
            font-size: 14px;
            color: #6c757d;
        }

        .share-buttons {
            display: flex;
            gap: 10px;
        }

        .share-btn {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .share-btn.facebook {
            background: #3b5998;
        }

        .share-btn.twitter {
            background: #1da1f2;
        }

        .share-btn.linkedin {
            background: #0077b5;
        }

        .share-btn.copy-link {
            background: #6c757d;
        }

        .share-btn:hover {
            transform: scale(1.1);
        }

        /* Article Content */
        .article-content {
            padding: 60px 0;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 50px;
        }

        .article-featured-image {
            margin-bottom: 30px;
        }

        .article-featured-image img {
            width: 100%;
            border-radius: 16px;
        }

        .image-caption {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
            font-style: italic;
        }

        /* Article Typography */
        .article-body {
            font-size: 17px;
            line-height: 1.8;
            color: #333;
        }

        .article-body h2 {
            font-size: 28px;
            margin: 40px 0 20px;
            color: #00a896;
        }

        .article-body h3 {
            font-size: 22px;
            margin: 30px 0 15px;
        }

        .article-body p {
            margin-bottom: 20px;
        }

        .first-paragraph .drop-cap {
            float: left;
            font-size: 75px;
            line-height: 60px;
            padding: 0 8px 0 3px;
            margin-top: 3px;
            font-weight: 700;
            color: #00a896;
        }

        .article-quote {
            position: relative;
            margin: 40px 0;
            padding: 30px 40px;
            background: linear-gradient(135deg, rgba(0, 168, 150, 0.05) 0%, rgba(2, 195, 154, 0.05) 100%);
            border-left: 4px solid #00a896;
            border-radius: 8px;
        }

        .article-quote i {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #00a896;
            opacity: 0.3;
        }

        .article-quote p {
            font-size: 19px;
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .article-quote cite {
            display: block;
            text-align: right;
            color: #6c757d;
        }

        /* Gallery Grid */
        .article-gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 30px 0;
        }

        .article-gallery img {
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .article-gallery img:hover {
            transform: scale(1.05);
        }

        /* Feature List */
        .feature-list {
            list-style: none;
            margin: 20px 0;
        }

        .feature-list li {
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .feature-list li strong {
            color: #00a896;
        }

        /* Highlight Box */
        .highlight-box {
            background: linear-gradient(135deg, #00a896 0%, #02c39a 100%);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin: 30px 0;
        }

        .highlight-box h3 {
            color: white;
            margin-bottom: 20px;
        }

        .highlight-box ul {
            list-style: none;
        }

        .highlight-box li {
            padding: 8px 0;
            padding-left: 25px;
            position: relative;
        }

        .highlight-box li:before {
            content: "✓";
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* Timeline */
        .timeline-simple {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .timeline-item {
            text-align: center;
            position: relative;
        }

        .timeline-item:not(:last-child):after {
            content: '';
            position: absolute;
            top: 10px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #dee2e6;
        }

        .timeline-date {
            display: block;
            font-weight: 700;
            color: #00a896;
            margin-bottom: 5px;
        }

        /* Infographic */
        .article-infographic {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 16px;
            margin: 30px 0;
            text-align: center;
        }

        .infographic-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .infographic-item {
            display: flex;
            flex-direction: column;
        }

        .infographic-item .number {
            font-size: 36px;
            font-weight: 800;
            color: #00a896;
        }

        .infographic-item .label {
            color: #6c757d;
            font-size: 14px;
        }

        /* Expert Quote */
        .expert-quote {
            background: white;
            border: 2px solid #00a896;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
        }

        /* Article CTA */
        .article-cta {
            background: linear-gradient(135deg, rgba(0, 168, 150, 0.05) 0%, rgba(2, 195, 154, 0.05) 100%);
            border: 2px solid #00a896;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            margin: 40px 0;
        }

        .article-cta h3 {
            color: #00a896;
            margin-bottom: 10px;
        }

        .article-cta .btn {
            margin-top: 20px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #00a896 0%, #02c39a 100%);
            color: white;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        /* Tags */
        .article-tags {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #dee2e6;
        }

        .tag-label {
            font-weight: 600;
        }

        .tag {
            padding: 6px 15px;
            background: #f8f9fa;
            border-radius: 20px;
            font-size: 14px;
            color: #6c757d;
            transition: all 0.3s;
        }

        .tag:hover {
            background: #00a896;
            color: white;
        }

        /* Sidebar */
        .sidebar-widget {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .sidebar-widget h3 {
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #00a896;
        }

        /* TOC Widget */
        .toc-list {
            list-style: none;
        }

        .toc-list li {
            padding: 8px 0;
        }

        .toc-list a {
            color: #6c757d;
            transition: all 0.3s;
        }

        .toc-list a:hover {
            color: #00a896;
            padding-left: 5px;
        }

        /* Quick Contact */
        .quick-contact {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .contact-btn.phone {
            background: #28a745;
            color: white;
        }

        .contact-btn.zalo {
            background: #0068ff;
            color: white;
        }

        .contact-btn.zalo img {
            width: 20px;
            height: 20px;
            /* filter: brightness(0) invert(1); */
        }

        .contact-btn.messenger {
            background: #0084ff;
            color: white;
        }

        /* Download Widget */
        .download-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .download-item i {
            font-size: 24px;
            color: #00a896;
        }

        .download-item div {
            flex: 1;
        }

        .download-item strong {
            display: block;
            font-size: 14px;
        }

        .download-item span {
            font-size: 12px;
            color: #6c757d;
        }

        .btn-download-small {
            width: 35px;
            height: 35px;
            /* background: #00a896; */
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-download-small:hover {
            transform: scale(1.1);
        }

        /* Related News */
        .related-item {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .related-item:last-child {
            border: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .related-item img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .related-content h4 {
            font-size: 14px;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .related-content h4 a {
            color: #333;
            transition: color 0.3s;
        }

        .related-content h4 a:hover {
            color: #00a896;
        }

        .related-content .date {
            font-size: 12px;
            color: #6c757d;
        }

        /* Newsletter Widget */
        .sidebar-newsletter {
            margin-top: 15px;
        }

        .sidebar-newsletter input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar-newsletter button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #00a896 0%, #02c39a 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .sidebar-newsletter button:hover {
            transform: translateY(-2px);
        }

        /* More Articles */
        .more-articles {
            padding: 60px 0;
            background: #f8f9fa;
        }

        .more-articles .section-title {
            margin-bottom: 40px;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .article-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .article-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .article-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .article-card:hover .article-image img {
            transform: scale(1.1);
        }

        .article-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #dc3545;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .article-info {
            padding: 25px;
        }

        .article-info .article-date {
            color: #6c757d;
            font-size: 14px;
        }

        .article-info h3 {
            margin: 10px 0;
            font-size: 18px;
        }

        .article-info h3 a {
            color: #333;
            transition: color 0.3s;
        }

        .article-info h3 a:hover {
            color: #00a896;
        }

        .article-info p {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 992px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }

            .articles-grid {
                grid-template-columns: 1fr;
            }

            .infographic-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .timeline-simple {
                flex-direction: column;
                gap: 20px;
            }

            .timeline-item:not(:last-child):after {
                display: none;
            }
            .article-image {
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .article-gallery {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .author-info {
                flex: inherit;
            }

            .article-author {
                justify-content: end;
            }

            .infographic-grid {
                grid-template-columns: repeat(1, 1fr);
            }

            .article-content,
            .more-articles {
                padding: 40px 0;
            }
            
        }
    </style>
    <!-- Article Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "Chính Thức Ra Mắt Phân Khu The Haven Bay",
            "datePublished": "{{$post->created_at->toIso8601String()}}",
            "dateModified": "{{$post->updated_at->toIso8601String()}}",
            "author": {
                "@type": "Person",
                "name": "Nguyễn Văn Nam"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Vinhomes Green Paradise",
                "logo": {
                "@type": "ImageObject",
                "url": "{{asset('assets/images/logo.png')}}"
                }
            },
            "image": "{{$post->getFirstMediaUrl('media')}}",
            "articleBody": "{{Str::words($post->excerpt, 15)}}"
        }
    </script>
@endsection

@section('page')

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/" style="color: #fff; text-decoration: none;">
                            Trang Chủ
                        </a>
                    </li>
                    >

                    <li class="breadcrumb-item">
                        <a href="{{route('news')}}" style="color: #fff; text-decoration: none;">
                            Tin Tức
                        </a>
                    </li>
                    >
                    <li class="breadcrumb-item active" aria-current="page" style="color: #f0f3bd;">Chi Tiết </li>
                </ol>
            </nav>
            <h1 class="page-title" style="color: #fff; font-size: 3rem; margin-top: 20px;">{{$post->title}}</h1>
        </div>
    </section>

    <!-- Article Header -->
    <section class="article-header">
        <div class="container">
            {{-- <div class="breadcrumb-nav">
                <a href="/">Trang Chủ</a>
                <span>/</span>
                <a href="{{route('news')}}">Tin Tức</a>
                <span>/</span>
                <span>Chi Tiết</span>
            </div> --}}

            <div class="article-meta">
                @if ($cat = $post->categories->first())
                    <span class="article-category">{{ $cat->name }}</span>
                @endif
                <span class="article-date"><i class="fas fa-calendar"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                <span class="article-views"><i class="fas fa-eye"></i> {{ $post->view }} lượt xem</span>
                <span class="article-reading-time"><i class="fas fa-clock"></i> 8 phút đọc</span>
            </div>

            {{-- <h1 class="article-title">{{ $post->title }}</h1> --}}

            <p class="article-lead">{{ $post->excerpt }}</p>

            <div class="article-author">

                <div class="author-info">
                    <img src="{{ asset('assets/images/photo-1472099645785-5658abf4ff4e.jpeg') }}" alt="Author">
                    <div style="margin-left: 10px;">
                        <strong>Nguyễn Văn Nam</strong>
                        <span>Phóng viên BĐS - 5 năm kinh nghiệm</span>
                    </div>
                </div>
                <div class="share-buttons">
                    <button class="share-btn facebook"><i class="fab fa-facebook-f"></i></button>
                    <button class="share-btn twitter"><i class="fab fa-twitter"></i></button>
                    <button class="share-btn linkedin"><i class="fab fa-linkedin-in"></i></button>
                    <button class="share-btn copy-link"><i class="fas fa-link"></i></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <article class="article-content">
        <div class="container">
            <div class="content-wrapper">
                <div class="main-content">
                    <!-- Featured Image -->
                    <div class="article-featured-image">
                        <img src="{{ $post->getFirstMediaUrl('media') }}" alt="{{ $post->title }}">
                        <p class="image-caption">{{ $post->title }}</p>
                    </div>

                    <!-- Article Body -->
                    <div class="article-body">
                        {!! generate_toc($post->body)['content'] !!}

                        <div class="article-cta">
                            <h3>Đăng Ký Tư Vấn Ngay</h3>
                            <p>Để nhận thông tin chi tiết và ưu đãi độc quyền phân khu The Haven Bay</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-phone-alt"></i> Liên Hệ Hotline: {{ settings('phone') }}
                            </a>
                        </div>
                    </div>

                    <!-- Article Tags -->
                    <div class="article-tags">
                        <span class="tag-label">Tags:</span>
                        @foreach ($post->tags as $tag)
                            <a href="#" class="tag">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="article-sidebar">
                    <!-- Table of Contents -->
                    <div class="sidebar-widget toc-widget">
                        <h3>Nội Dung Chính</h3>

                        {!! generate_toc($post->body)['toc'] !!}
                    </div>

                    <!-- Quick Contact -->
                    <div class="sidebar-widget contact-widget">
                        <h3>Liên Hệ Nhanh</h3>
                        <div class="quick-contact">
                            <a href="tel:{{ str_replace(' ', '', settings('phone')) }}" class="contact-btn phone">
                                <i class="fas fa-phone-alt"></i>
                                <span>{{ settings('phone') }}</span>
                            </a>
                            <a href="https://zalo.me/{{ str_replace(' ', '', settings('phone')) }}"
                                class="contact-btn zalo" target="blank">
                                <img src="{{ asset('assets/images/zalo.svg') }}" alt="Zalo">
                                <span>Chat Zalo</span>
                            </a>
                            <a href="#" class="contact-btn messenger">
                                <i class="fab fa-facebook-messenger"></i>
                                <span>Messenger</span>
                            </a>
                        </div>
                    </div>

                    <!-- Download Brochure -->
                    <div class="sidebar-widget download-widget">
                        <h3>Tải Tài Liệu</h3>
                        <div class="download-item">
                            <i class="fas fa-file-pdf"></i>
                            <div>
                                <strong>Brochure The Haven Bay</strong>
                                <span>PDF - 15MB</span>
                            </div>
                            <button class="btn-download-small">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                        <div class="download-item">
                            <i class="fas fa-file-excel"></i>
                            <div>
                                <strong>Bảng Giá Chi Tiết</strong>
                                <span>Excel - 2MB</span>
                            </div>
                            <button class="btn-download-small">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Related News -->
                    <div class="sidebar-widget related-widget">
                        <h3>Tin Tức Liên Quan</h3>
                        <div class="related-list">
                            @foreach ($relatedPosts as $rp)
                                <article class="related-item">
                                    <img src="{{ $rp->getFirstMediaUrl('media') }}" alt="{{ $rp->title }}">
                                    <div class="related-content">
                                        <h4><a href="{{ $rp->showUrl() }}">{{ $rp->title }}</a></h4>
                                        <span class="date">{{ $rp->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="sidebar-widget newsletter-widget">
                        <h3>Đăng Ký Nhận Tin</h3>
                        <p>Cập nhật tin tức mới nhất về dự án</p>
                        <form class="sidebar-newsletter" onsubmit="registerNewsletter(this, event)">
                            <input type="email" name="email" placeholder="Email của bạn">
                            <button type="submit">Đăng Ký</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </article>

    <!-- More Articles Section -->
    <section class="more-articles">
        <div class="container">
            <h2 class="section-title">Tin Tức Khác</h2>
            <div class="articles-grid">
                @foreach ($otherPosts as $op)
                    <article class="article-card">
                        <div class="article-image">
                            <img src="{{ $op->getFirstMediaUrl('media') }}" alt="{{ $op->title }}">
                            @if ($cat = $rp->categories->first())
                                <span class="article-badge">{{ $cat->name }}</span>
                            @endif
                        </div>
                        <div class="article-info">
                            <span class="article-date">{{ $op->created_at->format('d/m/Y') }}</span>
                            <h3><a href="{{ $op->showUrl() }}">{{ $op->title }}</a></h3>
                            <p>{{ Str::words($op->excerpt, 15) }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Share buttons
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.classList.contains('copy-link')) {
                    navigator.clipboard.writeText(window.location.href);
                    alert('Link đã được sao chép!');
                }
            });
        });
    </script>
@endsection
