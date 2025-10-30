<?php

namespace App\Http\Controllers\Front\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Kol;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreatorController extends Controller
{
    public function dashboard()
    {
        $kol = Kol::where('id', auth()->user()->kol_id)->first();
        $invitedCampaignCount = $kol->campaigns()
            ->whereIn('campaigns.status', ['active', 'paused', 'completed'])
            ->wherePivot('status', 'invited')
            ->count();

        $confirmedCampaignCount = $kol->campaigns()
            ->whereIn('campaigns.status', ['active', 'paused', 'completed'])
            ->wherePivot('status', 'confirmed')
            ->count();
            
        $completedCampaignCount = $kol->campaigns()
            ->whereIn('campaigns.status', ['active', 'paused', 'completed'])
            ->wherePivot('status', 'completed')
            ->count();

        return view('creator.dashboard', compact('kol', 'invitedCampaignCount', 'confirmedCampaignCount', 'completedCampaignCount'));
    }

    public function campaign()
    {
        $kol = Kol::where('id', auth()->user()->kol_id)->first();

        // Lấy tất cả chiến dịch
        $campaigns = Campaign::whereIn('status', ['active', 'paused', 'completed'])
            ->latest()
            ->paginate();

        // Chiến dịch đã tham gia
        $comfirmedCampaignIds = $kol->campaigns()
            ->whereIn('campaigns.status', ['active', 'paused', 'completed'])
            ->wherePivot('status', 'confirmed')
            ->withPivot('status')
            ->withPivot('status')
            ->get()
            ->pluck('pivot.status', 'pivot.campaign_id')
            ->toArray();

        // Chiến dịch đuợc mời tham gia
        $invitedCampaignIds = $kol->campaigns()
            ->whereIn('campaigns.status', ['active', 'paused', 'completed'])
            ->wherePivot('status', 'invited')
            ->withPivot('status')
            ->get()
            ->pluck('pivot.status', 'pivot.campaign_id')
            ->toArray();

        $myStatusCampaigns = $comfirmedCampaignIds + $invitedCampaignIds;

        return view('creator.campaign', compact(
            'campaigns',
            'comfirmedCampaignIds',
            'invitedCampaignIds',
            'kol',
            'myStatusCampaigns'
        ));
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

        return view('creator.campaign_detail', compact(
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

    public function joinCampaign(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        $kol = Kol::where('id', auth()->user()->kol_id)->first();

        // Attach the kol to the campaign with 'confirmed' status
        $kol->campaigns()->syncWithoutDetaching([
            $request->campaign_id => ['status' => 'confirmed']
        ]);

        return redirect()->route('creator.campaign.index', [
            'tab' => 'confirmed'
        ])
            ->with('success', 'Bạn đã tham gia chiến dịch thành công!');
    }

    public function setting()
    {
        $user = auth()->user();
        $notifications = settings()->get('notifications', []);

        return view('creator.setting', compact('user', 'notifications'));
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
                \Storage::disk('public')->delete($oldPath);
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


    public function profile($username)
    {
        $kol = Kol::where('username', $username)->firstOrFail();

        return view('creator.kol_profile', compact('kol'));
    }
}
