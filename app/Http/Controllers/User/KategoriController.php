<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index(): View
    {
        return view('user.categories', [
            'title' => 'Kategori',
            'active' => 'categories',
            'categories' => Category::all(),
        ]);
    }

    public function show(Category $category): View
    {
        return view('user.books', [
            'title' => "Kategori {$category->name}",
            'active' => 'book category',
            'books' => $category->books,
            'books_latest' => $category->books->load('category', 'user')
        ]);
    }
}
