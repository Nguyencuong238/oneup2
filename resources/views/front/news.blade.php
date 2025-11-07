@extends('layouts.front')

@section('meta')
    <title>Tin Tức & Sự Kiện - Vinhomes Green Paradise Cần Giờ</title>
    <meta name="description"
        content="Cập nhật tin tức mới nhất về dự án Vinhomes Green Paradise - Tiến độ xây dựng, sự kiện, ưu đãi đặc biệt">
    <meta property="og:title" content="Tin Tức & Sự Kiện - Vinhomes Green Paradise Cần Giờ">
    <meta property="og:description"
        content="Cập nhật tin tức mới nhất về dự án Vinhomes Green Paradise - Tiến độ xây dựng, sự kiện, ưu đãi đặc biệt">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('css')
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

        .sidebar-widget a {
            padding: 5px 0;
            background: #f8f9fa;
            border-radius: 15px;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 14px;
            line-height: 1.4;
            display: block;
        }

        .widget-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .widget-content img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .widget-content .widget-text {
            flex: 1;
        }
    </style>

    <style>
        /* News specific styles */
        .news-hero {
            background: linear-gradient(135deg, #05668d 0%, #00a896 100%);
            padding: 150px 0 80px;
            text-align: center;
            color: #fff;
        }

        .news-categories {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .cat-tag {
            padding: 8px 20px;
            background: #f8f9fa;
            border-radius: 20px;
            color: var(--text-dark);
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
            font-weight: 600;
        }

        .cat-tag.active, .cat-tag:hover, .cat-tag:active, .cat-tag:focus {
            color: #fff;
            background: var(--gradient-primary);
        }

        .news-main {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        .article-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            margin-bottom: 30px;
        }

        .article-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
        }

        .article-image {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-image img {
            transform: scale(1.05);
        }

        .article-category {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--primary-color);
            color: #fff;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .article-content {
            padding: 30px;
        }

        .article-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            color: var(--text-light);
            font-size: 14px;
        }

        .sidebar-widget {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
        }

        .widget-title {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }

        .form-search button {
            padding: 10px 20px;
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-search input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .pagination button {
            padding: 10px 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .pagination button.active,
        .pagination button:hover {
            background: var(--primary-color);
            color: #fff;
            border: none;
        }

        @media (max-width: 768px) {
            .news-main {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('page')
    <!-- News Hero -->
    <section class="news-hero">
        <div class="container">
            <h1 style="font-size: 3rem; margin-bottom: 15px;">Tin Tức & Sự Kiện</h1>
            <p style="font-size: 1.2rem; color: rgba(255,255,255,0.9);">Cập nhật mới nhất về dự án Green Paradise</p>
        </div>
    </section>

    <!-- Main Content -->
    <main style="padding: 60px 0; background: #f8f9fa;">
        <div class="container">
            <!-- Categories -->
            <div class="news-categories">
                <a href="{{route('news')}}" class="cat-tag @if(!request()->category) active @endif">
                    Tất Cả
                </a>

                @foreach ($categories as $cat)
                    <a href="{{route('news', ['category' => $cat->slug])}}" class="cat-tag @if(request()->category == $cat->slug) active @endif">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- News Grid -->
            <div class="news-main">
                <!-- Main Articles -->
                <div class="articles-list">
                    @foreach ($posts as $post)
                        <article class="article-card">
                            <div class="article-image">
                                <img src="{{ $post->getFirstMediaUrl('media') }}" alt="{{ $post->title }}">
                                <span class="article-category">{{ $post->categories->first()?->name }}</span>
                            </div>
                            <div class="article-content">
                                <div class="article-meta">
                                    <span><i class="far fa-calendar"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                                    <span><i class="far fa-user"></i> Admin</span>
                                    <span><i class="far fa-eye"></i> {{ $post->view }} views</span>
                                </div>
                                <h2 style="margin-bottom: 15px; font-size: 24px;">
                                    <a href="{{ $post->showUrl() }}"
                                        style="color: var(--text-dark); text-decoration: none;">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p style="color: var(--text-light); line-height: 1.6; margin-bottom: 20px;">
                                    {{ $post->excerpt }}
                                </p>
                                <a href="{{ $post->showUrl() }}" class="btn btn-outline">Đọc Tiếp →</a>
                            </div>
                        </article>
                    @endforeach

                    {{ $posts->links('vendor.pagination.custom') }}
                </div>

                <!-- Sidebar -->
                <aside class="sidebar">
                    <div class="position-sticky" style="top: 85px;">
                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Tìm Kiếm</h3>

                        <form style="display: flex; gap: 10px;" class="form-search">
                            <input type="text" name="search" placeholder="Nhập từ khóa..."
                                value="{{ request()->search }}">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <!-- Recent Posts -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Tin Mới Nhất</h3>
                        <div class="widget-content">
                            @foreach ($newPosts as $newPost)
                                <div style="display: flex; gap: 15px;">
                                    <img src="{{ $newPost->getFirstMediaUrl('media') }}" alt="{{ $newPost->title }}">
                                    <div class="widget-text">
                                        <h4 class="d-block" style="font-size: 14px; margin-bottom: 5px;">
                                            <a href="{{ $newPost->showUrl() }}"
                                                style="color: var(--text-dark); text-decoration: none;">{{ $newPost->title }}</a>
                                        </h4>
                                        <span
                                            style="color: var(--text-light); font-size: 12px;">{{ $newPost->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Danh Mục</h3>
                        <ul style="list-style: none; padding: 0;">
                            @foreach ($categories as $cat)
                                <li style="padding: 10px 0; border-bottom: 1px solid #f8f9fa;">
                                    <a href="{{ route('news', ['category' => $cat->slug]) }}"
                                        style="color: var(--text-dark); text-decoration: none; display: flex; justify-content: space-between;">
                                        <span>{{ $cat->name }}</span>
                                        <span style="color: var(--text-light);">({{ $cat->posts->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Newsletter Widget -->
                    <div class="sidebar-widget" style="background: var(--gradient-primary); color: #fff;">
                        <h3 class="widget-title" style="color: #fff; border-bottom-color: rgba(255,255,255,0.2);">
                            Đăng Ký Nhận Tin</h3>
                        <p style="margin-bottom: 20px; font-size: 14px;">
                            Nhận thông tin mới nhất về dự án và ưu đãi độc quyền</p>
                        <form onsubmit="registerNewsletter(this, event);">
                            <input type="email" placeholder="Email của bạn" required
                                style="width: 100%; padding: 12px; border: none; border-radius: 5px; margin-bottom: 15px;">
                            <button type="submit" class="btn btn-secondary" style="width: 100%;">Đăng Ký Ngay</button>
                        </form>
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Tags Phổ Biến</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach ($tags as $tag)
                                <a href="{{ route('news', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <!-- Newsletter Section -->
    <section style="padding: 60px 0; background: linear-gradient(135deg, #05668d 0%, #00a896 100%); color: #fff;">
        <div class="container">
            <div style="text-align: center; max-width: 600px; margin: 0 auto;">
                <h2 style="font-size: 2rem; margin-bottom: 15px;">Đừng Bỏ Lỡ Tin Tức Quan Trọng</h2>
                <p style="margin-bottom: 30px; color: rgba(255,255,255,0.9);">Đăng ký để nhận thông tin mới nhất về dự án
                    và cơ hội đầu tư</p>
                <form style="display: flex; gap: 15px; max-width: 400px; margin: 0 auto;"
                    onsubmit="registerNewsletter(this, event);">
                    <input type="email" placeholder="Nhập email của bạn" required
                        style="flex: 1; padding: 15px; border: none; border-radius: 50px;">
                    <button type="submit" class="btn btn-secondary">Đăng Ký</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Category Filter
        document.querySelectorAll('.cat-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                document.querySelectorAll('.cat-tag').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
@endsection
