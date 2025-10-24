@extends('layouts.front')

@section('meta')
    <title>{{ $post->title }} - OneUp KOL Analytics</title>
    <meta name="description" content="{{ Str::limit(strip_tags($post->excerpt ?? $post->body), 160) }}">
@endsection

@section('css')
<style>
    .post-hero {
        background: linear-gradient(135deg, #FFF5F7 0%, #F0FFFE 100%);
        padding: 60px 0 60px;
        text-align: center;
    }

    .post-hero h1 {
        font-size: 42px;
        font-weight: 800;
        color: var(--dark-blue);
        line-height: 1.3;
    }

    .post-meta {
        color: var(--gray-light);
        font-size: 15px;
        margin-top: 1rem;
    }

    .post-body {
        max-width: 850px;
        margin: 60px auto;
        font-size: 17px;
        line-height: 1.8;
        color: var(--gray-700);
    }

    .post-body img {
        max-width: 100%;
        border-radius: 12px;
        margin: 2rem 0;
    }

    .post-body h2, .post-body h3 {
        color: var(--dark-blue);
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .related-section {
        background: #F8F9FA;
        padding: 80px 0;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .related-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: all 0.3s;
    }

    .related-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
    }

    .related-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .related-card .content {
        padding: 1.2rem;
    }

    .related-card h4 {
        font-size: 18px;
        font-weight: 700;
        color: var(--dark-blue);
        margin-bottom: .5rem;
    }

    .related-card p {
        color: var(--gray-600);
        font-size: 15px;
    }
</style>
@endsection

@section('page')

    <!-- Hero Section -->
    <section class="post-hero fade-in">
        <div class="container">
            <div class="badge badge-primary mb-3">{{ $post->categories->first()?->name ?? 'Bài viết' }}</div>
            <h1>{{ $post->title }}</h1>
            <div class="post-meta">
                <span style="color: black">🕒 {{ $post->created_at->format('d/m/Y') }}</span>
                <span style="color: black">👁 {{ number_format($post->view ?? 0) }} lượt xem</span>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="section">
        <div class="container">
            <div class="post-body fade-in">
                @if($post->getFirstMediaUrl('media'))
                    <img src="{{ $post->getFirstMediaUrl('media') }}" alt="{{ $post->title }}">
                @endif

                {!! $post->body !!}
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($related->count())
    <section class="related-section fade-in">
        <div class="container">
            <h2 class="text-center mb-5 color-dark-blue">Bài Viết Liên Quan</h2>
            <div class="related-grid">
                @foreach($related as $r)
                    <div class="related-card">
                        <a href="{{ route('resources.show', $r->slug) }}">
                            <img src="{{ $r->getFirstMediaUrl('media') }}" alt="{{ $r->title }}">
                        </a>
                        <div class="content">
                            <h4>{{ $r->title }}</h4>
                            <p>{{ Str::limit($r->excerpt, 100) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
