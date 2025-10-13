@extends('layouts.front')

@section('meta')
        <title>{{ $post->title }}</title>
        <link rel="canonical" href="{{ $post->showUrl() }}">
        <meta name="title" content="{{ $post->meta['meta_title'] ?? $post->title }}">
        <meta name="description" content="{{ $post->meta['meta_description'] ?? $post->excerpt }}">
        <meta name="keywords" content="Xa quê công giáo">
        <meta property="og:url" content="{{ $post->showUrl() }}">
        <meta property="og:title" content="{{ $post->meta['meta_title'] ?? $post->title }}">
        <meta property="og:description" content="{{ $post->meta['meta_title'] ?? $post->excerpt }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ $post->getFirstMediaUrl('media') }}">
        <meta property="og:site_name" content="Xa quê công giáo">
@stop
@push('css')
    <style>
        blockquote {
            margin: 0;
        }

        blockquote p {
            padding: 16px;
            font-size: 20px;
            background: #eee;
            border-radius: 5px;
            line-height: 36px;
        }

        blockquote p::before {
            /* content: '\201C'; */
        }

        blockquote p::after {
            /* content: '\201D'; */
        }

        .card-blog-content img {
            max-width: 100%;
            border-radius: 5px;
            height: auto !important;
            margin: 10px auto;
            display: block;
        }

        figure.image {
            max-width: 420px;
            margin: 10px auto;
        }

        figure.align-left {
            float: left;
        }

        figure.align-right {
            float: right;
        }


        figure.image figcaption {
            margin: 6px 8px 6px 8px;
            text-align: center;
            font-style: italic;
        }

        .post-body p {
            font-size: 16px;
            display: block !important;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }

        .post-body pre, .post-body blockquote, .post-body form, .post-body figure, .post-body p, .post-body dl, .post-body ul, .post-body ol {
            margin-bottom: 1.3em;
        }

        .post-body h1, .post-body h2, .post-body h3, .post-body h4, .post-body h5, .post-body h6{
            color: #333;
            width: 100%;
            margin-top: 0;
            margin-bottom: .5em;
            text-rendering: optimizeSpeed;
        }

        .inner-section {
            background-color: #fff;
        }

        body {
            color: #333;
        }
        .post-body ul {
            list-style: initial;
            margin: revert;
            padding: revert;
        }

        .post-body h1 {
            line-height: 40px;
        }

        .inner-section .container img {
            border-radius: 5px;
        }

        .single-post-layout1 .post-details .post-img {
            text-align: center;
        }

        .w-full {
            width: 100%;
        }
        .twitter-tweet {
            margin: 0 auto;
        }
        section.inner-section .container {
            max-width: 1160px;
        }
    </style>
@endpush
@section('page')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1098884300514971&autoLogAppEvents=1" nonce="tn024o0u"></script>

    <section class="inner-page-banner bg-common" data-bg-image="/front/media/BANNER3-01.jpg" style="background-image: url(/media/BANNER3-01.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs-area">
                        <h1>{{ $post->title }}</h1>
                        <ul>
                            <li>
                                <a href="/">Trang chủ</a>
                            </li>
                            <li>{{ $post->title }}</li>
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
                    <div class="single-post-layout1">
                        <div class="post-details">
                            <div class="post-date"><i class="flaticon-clock"></i> {{ $post->created_at->translatedFormat('d-m-Y') }}</div>
                            <h2 class="post-title">{{ $post->title }} </h2>
                            <div class="entry-meta">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="post-meta-dark">
                                            <ul>
                                                <li class="post-author">
                                                    <div class="author-icon bg-green">
                                                        <i class="flaticon-user"></i>
                                                    </div>
                                                    <div class="author-content">
                                                        <div class="item-text">Đăng bởi</div>
                                                        <div class="author-name"><a href="#">DragonNews</a></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="social-share">
                                            <label>Chia sẻ</label>
                                            <ul>
                                                <li><a href="https://www.facebook.com/sharer.php?u={{ $post->showUrl() }}" class="bg-fb"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="http://twitter.com/share?text={{ $post->title }}&url={{ $post->showUrl() }}" class="bg-twitter"><i class="fab fa-twitter"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-body">
                            {!! $post->body !!}
                            </div>
                            <ul class="related-tag mb-4">
                                @foreach($post->tags as $tag)
                                    <li><a href="{{ route('postTag', $tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                            <div class="w-full">
                                <div class="fb-comments w-full" data-href="{{ $post->showUrl() }}" data-width="100%" data-numposts="5"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('front.posts._rightSidebar')
            </div>
        </div>
    </section>

    <section class="post-wrap-layout1">
        <div class="container">
        <div class="heading-layout1">
                <h2 class="heading-title">Tin khác</h2>
                <div class="heading-icon">
                </div>
            </div>
            <div class="row gutters-20">
                @foreach($otherPost as $post)
                <div class="col-lg-3 col-md-6">
                    <div class="post-grid-layout3 post-grid17">
                        <div class="post-img">
                            <img class="lazyload" data-src="{{ $post->getFirstMediaUrl('media', 'show-bf') }}" alt="{{ $post->title }}">
                        </div>
                        <div class="post-content">
                            <div class="post-date"><i class="flaticon-clock"></i> {{ $post->created_at->translatedFormat('D, M, Y') }}</div>
                            <h3 class="post-title"><a href="{{ $post->showUrl() }}" title="{{ $post->title }}">{{ $post->title }}</a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
