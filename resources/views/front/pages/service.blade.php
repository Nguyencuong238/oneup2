@extends('layouts.front')

@section('meta')
        <title>Dịch vụ</title>
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
@stop

@push('css')
<style>
    header.vs-header.header-layout5 {
        padding-bottom: 0;
        background-color: ;
    }
    .header-layout5 .menu-area, .sticky-wrapper, button.icon-btn.style4 {
        background-color: var(--title-color);
    }
    .will-sticky .sticky-active.active, .will-sticky .menu-area, .will-sticky .icon-btn.style4 {
        background-color: #000;
    }
    .icon-btn.style4 {
        font-size: 28px;
    }
    .menu-style3 > ul > li > a {
        padding: 50px 0;
        color: #fff;
    }
    .vs-blog.blog-card .blog-img img {
        height: 345px;
    }
</style>
@endpush
@section('page')
    <div class="breadcumb-wrapper">
        <div class="parallax" data-bg-class="bg-title" data-parallax-image="assets/img/breadcumb/breadcrumb-bg.jpg"></div>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="/">Trang chủ</a></li>
                        <li class="active">Dịch vụ</li>
                    </ul>
                </div>
                <h1 class="breadcumb-title">Dịch vụ</h1>
            </div>
        </div>
    </div>
    <section class="vs-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="title-area text-center text-xl-start">
                <span class="sub-title text-title">#Latest News</span>
                <h2 class="sec-title">Stay Updated With</h2>
                <h2 class="sec-title-style2 text-title">Our Blogs</h2>
                <div class="sec-shape">
                    <div class="sec-shape_bar"></div>
                    <div class="sec-shape_bar"></div>
                    <div class="sec-shape_bar"></div>
                </div>
            </div>
            <div class="row vs-carousel" data-slide-show="3" data-lg-slide-show="2" data-arrows="true">
                <div class="col-xl-4">
                    <div class="vs-blog blog-card">
                        <div class="blog-img"><img src="assets/img/blog/blog-img-1-1.png" alt="Blog Image" class="w-100" /></div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="blog.html"><i class="fal fa-user"></i>By Admin</a> <a href="blog.html"><i class="fal fa-calendar-alt"></i>Dec 12, 2022</a>
                            </div>
                            <h3 class="blog-title"><a href="blog-details.html">Call of duty Balck Ops</a></h3>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="vs-blog blog-card">
                        <div class="blog-img"><img src="assets/img/blog/blog-img-1-2.png" alt="Blog Image" class="w-100" /></div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="blog.html"><i class="fal fa-user"></i>By John</a> <a href="blog.html"><i class="fal fa-calendar-alt"></i>Feb 30, 2022</a>
                            </div>
                            <h3 class="blog-title"><a href="blog-details.html">Until recently prevail</a></h3>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="vs-blog blog-card">
                        <div class="blog-img"><img src="assets/img/blog/blog-img-1-3.png" alt="Blog Image" class="w-100" /></div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="blog.html"><i class="fal fa-user"></i>By Redwan</a> <a href="blog.html"><i class="fal fa-calendar-alt"></i>Mar 31, 2022</a>
                            </div>
                            <h3 class="blog-title"><a href="blog-details.html">The placeholder beginn with</a></h3>
                            <a href="blog-details.html" class="link-btn">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop