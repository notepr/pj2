<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response;

class LoadCvController extends Controller {
    public function ShowCv() {
        $filename = 'Hoang_Van_Duong.pdf';
        return Response::make(Storage::disk('local')->get('Hoang_Van_Duong.pdf'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
