<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\ContactResponseMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index() {


            $data['messages'] = Message::orderBy('id', 'DESC')->paginate(10);

            return view('admin.messages.index')->with($data);
    }

    
    public function show(Message $message) {

            $data['message'] = $message;

            return view('admin.messages.show')->with($data);
    }


    public function response(Message $message, Request $request) {

        $request->validate([

            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // هنا بنجيب اميل المستلم من الميل المرسل بيه الرساله وكل بياناته
        $receiverMail = $message->email;
        $receiverName = $message->name;

        // دى بترسل الميل للشخص اللى ارسل عن طريق ميله الموجود ف الرساله وبنرد عليه بياناته ف الرساله
        Mail::to($receiverMail)->send(
            new ContactResponseMail($receiverName, $request->title, $request->body)
        );

        return redirect( url("dashboard/messages") );
    }
}
