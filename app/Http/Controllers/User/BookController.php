<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        return view('user.books', [
            'title' => 'Semua Buku',
            'active' => 'books',
            'books' => Book::all(),
            'books_latest' => Book::latest()->get(),
            'books_filter' => Book::latest()->filter(request(['keyword']))->get(),
        ]);
    }

    public function show(Book $book): View
    {
        return view('user.book', [
            'title' => $book->title,
            'active' => 'book details',
            'book' => $book,
        ]);
    }
}
