<?php

namespace App\Http\Controllers;

use Mail;
use App\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function create(){
        return view('home');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject'=> 'required',
            'message' => 'required'
        ]);


        try {

            Mail::send('emails.contact-message', [
                'msg' => $request->message
            ], function($mail) use($request) {
                $mail->from($request->email, $request->name);
    
                $mail->to('jhaytechnology@gmail.com')->subject('Contact Message');
            });
            
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

       
         $home = new Home;
         $home ->name =$request->input('name');
         $home->email = $request->input('email');
         $home->subject = $request->input('subject');
         $home->message = $request->input('message');
         $home-> save();
        

        if($request->ajax())
            return response()->json(['message'=>'OK'], 200);

        return back()->with('flash_message','Thank you for your message.');
    }
} 

