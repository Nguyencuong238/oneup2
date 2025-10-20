<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Partner;
use App\Models\Kol;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Kol::query()->latest()->with('categories');

        // Nếu có danh mục được chọn
        if ($request->filled('category') && $request->category !== '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $kols = $query->paginate(10);

        if ($request->ajax()) {
            return view('front.partials.kol_table_body', compact('kols'))->render();
        }

        // Nếu load trang bình thường
        return view('front.home', compact('kols'));
    }

    public function about(Request $req)
    {
        return view('front.about', compact([]));
    }

    public function news(Request $req)
    {
        $posts = Post::where('status', 1)
            ->when(request()->search, function ($q) {
                $q->where('title', 'like', '%' . request()->search . '%');
            })
            ->when(request()->tag, function ($q) {
                $q->whereHas('tags', function ($q) {
                    $q->where('slug', request()->tag);
                });
            })
            ->when(request()->category, function ($q) {
                $q->whereHas('categories', function ($q) {
                    $q->where('slug', request()->category);
                });
            })
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->paginate(6);

        $newPosts = Post::where('status', 1)
            ->when(request()->search, function ($q) {
                $q->where('title', 'like', '%' . request()->search . '%');
            })
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $categories = Category::where('type', 'post')->has('posts')->get();
        $tags = Tag::where('type', 'post')->get();

        return view('front.news', compact('posts', 'categories', 'newPosts', 'tags'));
    }

    public function newsDetail(Request $req, Post $post)
    {
        $post->increment('view', 1);
        $category = $post->categories()->first();

        $relatedPosts = Post::when($category, function ($q) use ($category) {
            $q->whereHas('categories', function ($q) use ($category) {
                $q->where('id', $category->id);
            });
        })
            ->where('status', 1)
            ->orderByDesc('id')->limit(3)->get();

        $otherPosts = Post::query()->where('status', 1)->where('id', '<>', $post->id)->inRandomOrder()->limit(3)->get();
        $categories = Category::where('type', 'post')->get();

        return view('front.news_detail', compact('relatedPosts', 'otherPosts', 'post'));
    }

    public function pricing(Request $req)
    {
        return view('front.pricing');
    }

    public function help(Request $req)
    {
        return view('front.help');
    }

    public function resources(Request $req)
    {

        return view('front.resources');
    }

    public function kols(Request $req)
    {
        $query = Kol::query();

        if ($req->filled('search')) {
            $search = trim($req->search);
            $query->where(function ($q) use ($search) {
                $q->where('display_name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        if ($req->filled('category') && $req->category !== 'all') {
            $query->whereHas('categories', function ($q) use ($req) {
                $q->where('slug', $req->category)
                ->orWhere('name', 'like', "%{$req->category}%");
            });
        }

        // 👥 Người theo dõi (followers)
        if ($req->filled('followers') && $req->followers !== 'all') {
            switch ($req->followers) {
                case 'nano':  $query->whereBetween('followers', [1000, 10000]); break;
                case 'micro': $query->whereBetween('followers', [10000, 100000]); break;
                case 'mid':   $query->whereBetween('followers', [100000, 500000]); break;
                case 'macro': $query->whereBetween('followers', [500000, 1000000]); break;
                case 'mega':  $query->where('followers', '>=', 1000000); break;
            }
        }

        // 💬 Tỷ lệ tương tác (engagement)
        if ($req->filled('engagement') && $req->engagement !== 'any') {
            $rate = (float) $req->engagement;
            $query->where('engagement', '>=', $rate);
        }

        // 📍 Khu vực
        if ($req->filled('location_city') && $req->location_city !== 'all') {
            if ($req->location_city === 'Khác') {
                // hiển thị các bản ghi KHÔNG thuộc 3 thành phố chính
                $query->whereNotIn('location_city', ['Hà Nội', 'TP.HCM', 'Đà Nẵng']);
            } else {
                // lọc đúng thành phố đã chọn
                $query->where('location_city', $req->location_city);
            }
        }

        // 🌐 Ngôn ngữ (language)
        if ($req->filled('language') && $req->language !== 'all') {
            $query->where(function($q) use ($req) {
                $q->where('language', $req->language)
                ->orWhere('language', 'LIKE', "%{$req->language}%");
            });
        }

        // ✅ Trạng thái xác minh (is_verified)
        if ($req->filled('is_verified') && $req->is_verified !== 'all') {
            if ($req->is_verified === 'verified') {
                $query->where('is_verified', 1);
            } elseif ($req->is_verified === 'rising') {
                $query->where('trust_score', '>=', 80); // giả định: rising = trust cao
            }
        }

        // 🔽 Mặc định: sắp xếp mới nhất
        $query->orderByDesc('id');

        $kols = $query->paginate(12)->withQueryString();

        return view('front.kols', compact('kols'));
    }

    public function login(Request $req)
    {
        return view('front.auth.login');
    }

    public function register(Request $req)
    {
        return view('front.auth.register');
    }

    public function forgotPassword(Request $req)
    {
        return view('front.auth.forgot_password');
    }
}
