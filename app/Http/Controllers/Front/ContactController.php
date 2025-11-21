<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{
    public function index()
    {
        if (! auth()->user()->can('contacts.view')) {
            abort(403);
        }

        $contacts = Contact::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%')
              ->orWhere('email', 'like', '%' . request('search') . '%')
              ->orWhere('phone', 'like', '%' . request('search') . '%');
        })->orderBy('created_at', 'desc')->paginate(20);

        return view('backend.contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'phone' => [
                'required',
                'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[1-9]|9[0-9])[0-9]{7}$/'
            ],
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.min' => 'Họ tên phải có ít nhất 2 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
        ]);

        if ($validator->fails()) {
            $msg = '';
            foreach($validator->getMessageBag()->toArray() as $e) {
                $msg .= '<span class="contact_error">'.$e[0].'</span><br>';
            }
            return response()->json([
                'success' => false,
                'msg' => $msg,
            ]);
        }

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'msg' => '<span class="contact_success">Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi bạn trong vòng 24 giờ.</span>'
        ]);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if($contact) {
            $contact->delete();
        }

        flash(__('Record ":model" deleted', ['model' => $contact->name]), 'success');

        return redirect()->back();
    }
}
