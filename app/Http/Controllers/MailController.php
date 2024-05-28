<?php

namespace App\Http\Controllers;

use App\Helpers\EmailSender;
use Illuminate\Http\Request;

class MailController extends Controller
{
    use EmailSender;

    public function sendEmail(Request $request)
    {
        $this->sendCVEmail($request);
    }
}
