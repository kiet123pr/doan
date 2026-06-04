<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // public function send_mail()
    // {
    //     $data = [
    //         'subject' => 'cambo tutorial Mail',
    //         'body' => 'hello this is my email delivery!'
    //     ];
    //     try {
    //         Mail::to('kiet123pr@gmail.com')->send(new MailNotify($data));
    //         return response()->json(['Great check ur mail box']);
    //     } catch (Exception $th) {
    //         return $th->getMessage();
    //     }
    // }
}
