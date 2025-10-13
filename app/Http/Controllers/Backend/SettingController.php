<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function home()
    {
        if (! auth()->user()->can('setting.home')) {
            abort(403);
        }

        $categoryId = settings('menu_category_id', []);

        $categories = collect();

        if (count($categoryId) > 0) {
            $categories = Category::with(['ancestors' => function ($q) {
                $q->breadthFirst();
            }])->orderByRaw('FIELD(id,' . implode(',', $categoryId) . ')')->get();
        }else{
            $categories = Category::with(['ancestors' => function ($q) {
                $q->breadthFirst();
            }])->get();
        }

        return view('backend.settings.home', compact('categories'));
    }

    public function saveHome(Settings $settings, Request $request)
    {
        if (! auth()->user()->can('setting.home')) {
            abort(403);
        }

        $settings->put($request->all());

        flash(__('Setting updated'), 'success');

        return redirect()->back();
    }
}
