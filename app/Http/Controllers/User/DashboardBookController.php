<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class DashboardBookController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'title' => 'Dashboard Buku',
            'active' => 'Dashboard Buku',
            'books' => Book::where('user_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    public function show(Book $book): View
    {
        return view('dashboard.show', [
            'title' => 'Dashboard Detail',
            'active' => 'Dashboard Detail',
            'book' => $book,
        ]);
    }

    public function create(): View
    {
        return view('dashboard.create', [
            'title' => 'Dashboard Detail',
            'active' => 'Dashboard Detail',
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:books',
            'category_id' => 'required',
            'description' => 'required',
            'rating' => 'required|numeric',
            'book' => 'required|file|mimes:pdf|max:100000',
            'cover' => 'required|image|file|mimes:png,jpg,jpeg,svg|max:20000',
            'user_id' => 'required',
        ]);

        // mengubah nama file
        $bookName = time() . '.' . $request->book->getClientOriginalExtension();
        $coverName = time() . '.' . $request->cover->getClientOriginalExtension();

        // simpan file yang di upload ke folder storage/public/app/books atau storage/public/app/covers
        if ($request->hasFile('book') && $request->hasFile('cover')) {
            $request->file('book')->storeAs('public/books', $bookName);
            $request->file('cover')->storeAs('public/covers', $coverName);

            $validated['book'] = $bookName;
            $validated['cover'] = $coverName;
        }

        // simpan data ke database
        Book::create($validated);

        return redirect()->route('dashboard.books.books.index')->with('success', 'berhasil menambah buku');
    }

    public function edit(Book $book): View
    {
        return view('dashboard.edit', [
            'title' => 'Ubah',
            'active' => 'Ubah',
            'categories' => Category::all(),
            'book' => $book,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'rating' => 'required|numeric',
            'book' => 'required|file|mimes:pdf|max:100000',
            'cover' => 'required|image|file|mimes:png,jpg,jpeg,svg|max:20000',
            'user_id' => 'required',
        ];

        // jika slug saat ini berbeda dengan slug yang ada pada tabel, lakukan validasi
        if ($request->slug != $book->slug) {
            $rules['slug'] = 'required|unique:books';
        }

        // validasi data
        $validated = $request->validate($rules);

        $bookName = time() . '.' . $request->file('book')->extension();
        $coverName = time() . '.' . $request->file('cover')->extension();

        // jika ada file cover dan book, upload file ke storage dan juga hapus file yang lama
        if ($request->hasFile('cover') && $request->hasFile('book')) {
            $validated['book']->storeAs('public/books', $bookName);
            $validated['cover']->storeAs('public/covers', $coverName);

            $validated['book'] = $bookName;
            $validated['cover'] = $coverName;

            if ($request->oldcover && $request->oldbook) {
                Storage::delete($request->oldcover);
                Storage::delete($request->oldbook);
            }
        }

        // update data
        Book::where('slug', $book->slug)->update($validated);

        return redirect()->route('dashboard.books.books.index')->with('success', 'berhasil mengubah buku');
    }

    public function destroy($id): RedirectResponse
    {
        // dapatkan buku berdasarkan id yang sesuai
        $book = Book::findOrFail($id);

        // hapus file yang berada di storage
        Storage::delete($book->cover);
        Storage::delete($book->book);

        // hapus data yang ada di tabel
        $book->delete();

        return redirect()->route('dashboard.books.books.index')->with('success', 'berhasil menghapus data');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Book::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
