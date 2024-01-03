<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('user.profile', [
            'title' => 'Profil Saya',
            'active' => 'profile',
        ]);
    }

    public function export_pdf()
    {
        $data['books'] = Book::all();
        $pdf = Pdf::loadView('pdf.cetakbuku', $data);
        return $pdf->download(time() . 'digibook_databuku.pdf');
    }
}
