@extends('layouts.front')

@section('meta')
        @if(request()->routeIs('postCategory'))
            <title>{{ $category->name }}</title>
            <link rel="canonical" href="{{ request()->url() }}">
            <meta name="title" content="{{ $category->name }}">
            <meta name="description" content="Xa quê công giáo">
            <meta name="keywords" content="Xa quê công giáo">
            <meta property="og:url" content="{{ config('app.url') }}">
            <meta property="og:title" content="Xa quê công giáo">
            <meta property="og:description" content="Xa quê công giáo">
            <meta property="og:type" content="website">
            <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
            <meta property="og:site_name" content="Xa quê công giáo">
        @elseif(request()->routeIs('postTag'))
            <title>Thẻ - {{ $tag->name }}</title>
            <link rel="canonical" href="{{ request()->url() }}">
            <meta name="title" content="Thẻ - {{ $tag->name }}">
            <meta name="description" content="Xa quê công giáo">
            <meta name="keywords" content="Xa quê công giáo">
            <meta property="og:url" content="{{ config('app.url') }}">
            <meta property="og:title" content="Xa quê công giáo">
            <meta property="og:description" content="Xa quê công giáo">
            <meta property="og:type" content="website">
            <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
            <meta property="og:site_name" content="Xa quê công giáo">
        @elseif(request()->routeIs('postArchive'))
            <title>Bài viết tháng {{ request('month') }} - {{ request('year') }}</title>
            <link rel="canonical" href="{{ request()->url() }}">
            <meta name="title" content="Xa quê công giáo">
            <meta name="description" content="Xa quê công giáo">
            <meta name="keywords" content="Xa quê công giáo">
            <meta property="og:url" content="{{ config('app.url') }}">
            <meta property="og:title" content="Xa quê công giáo">
            <meta property="og:description" content="Xa quê công giáo">
            <meta property="og:type" content="website">
            <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
            <meta property="og:site_name" content="Xa quê công giáo">
        @else
            <title>Bài viết</title>
            <link rel="canonical" href="{{ request()->url() }}">
            <meta name="title" content="Xa quê công giáo">
            <meta name="description" content="Xa quê công giáo">
            <meta name="keywords" content="Xa quê công giáo">
            <meta property="og:url" content="{{ config('app.url') }}">
            <meta property="og:title" content="Xa quê công giáo">
            <meta property="og:description" content="Xa quê công giáo">
            <meta property="og:type" content="website">
            <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
            <meta property="og:site_name" content="Xa quê công giáo">
        @endif
@stop

@push('css')
<style>
    .post-list-layout3 .item-img {
        border-radius: 5px;
    }
    .widget-upcoming-post .post-list-layout2 .media .item-img {
        border-radius: 5px;
    }
</style>
@endpush
@section('page')
    <section class="inner-page-banner bg-common" data-bg-image="/front/media/BANNER3-01.jpg" style="background-image: url(/front/media/BANNER3-01.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs-area">
                        <h1>Bài viết</h1>
                        <ul>
                            <li>
                                <a href="/">Trang chủ</a>
                            </li>
                            <li>Bài viết</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section">
        <div class="container">
            <div class="row gutters-40">
                <div class="col-xl-9 col-lg-8">
                    @if($posts->isNotEmpty())
                        @foreach($posts as $post)
                        <div class="post-list-layout3 align-items-center">
                            <div class="item-img">
                                <img class="lazyload" data-src="{{ $post->getFirstMediaUrl('media', 'show-bf') }}" alt="{{ $post->title }}">
                            </div>
                            <div class="item-content">
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="flaticon-clock"></i> {{ $post->created_at->translatedFormat('d-m-Y') }}</li>
                                        <li class="item-author"><i class="flaticon-user bg-green"></i><span>Đăng bởi</span><a href="#">DragonNews</a></li>
                                    </ul>
                                </div>
                                <h3 class="item-title"><a href="{{ $post->showUrl() }}"> {{ $post->title }}</a></h3>
                                <p>{{ $post->excerpt }}</p>
                                <a href="{{ $post->showUrl() }}" class="btn-fill-md">Đọc thêm</a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <h4>Chưa có bài viết nào</h4>
                    @endif

                    {{ $posts->appends(['search' => request('search')])->links() }}

                </div>
                @include('front.posts._rightSidebar')
            </div>
        </div>
    </section>
@stop