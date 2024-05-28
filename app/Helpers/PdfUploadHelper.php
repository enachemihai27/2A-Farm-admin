<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait PdfUploadHelper {

    public function upload(Request $request, $inputName, $path)
    {
        if($request->hasFile( $inputName)){
            $pdf = $request->{$inputName};
            $pdfName = $pdf->getClientOriginalName();
            $pdf->move(public_path($path), $pdfName);
            return $path.'/'.$pdfName;
        }
    }
}
