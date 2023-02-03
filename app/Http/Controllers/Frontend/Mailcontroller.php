<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Mailcontroller extends Controller
{
    public function contactpost(Request $request)
    {  

       $from = $request->input('from');
       $to = $request->input('to');
       $firstname = $request->input('firstname');
       $lastname = $request->input('lastname');
       $email = $request->input('email');
       $mobilenumber = $request->input('mobilenumber');
       $message = $request->input('message');
       $data = array(
        'from' => $from,
        'to' => $to, 
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'mobilenumber' =>$mobilenumber,
        'messages' => $request->message,
       );
        Mail::send('email-template', $data, function($message) use($data){
        $message->to('hotelpushp.np@gmail.com');
        $message->subject($data['messages']);
        $message->from($data['email']);

       });
       return redirect('/')->with('status','Your message has been send successfully.');
   
    }
    public function contactmessage(Request $request)
    {  

       
       $firstname = $request->input('firstname');
       $lastname = $request->input('lastname');
       $email = $request->input('email');
      
       $message = $request->input('message');
       $data = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'messages' => $request->message,
       );
        Mail::send('email-template', $data, function($message) use($data){
        $message->to('anddhital@gmail.com');
        $message->subject($data['messages']);
        $message->from($data['email']);

       });
       return redirect('/')->with('status','Your message has been send successfully.');
   
    }
};
