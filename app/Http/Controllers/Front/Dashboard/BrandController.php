<?php

namespace App\Http\Controllers\Front\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Country;
use App\Models\Kol;
use App\Models\KolService;
use App\Models\KolBooking;
use App\Models\KolContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function dashboard()
    {
        $kols = Kol::where('is_verified', 1)->where('status', 'active')->limit(10)->get();
        $activeCampaigns = auth()->user()->campaigns()->where('status', 'active')->get();

        return view('brand.dashboard', compact('kols', 'activeCampaigns'));
    }

    public function kolExplorer()
    {
        $kols = Kol::where('is_verified', 1)
            ->where('status', 'active')
            ->when(request('categories'), function ($q) {
                $q->whereHas('categories', function ($sub) {
                    $sub->whereIn('id', request('categories'));
                });
            })
            ->when(request('followers'), function ($q) {
                $q->where('followers', '>=', request('followers'));
            })
            ->when(request('engagement'), function ($q) {
                $q->where('engagement', '>=', request('engagement'));
            })
            ->when(request('trust_score'), function ($q) {
                $q->where('trust_score', '>=', request('trust_score'));
            })
            ->when(request('location_city'), function ($q) {
                $q->whereIn('location_city', request('location_city'));
            })
            ->when(request('content_type'), function ($q) {
                $q->where('content_type', request('content_type'));
            })
            ->when(request('sortBy'), function ($q) {
                $q->orderBy(request('sortBy'));
            })
            ->paginate(12);

        $categories = Category::where('type', 'kols')->get();
        $cities = Kol::distinct('location')->whereNotNull('location_city')->orderBy('location_city')->pluck('location_city');
        $contentTypes = Kol::distinct('content_type')->whereNotNull('content_type')->pluck('content_type');

        return view('brand.kol_explorer', compact('kols', 'categories', 'cities', 'contentTypes'));
    }

    public function campaign()
    {
        // Lấy tất cả chiến dịch
        $campaigns = auth()->user()->campaigns;

        // Tổng số chiến dịch
        $totalCampaigns = $campaigns->count();

        // Chiến dịch đang hoạt động
        $activeCampaigns = $campaigns->where('status', 'active');
        $activeCount = $activeCampaigns->count();

        // Tổng ngân sách
        $totalBudget = $campaigns->sum('budget_amount');

        // Đã chi (giả sử có trường spent_amount, nếu chưa có thì dùng budget_amount)
        $spentBudget = $campaigns->sum('spent_amount') ?? $campaigns->sum('budget_amount');

        // Tổng số KOL đã tham gia
        $totalKols = $campaigns->pluck('kols')->flatten()->unique('id')->count();

        // ROI trung bình (giả sử có trường roi, nếu chưa có thì hardcode)
        $avgRoi = $campaigns->avg('roi');

        // Các tab: nháp, hoàn thành, tạm dừng
        $draftCount = $campaigns->where('status', 'draft')->count();
        $completedCount = $campaigns->where('status', 'completed')->count();
        $pausedCount = $campaigns->where('status', 'paused')->count();

        return view('brand.campaign', [
            'campaigns' => $campaigns,
            'totalCampaigns' => $totalCampaigns,
            'activeCount' => $activeCount,
            'totalBudget' => $totalBudget,
            'spentBudget' => $spentBudget,
            'totalKols' => $totalKols,
            'avgRoi' => $avgRoi,
            'draftCount' => $draftCount,
            'completedCount' => $completedCount,
            'pausedCount' => $pausedCount,
        ]);
    }

    public function campaignPlanner($slug = null)
    {
        $campaignCategories = Category::where('type', 'campaigns')->tree()->get()->toTree();
        $kolCategories = Category::where('type', 'kols')->tree()->get()->toTree();
        $kols = Kol::where('is_verified', 1)->where('status', 'active')->limit(50)->get();

        $campaign = Campaign::where('slug', $slug)->firstOrNew();


        return view('brand.campaign_planner', compact('campaignCategories', 'kolCategories', 'kols', 'campaign'));
    }

    public function ajaxFilter(Request $req)
    {
        $query = \App\Models\Kol::query()
            ->where('is_verified', 1)
            ->where('status', 'active');

        if ($req->filled('filter')) {
            [$type, $value] = explode(':', $req->filter);

            switch ($type) {
                case 'category':
                    $query->whereHas('categories', fn($q) => $q->where('categories.id', $value));
                    break;

                case 'price':
                    match ($value) {
                        'low' => $query->where('price_campaign', '<', 1000000),
                        'medium' => $query->whereBetween('price_campaign', [1000000, 5000000]),
                        'high' => $query->where('price_campaign', '>', 5000000),
                    };
                    break;

                case 'eng':
                    match ($value) {
                        'low' => $query->where('engagement', '<', 1),
                        'medium' => $query->whereBetween('engagement', [1, 5]),
                        'high' => $query->where('engagement', '>', 5),
                    };
                    break;
            }
        }

        $kols = $query->limit(50)->get(['id', 'display_name', 'followers', 'engagement', 'price_campaign']);

        $html = view('brand.partials.kol_grid', compact('kols'))->render();

        return response()->json(['html' => $html]);
    }


    public function campaignDetail($slug)
    {
        // Try find by id or slug
        $campaign = Campaign::with('kols')->where('slug', $slug)->firstOrFail();

        $today = now();
        $start = $campaign->start_date;
        $end = $campaign->end_date;

        // Duration and remaining days
        $durationDays = ($start && $end) ? $start->diffInDays($end) : null;
        $remainingDays = 0;
        if ($end) {
            $remainingDays = $today->lessThanOrEqualTo($end) ? $today->diffInDays($end) : 0;
        }

        // Progress: percent of time elapsed between start and end (fallback to stored field)
        if ($start && $end) {
            $elapsed = $start->lessThanOrEqualTo($today) ? $start->diffInDays(min($today, $end)) : 0;
            $progress = $durationDays ? round(($elapsed / max(1, $durationDays)) * 100) : 0;
        } else {
            $progress = $campaign->progress ?? 0;
        }

        // Financials and basic metrics (use fields if present)
        $totalBudget = $campaign->budget_amount ?? 0;
        $spentBudget = $campaign->spent_amount ?? 0;
        $contentPosted = $campaign->content_posted ?? $campaign->content_count ?? 0;
        $totalViews = $campaign->target_reach ?? 0;
        $currentRoi = $campaign->roi ?? null;

        // Per-KOL stats (safe fallbacks). Expect pivot fields may exist like content_posted, views, engagement, conversions
        $kolStats = $campaign->kols->map(function ($kol) {
            $content_posted = data_get($kol, 'pivot.content_posted') ?? data_get($kol, 'content_posted') ?? 0;
            $views = data_get($kol, 'pivot.views') ?? data_get($kol, 'views') ?? 0;
            $engagement = data_get($kol, 'pivot.engagement') ?? data_get($kol, 'engagement') ?? null;
            $conversions = data_get($kol, 'pivot.conversions') ?? data_get($kol, 'conversions') ?? 0;

            // performance label based on engagement
            $performance = 'Trung bình';
            if ($engagement !== null) {
                if ($engagement >= 8) {
                    $performance = 'Xuất sắc';
                } elseif ($engagement >= 5) {
                    $performance = 'Tốt';
                }
            }

            return (object) [
                'id' => $kol->id,
                'name' => $kol->display_name,
                'handle' => $kol->handle ?? $kol->username ?? null,
                'content_posted' => $content_posted,
                'views' => $views,
                'engagement' => $engagement,
                'conversions' => $conversions,
                'performance_label' => $performance,
            ];
        });

        return view('brand.campaign_detail', compact(
            'campaign',
            'durationDays',
            'remainingDays',
            'progress',
            'totalBudget',
            'spentBudget',
            'contentPosted',
            'totalViews',
            'currentRoi',
            'kolStats'
        ));
    }

    public function campaignTracker($slug)
    {
        $campaigns = Campaign::all();
        $campaign = Campaign::with('kols')->where('slug', $slug)->firstOrFail();

        return view('brand.campaign_tracker', compact('campaign', 'campaigns'));
    }

    public function campaignStore(Request $request)
    {
        // Validate input (add more rules as needed)
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'integer',
            'target_reach' => 'nullable|integer',
            'target_engagement' => 'nullable|integer',
            'budget_amount' => 'nullable|numeric',
            'kols' => 'nullable|array',
            'status' => 'required|string',
        ]);

        // Create campaign

        $campaign = Campaign::where('id', $request->campaign_id)->firstOrNew();
        $campaign->name = $request->name;
        $campaign->slug = Str::slug($request->name);
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->category_id = $request->campaign_category;
        $campaign->description = $request->description;
        $campaign->target_reach = $request->target_reach;
        $campaign->target_engagement = $request->target_engagement;
        $campaign->budget_amount = $request->budget_amount;
        $campaign->content_type = $request->content_type;
        $campaign->content = $request->content;

        $campaign->roi = $campaign->budget_amount > 0 ?
            (($campaign->target_reach * ($campaign->target_engagement / 100)) /
                ($campaign->budget_amount / 1000000)) : 0;

        $campaign->status = $request->status;
        $campaign->created_by = auth()->id();
        $campaign->save();

        // Attach KOLs if provided (assuming many-to-many)
        if (!empty($request->kols)) {
            $campaign->kols()->sync($request->kols);
        }


        $campaign->syncTagsWithType(request('tags'), 'campaign');

        return redirect()->route('brand.campaign.index')->with('success', 'Chiến dịch đã được tạo thành công!');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|integer|exists:campaigns,id',
            'status' => 'required|string|in:draft,active,paused,completed,cancelled',
        ]);

        $campaign = Campaign::find($request->campaign_id);

        if (! $campaign) {
            return back()->with('error', 'Chiến dịch không tồn tại!');
        }

        // Optionally check permission (uncomment if you want)
        if (auth()->id() !== $campaign->created_by) {
            return back()->with(['error', 'Không có quyền thay đổi trạng thái.'], 403);
        }

        $oldStatus = $campaign->status;
        $campaign->status = $request->status;
        $campaign->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }

    public function analytic()
    {
        return view('brand.analytic');
    }

    public function report()
    {
        return view('brand.report');
    }

    public function setting()
    {
        $user = auth()->user();
        $notifications = settings()->get('notifications', []);

        return view('brand.setting', compact('user', 'notifications'));
    }

    public function saveSettings(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->job_title = $request->job_title;
        $user->company = $request->company;

        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');

            // remove old avatar if exists
            if (!empty($user->avatar)) {
                $oldPath = preg_replace('#^/storage/#', '', $user->avatar);
                Storage::disk('public')->delete($oldPath);
            }

            // store in storage/app/public/avatars
            $storedPath = $avatarFile->store('avatars', 'public');

            // public access via /storage symlink
            $user->avatar = '/storage/' . $storedPath;
        }
        $user->save();

        settings()->put('notifications', $request->input('notifications', []));

        return redirect()->back()->with('success', 'Cài đặt đã được lưu');
    }

    public function billing()
    {
        return view('brand.billing');
    }

    public function profile($username)
    {
        $kol = Kol::where('username', $username)
            ->with(['contents' => function ($query) {
                $query->where('content_type', 'video')
                    ->latest('posted_at')
                    ->take(12);
            }])
            ->firstOrFail();

        $kolId = $kol->id;

        $services = KolService::where('kol_id', $kolId)->get();

        $campaigns = DB::table('campaign_kols')
        ->join('campaigns', 'campaigns.id', '=', 'campaign_kols.campaign_id')
        ->select(
            'campaign_kols.*',
            'campaigns.name as campaign_name'
        )
        ->where('campaign_kols.kol_id', $kolId)
        ->orderByDesc('campaign_kols.added_at')
        ->paginate(10);

        $bookedServiceIds = [];
        if (auth()->check()) {
            $bookedServiceIds = KolBooking::where('user_id', auth()->id())
                ->pluck('service_id')
                ->toArray();
        }

        $totalPosts = KolContent::where('kol_id', $kolId)->count();
        $totalViews = 0;
        $avgLikesText = 0;
        $avgCommentsText = 0;
        $avgSharesText = 0;
        $avgViewsText = 0;

        if ($totalPosts > 0) {
            $totalLikes = KolContent::where('kol_id', $kolId)->sum('likes_count');
            $totalComments = KolContent::where('kol_id', $kolId)->sum('comments_count');
            $totalShares = KolContent::where('kol_id', $kolId)->sum('shares_count');
            $totalViews = KolContent::where('kol_id', $kolId)->sum('views_count');

            // Trung bình
            $avgLikesText = round($totalLikes / $totalPosts / 1000, 1) . 'K';
            $avgCommentsText = round($totalComments / $totalPosts / 1000, 1) . 'K';
            $avgSharesText = round($totalShares / $totalPosts / 1000, 1) . 'K';
            $avgViewsText = round($totalViews / $totalPosts / 1000, 1) . 'K';
        } else {
            $avgLikesText = $avgCommentsText = $avgSharesText = $avgViewsText = '0K';
        }

        // --- Số bài / tuần ---
        $firstPost = KolContent::where('kol_id', $kolId)->orderBy('posted_at', 'asc')->first();
        $weeks = 1;
        if ($firstPost && $totalPosts > 0) {
            $weeks = max(1, Carbon::parse($firstPost->posted_at)->diffInWeeks(now()));
        }
        $postsPerWeek = round($totalPosts / $weeks, 1);

        // --- Tỷ lệ hoàn thành trung bình ---
        $completionRate = KolContent::where('kol_id', $kolId)->avg('completion_rate') ?? 0;

        // --- Tỷ lệ phản hồi ---
        $totalComments = KolContent::where('kol_id', $kolId)->sum('comments_count');
        $totalShares = KolContent::where('kol_id', $kolId)->sum('shares_count');
        $responseRate = ($totalComments > 0) ? round(($totalShares / $totalComments) * 100, 1) : 0;

        // --- Tỷ lệ tương tác TB ---
        $avgEngagementRate = KolContent::where('kol_id', $kolId)->avg('engagement_rate') ?? 0;

        // --- Điểm an toàn thương hiệu ---
        $totalSponsored = KolContent::where('kol_id', $kolId)->where('is_sponsored', true)->count();
        $brandSafetyScore = 100 - min(100, round(($totalSponsored / max(1, $totalPosts)) * 100));

        // --- Tính các yếu tố điểm uy tín ---
        $followers = max($kol->followers, 1);
        $engagementQuality = ($totalViews > 0)
            ? round((($totalLikes + $totalComments + $totalShares) / $totalViews) * 100, 1)
            : 0;

        $growthStability = rand(75, 95); // giả lập ổn định tăng trưởng
        $contentQuality = ($totalPosts > 0)
            ? round(KolContent::where('kol_id', $kolId)->where('views_count', '>', 10000)->count() / $totalPosts * 100, 1)
            : 0;
        $realFollowersScore = rand(80, 95);
        $authenticComments = rand(80, 90);

        $trustScore = round(
            ($realFollowersScore * 0.25) +
                ($engagementQuality * 0.25) +
                ($authenticComments * 0.20) +
                ($growthStability * 0.15) +
                ($contentQuality * 0.15)
        );

        // --- Lấy video hiển thị ---
        $videos = $kol->contents;

        return view('brand.kol_profile', compact(
            'kol',
            'videos',
            'totalPosts',
            'totalViews',
            'avgLikesText',
            'avgCommentsText',
            'avgSharesText',
            'avgViewsText',
            'postsPerWeek',
            'completionRate',
            'responseRate',
            'avgEngagementRate',
            'brandSafetyScore',
            'trustScore',
            'realFollowersScore',
            'engagementQuality',
            'authenticComments',
            'growthStability',
            'contentQuality',
            'services',
            'campaigns',
            'bookedServiceIds'
        ));
    }

    public function leaderboard()
    {
        $categoryId = request()->query('category');

        $query = Kol::where('is_verified', 1)
            ->where('status', 'active');

        // If a specific category is selected (id or 'all'), filter kols
        if ($categoryId && $categoryId !== 'all') {
            $query = $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        $topKols = $query->orderByDesc('followers')
            ->limit(10)
            ->get();

        $topCategory = Category::where('type', 'kols')
            ->withCount(['kols' => function ($q) {
                $q->where('is_verified', 1)->where('status', 'active');
            }])
            ->orderByDesc('kols_count')
            ->first();

        $totalKols = $query->count();
        $avgEngagement = $query->avg('engagement');
        $totalTargetReach = $query->sum('followers');

        $categories = Category::where('type', 'kols')->get();

        // If AJAX request, return rendered partials as JSON so frontend can replace sections
        if (request()->ajax()) {
            $podiumHtml = view('brand.partials.leaderboard_podium', compact('topKols'))->render();
            $tableHtml = view('brand.partials.leaderboard_table', compact('topKols'))->render();
            $statsHtml = view('brand.partials.leaderboard_stats', compact('totalKols', 'avgEngagement', 'topCategory', 'totalTargetReach'))->render();

            return response()->json([
                'podium' => $podiumHtml,
                'table' => $tableHtml,
                'stats' => $statsHtml,
            ]);
        }

        return view('brand.leaderboard', compact('topKols', 'categories', 'totalKols', 'topCategory', 'avgEngagement', 'totalTargetReach'));
    }

    public function bookService(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:kol_services,id',
            'note' => 'nullable|string|max:500',
        ]);

        $service = KolService::findOrFail($request->service_id);

        KolBooking::create([
            'user_id' => auth()->id(),
            'kol_id' => $service->kol_id,
            'service_id' => $service->id,
            'note' => $request->note,
            'status' => 'pending',
        ]); 

        return response()->json(['success' => true, 'message' => 'Đặt dịch vụ thành công!']);
    }

}
