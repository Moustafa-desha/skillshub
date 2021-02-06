<?php

namespace App\Http\Controllers;
use App\Models\message;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){

        $data['sett'] = Setting::select('email','phone')->first();

        return view('web.contact.index')->with($data);
    }

    public function send(Request $request){

                        $validator = Validator::make($request->all(),[
                            'name'  => 'required |string | max:255',
                            'email' => 'required |email |max:255',
                            'text'  => 'nullable |string |max:255',
                            'body'  => 'required |string|max:1500',
                        ]);
                        
                        if ($validator->fails()) {
                            $errors = $validator->errors();
                            return redirect( url('contact') )->withErrors($errors);
                        }

                        Message::create([
                                 
                                 'name' => $request->name,
                                 'email' => $request->email,
                                 'subject' => $request->subject,
                                 'body' => $request->body,
                        ]);
                        $request->session()->flash('success', 'Your message send successfully');
                        return back();

    }

}
