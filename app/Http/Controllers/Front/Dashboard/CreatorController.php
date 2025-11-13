<?php

namespace App\Http\Controllers\Front\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\KolService;
use App\Models\Kol;
use App\Models\KolBooking;
use App\Models\TiktokSyncLog;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        $campaign = Campaign::find($request->campaign_id);
        
        ActionLog::create([
            'user_id' => auth()->id(),
            'action' => "KOL '{$kol->display_name}' đã tham gia chiến dịch '{$campaign->name}'",
            'record_at' => now(),
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


    public function profile($username)
    {
        $kol = Kol::where('username', $username)->firstOrFail();

        // --- Lấy dữ liệu TiktokSyncLog cho biểu đồ (30 ngày gần đây) ---
        $syncLogs = TiktokSyncLog::where('kol_id', $kol->id)
            ->where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        $chartData = [];
        foreach ($syncLogs as $date => $logs) {
            $chartData[] = [
                'date' => $date,
                'followers' => $logs->last()->followers ?? 0,
                'likes_count' => $logs->sum('likes_count'),
                'comments_count' => $logs->sum('comments_count'),
                'shares_count' => $logs->sum('shares_count'),
            ];
        }

        return view('creator.kol_profile', compact('kol', 'chartData'));
    }

    public function services()
    {
        $kol = Kol::where('id', auth()->user()->kol_id)->firstOrFail();
        $services = $kol->services()->latest()->get();

        return view('creator.services.index', compact('kol', 'services'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $kol = Kol::where('id', auth()->user()->kol_id)->firstOrFail();
        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('kol_services', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $kol->services()->create($data);

        return redirect()->back()->with('success', 'Đã thêm dịch vụ thành công!');
    }

    public function updateService(Request $request, $id)
    {
        $kol = Kol::where('id', auth()->user()->kol_id)->firstOrFail();
        $service = $kol->services()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            // xóa ảnh cũ nếu có
            if ($service->image) {
                $oldPath = str_replace('/storage/', '', $service->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('kol_services', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $service->update($data);

        ActionLog::create([
            'user_id' => auth()->id(),
            'action' => "KOL '{$kol->display_name}' đã tạo dịch vụ '{$service->name}'",
            'record_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Cập nhật dịch vụ thành công!');
    }

    public function deleteService($id)
    {
        $kol = Kol::where('id', auth()->user()->kol_id)->firstOrFail();
        $service = $kol->services()->findOrFail($id);

        $serviceName = $service->name;

        if ($service->image) {
            $oldPath = str_replace('/storage/', '', $service->image);
            Storage::disk('public')->delete($oldPath);
        }

        $service->delete();

        ActionLog::create([
            'user_id' => auth()->id(),
            'action' => "KOL '{$kol->display_name}' đã xóa dịch vụ '{$serviceName}'",
            'record_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Đã xóa dịch vụ.');
    }

    public function creatorBooking()
    {
        $kolId = auth()->user()->kol?->id;

        if (!$kolId) {
            abort(403, 'Bạn không phải là KOL.');
        }

        $bookings = KolBooking::with(['user', 'service'])
            ->where('kol_id', $kolId)
            ->latest()
            ->paginate(10);

        return view('creator.booking.index', compact('bookings'));
    }

    public function updateBooking(Request $request, $id)
    {
        $kolId = auth()->user()->kol?->id;

        if (!$kolId) {
            abort(403, 'Bạn không phải là KOL.');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $booking = KolBooking::where('kol_id', $kolId)->findOrFail($id);

        $booking->update([
            'status' => $request->status,
        ]);

        ActionLog::create([
            'user_id' => auth()->id(),
            'action' => "KOL '" . auth()->user()->name . "' đã " . 
                        ($request->status === 'approved' ? 'duyệt' : 'từ chối') . 
                        " booking #{$booking->id}",
            'record_at' => now(),
        ]);

        return redirect()
            ->route('creator.bookings.index')
            ->with('success', 'Cập nhật trạng thái thành công!');
    }

}
