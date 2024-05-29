<?php

namespace App\Helpers;


use App\Mail\MailableClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

trait EmailSender
{
    use PdfUploadHelper;

    public function sendCVEmail(Request $request)
    {
        $details = [
            'title' => 'CV jobs'
        ];

        $to = env("MAIL_TO");

        // Check if the request has a file attachment
        if ($request->hasFile('attachment')) {

            //upload temporally file
            $path = $this->upload($request, 'attachment', 'uploads');

            // Send email with attachment
            Mail::to($to)->send(new MailableClass($details, $path));

            //delete file
            File::delete(public_path($path));
        }

        return '<h1>Successfully!</h1>';
    }
}
