<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KolFavorite;
use Illuminate\Support\Facades\Auth;

class KolFavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $userId = Auth::id();
        $kolId = $request->kol_id;

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập trước.'], 401);
        }

        // Kiểm tra đã favorite chưa
        $favorite = KolFavorite::where('user_id', $userId)
            ->where('kol_id', $kolId)
            ->first();

        if ($favorite) {
            // Nếu đã có thì bỏ yêu thích
            $favorite->delete();
            return response()->json(['success' => true, 'favorited' => false]);
        } else {
            // Nếu chưa có thì thêm mới
            KolFavorite::create([
                'user_id' => $userId,
                'kol_id' => $kolId,
            ]);
            return response()->json(['success' => true, 'favorited' => true]);
        }
    }
}
