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

            //check if file is a pdf and have max 25MB
            $request->validate([
                'attachment' => 'file|mimes:pdf|max:25600', // max:25600 for 25 MB (25600 KB)
            ]);

            //upload temporally file
            $path = $this->upload($request, 'attachment', 'uploads');

            // Send email with attachment
            Mail::to($to)->send(new MailableClass($details, $path));

            //delete file
            File::delete(public_path($path));
        }

         return response()->json(['message' => 'Email send successfully!']);
    }
}
