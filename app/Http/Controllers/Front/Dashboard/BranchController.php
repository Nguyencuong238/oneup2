<?php

namespace App\Http\Controllers\Front\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Kol;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    public function dashboard()
    {
        $kols = Kol::where('is_verified', 1)->where('status', 'active')->limit(10)->get();
        return view('branch.dashboard', compact('kols'));
    }

    public function kolExplorer()
    {
        $kols = Kol::where('is_verified', 1)->where('status', 'active')
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
            ->when(request('sortBy'), function ($q) {
                $q->orderBy(request('sortBy'));
            })
            ->paginate(12);

        $categories = Category::where('type', 'kols')->get();

        return view('branch.kol_explorer', compact('kols', 'categories'));
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

        return view('branch.campaign', [
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
        $kols = Kol::where('is_verified', 1)->where('status', 'active')->get();

        $campaign = Campaign::where('slug', $slug)->firstOrNew();


        return view('branch.campaign_planner', compact('campaignCategories', 'kolCategories', 'kols', 'campaign'));
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

        return view('branch.campaign_detail', compact(
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

        return view('branch.campaign_tracker', compact('campaign', 'campaigns'));
    }

    public function campaignStore(Request $request)
    {
        // Validate input (add more rules as needed)
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'integer',
            'description' => 'nullable|string',
            'target_reach' => 'nullable|integer',
            'target_engagement' => 'nullable|integer',
            'budget_amount' => 'nullable|numeric',
            'kols' => 'nullable|array',
            'content_type' => 'nullable|string',
            'hashtag' => 'nullable|string',
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
        $campaign->hashtag = $request->hashtag;

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

        return redirect()->route('branch.campaign.index')->with('success', 'Chiến dịch đã được tạo thành công!');
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
        return view('branch.analytic');
    }

    public function report()
    {
        return view('branch.report');
    }

    public function setting()
    {
        return view('branch.setting');
    }

    public function billing()
    {
        return view('branch.billing');
    }

    public function profile($username)
    {
        $kol = Kol::where('username', $username)->firstOrFail();

        return view('branch.kol_profile', compact('kol'));
    }

    public function leaderboard()
    {
        return view('branch.leaderboard');
    }
}
