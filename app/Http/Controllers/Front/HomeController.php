<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Kol;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Kol::where('status', 'active')->where('is_verified', 1)->latest()->take(10)->with('categories');

        // Nếu có danh mục được chọn
        if ($request->filled('category') && $request->category !== '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $kols = $query->where('is_featured', 1)->paginate(8);

        if ($request->ajax()) {
            return view('front.partials.kol_table_body', compact('kols'))->render();
        }

        $categories = Category::where('type', 'kols')->get();
        // Nếu load trang bình thường
        return view('front.home', compact('kols', 'categories'));
    }

    public function about(Request $req)
    {
        return view('front.about', compact([]));
    }

    public function pricing(Request $req)
    {
        return view('front.pricing');
    }

    public function help(Request $req)
    {
        return view('front.help');
    }

    public function resources(Request $request)
    {
        $posts = Post::where('status', 1)
        ->orderByDesc('id')
        ->take(6)
        ->get();

        $categorySlug = $request->get('category', 'all');

        if ($categorySlug === 'all') {
            $posts = Post::latest()->get();
        } else {
            $category = Category::where('slug', $categorySlug)->first();

            if ($category) {
                $posts = $category->posts()->latest()->get();
            } else {
                $posts = collect(); // rỗng
            }
        }

        return view('front.resources', compact('posts', 'categorySlug'));
    }

    public function show($slug)
    {
        $post = Post::with('categories', 'media')->where('slug', $slug)->firstOrFail();

        // Bài viết liên quan (same category)
        $related = Post::whereHas('categories', function ($q) use ($post) {
            $q->whereIn('categories.id', $post->categories->pluck('id'));
        })
        ->where('id', '!=', $post->id)
        ->limit(3)
        ->get();

        return view('front.resources.show', compact('post', 'related'));
    }


    public function kols(Request $req)
    {
        $query = Kol::query();

        if ($req->filled('search')) {
            $search = trim($req->search);
            $query->where(function ($q) use ($search) {
                $q->where('display_name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
                //->orWhere('bio', 'like', "%{$search}%")
            });
        }

        if ($req->filled('category') && $req->category !== 'all') {
            $query->whereHas('categories', function ($q) use ($req) {
                $q->where('slug', $req->category);
                //->orWhere('name', 'like', "%{$req->category}%")
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

        $categories = Category::where('type', 'kols')->get();

        return view('front.kols', compact('kols', 'categories'));
    }

    public function privacy()
    {
        return view('front.privacy_policy');
    }

    public function terms()
    {
        return view('front.terms_of_service');
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

    public function setType(Request $request)
    {
        $request->validate([
            'type' => 'required|in:kols,brand',
        ]);

        $user = auth()->user();

        if($request->type === 'kols') {
            $kol = Kol::create([
                'username' => explode('@', $user->email)[0],
                'display_name' => $user->name,
            ]);
        }

        $user->type = $request->type;
        $user->kol_id = $request->type === 'kols' ? $kol->id : null;
        $user->save();

        return redirect()->route('home')->with('success', 'Cập nhật loại tài khoản thành công.');
    }
}
