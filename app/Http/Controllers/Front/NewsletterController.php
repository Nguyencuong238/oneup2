<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Validator;

class NewsletterController extends Controller
{
    public function index()
    {
        if (! auth()->user()->can('newsletters.view')) {
            abort(403);
        }

        $newsletters = Newsletter::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })->paginate();

        return view('backend.newsletters.index', compact('newsletters'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			// 'name' => ['required', 'min:1'],
            'email' => ['email'], //'unique:newsletters,email'
            'phone' => [
                // 'required',
                'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[1-9]|9[0-9])[0-9]{7}$/'
            ],
        ]);

        if ($validator->fails()) {
            $msg = '';
            foreach($validator->getMessageBag()->toArray() as $e) {
                $msg .= '<span class="contact_error">'.$e[0].'</span>';
            }
            return response()->json([
                'success' => false,
                'msg' => $msg,
            ]);
        }

        // if (! Newsletter::where('email', $request->email)->exists()) {
            Newsletter::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'message' => $request->message,
            ]);
        //}
        return response()->json([
            'success' => true,
            'msg' => '<span class="contact_success">Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi bạn trong vòng 24 giờ.</span>'
        ]);
    }

    public function destroy($id) {
        $newsletter = Newsletter::find($id);

        if($newsletter) {
            $newsletter->delete();
        }
        
        flash(__('Record ":model" deleted', ['model' => $newsletter->name]), 'success');

        return redirect()->back();
    }
}
