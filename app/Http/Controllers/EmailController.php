<?php

namespace App\Http\Controllers;

use App\Mail\IdentifyMail;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
   public function sendEmail(){
    $toMail = "gganosh9@gmail.com";
    $message = "This is a test email from Laravel.";
    $subject = "Test Email";

    Mail::to($toMail)->send(new IdentifyMail($message, $subject));

    return "Email sent successfully!";
}
}
