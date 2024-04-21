<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactMeRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    //
    public function showForm()
    {
        return view('blog.contact');
    }

    /**
     * 发送消息
     */
    public function sendContactInfo(ContactMeRequest $request)
    {
        $data = $request->only('name','email','phone');
        $data['messageLines'] = explode("\n",$request->get('message'));
        // Mail::to($data['email'])->send(new ContactMail($data));
        //数据库队列
        Mail::to($data['email'])->queue(new ContactMail($data));

        return back()->with("success","消息已发送,感谢您的反馈");
    }
}
