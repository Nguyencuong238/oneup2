<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Kol;
use App\Models\KolStat;
use App\Models\KolContent;
use App\Models\TiktokSyncLog;
use Carbon\Carbon;

class SyncTiktokProfiles extends Command
{
    protected $signature = 'tiktok:sync-profiles';
    protected $description = 'Đồng bộ thông tin hồ sơ TikTok (profile + posts) từ RapidAPI và lưu video thumbnail.';

    public function handle()
    {
        $this->info('=== 🚀 Bắt đầu đồng bộ thông tin TikTok ===');

        // ✅ Tạo bản ghi log cho lần chạy này
        $log = TiktokSyncLog::create([
            'started_at' => now(),
        ]);

        $kols = Kol::where('platform_id', 'Tiktok')
            ->whereNotNull('username')
            ->get();

        $total = $kols->count();
        $success = 0;
        $failed = 0;
        $errors = [];

        $log->update(['total_kols' => $total]);

        foreach ($kols as $kol) {
            $this->info("➡️  Đang xử lý: {$kol->username}");

            try {
                // 1️⃣ Lấy thông tin user
                $userResponse = Http::withHeaders([
                    'x-rapidapi-host' => 'tiktok-api23.p.rapidapi.com',
                    'x-rapidapi-key' => env('RAPIDAPI_KEY'),
                ])->get('https://tiktok-api23.p.rapidapi.com/api/user/info', [
                    'uniqueId' => $kol->username,
                ]);

                if ($userResponse->failed()) {
                    $this->error("❌ API lỗi (user): " . $userResponse->body());
                    $failed++;
                    $errors[] = ['kol' => $kol->username, 'error' => 'User API failed'];
                    continue;
                }

                $data = $userResponse->json();
                $userInfo = $data['userInfo'] ?? ($data['data']['userInfo'] ?? null);
                if (empty($userInfo)) {
                    $this->warn("⚠️ Không lấy được userInfo cho {$kol->username}");
                    $failed++;
                    continue;
                }

                $user = $userInfo['user'] ?? null;
                $statsProfile = $userInfo['stats'] ?? null;
                if (!$user || !$statsProfile) {
                    $this->warn("⚠️ Không đủ dữ liệu user/stats cho {$kol->username}");
                    $failed++;
                    continue;
                }

                // ✅ Cập nhật thông tin KOL
                $kol->update([
                    'display_name' => $user['nickname'] ?? $kol->display_name,
                    'bio' => $user['signature'] ?? $kol->bio,
                    'is_verified' => $user['verified'] ?? $kol->is_verified,
                    'followers' => $statsProfile['followerCount'] ?? 0,
                    'following' => $statsProfile['followingCount'] ?? 0,
                    'total_likes' => $statsProfile['heartCount'] ?? 0,     
                ]);

                if (empty($kol->sec_uid) && isset($user['secUid'])) {
                    $kol->sec_uid = $user['secUid'];
                    $kol->save();
                }

                sleep(1);

                // 2️⃣ Lấy danh sách video (có phân trang)
                $cursor = 0;
                $hasMore = true;
                $totalVideos = 0;

                while ($hasMore) {
                    $params = ['count' => 35, 'cursor' => $cursor];
                    $params[!empty($kol->sec_uid) ? 'secUid' : 'uniqueId'] = $kol->sec_uid ?? $kol->username;

                    $postsResponse = Http::withHeaders([
                        'x-rapidapi-host' => 'tiktok-api23.p.rapidapi.com',
                        'x-rapidapi-key' => env('RAPIDAPI_KEY'),
                    ])->get('https://tiktok-api23.p.rapidapi.com/api/user/posts', $params);

                    if ($postsResponse->failed()) {
                        $this->error("❌ API lỗi (posts): " . $postsResponse->body());
                        break;
                    }

                    $postsJson = $postsResponse->json();
                    $posts = $postsJson['data']['itemList'] ?? [];
                    $hasMore = $postsJson['data']['hasMore'] ?? false;
                    $cursor = $postsJson['data']['cursor'] ?? null;

                    if (empty($posts)) {
                        break;
                    }

                    foreach ($posts as $item) {
                        $video = $item['video'] ?? [];
                        $stats = $item['stats'] ?? [];

                        $thumbnailUrl = $video['cover'] ?? $video['originCover'] ?? $video['dynamicCover'] ?? null;
                        $videoUrl = $video['playAddr'] ?? ($video['PlayAddrStruct']['UrlList'][0] ?? null);
                        $description = $item['desc'] ?? '';
                        $hashtags = array_column($item['challenges'] ?? [], 'title');
                        $likes = (int)($stats['diggCount'] ?? 0);
                        $comments = (int)($stats['commentCount'] ?? 0);
                        $shares = (int)($stats['shareCount'] ?? 0);
                        $views = (int)($stats['playCount'] ?? 0);
                        $engagementRate = $views > 0
                            ? round((($likes + $comments + $shares) / $views) * 100, 2)
                            : 0;

                        KolContent::updateOrCreate(
                            [
                                'kol_id' => $kol->id,
                                'platform_post_id' => $item['id'] ?? null,
                            ],
                            [
                                'content_type' => 'video',
                                'title' => $description,
                                'description' => $description,
                                'hashtags' => $hashtags,
                                'thumbnail_url' => $thumbnailUrl,
                                'video_url' => $videoUrl,
                                'duration_seconds' => $video['duration'] ?? null,
                                'posted_at' => isset($item['createTime'])
                                    ? Carbon::createFromTimestamp($item['createTime'])
                                    : null,
                                'likes_count' => $likes,
                                'comments_count' => $comments,
                                'shares_count' => $shares,
                                'views_count' => $views,
                                'engagement_rate' => $engagementRate,
                            ]
                        );

                        $totalVideos++;
                    }

                    $this->info("📄 Lấy được " . count($posts) . " video (cursor: {$cursor})");
                    sleep(2);

                    if (!$hasMore) break;
                }

                // 3️⃣ Cập nhật followers/following
                KolStat::updateOrCreate(
                    ['kol_id' => $kol->id],
                    [
                        'followers_count' => $statsProfile['followerCount'] ?? 0,
                        'following_count' => $statsProfile['followingCount'] ?? 0,
                        'recorded_at' => now(),
                    ]
                );

                $this->info("✅ Hoàn tất {$kol->display_name}: {$totalVideos} video.");
                $success++;
                sleep(2);
            } catch (\Exception $e) {
                $failed++;
                $errors[] = ['kol' => $kol->username, 'error' => $e->getMessage()];
                Log::error("Sync error for {$kol->username}: " . $e->getMessage());
                $this->error("💥 Lỗi: " . $e->getMessage());
            }
        }

        // ✅ Cập nhật lại log sau khi hoàn tất
        $log->update([
            'finished_at' => now(),
            'success_count' => $success,
            'failed_count' => $failed,
            'error_messages' => $errors,
        ]);

        $this->info('=== ✅ Hoàn tất đồng bộ TikTok ===');
    }
}
