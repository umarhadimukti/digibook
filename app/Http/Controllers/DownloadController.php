<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function public_download(Request $request)
    {
        // cek apakah ada file di public storage
        if (Storage::disk('public')->exists('books/' . $request->book)) {
            // temukan path file nya
            $file_path = Storage::path('/public/books/' . $request->book);
            // ambil file nya
            $content = file_get_contents($file_path);   

            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($file_path)
            ]);
        }

        return redirect('/404');
    }
}
