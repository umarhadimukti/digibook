<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('dashboard.categories.index', [
            'title' => 'Dashboard Kategori',
            'active' => 'Dashboard Kategori',
            'categories' => Category::all(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.categories.create', [
            'title' => 'Buat Kategori',
            'active' => 'Buat Kategori',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|min:3|unique:categories',
            'slug' => 'required|unique:categories',
            'image' => 'required|image|file|mimes:png,jpg,jpeg,svg|max:5000'
        ]);

        $imageName = time() . '.' . $request->file('image')->extension();

        if ($request->hasFile('image')) {
            $validate['image'] = $request->file('image')->storeAs('category-images', $imageName);
        }

        Category::create($validate);

        return redirect()->route('dashboard.categories.categories.index')->with('success', 'berhasil menambahkan kategori baru');
    }

    public function edit(Category $category): View
    {
        return view('dashboard.categories.edit', [
            'title' => 'Ubah Kategori',
            'active' => 'Ubah Kategori',
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|min:3',
            'image' => 'required|image|file|mimes:png,jpg,jpeg,svg|max:5000'
        ];

        // jika slug saat ini berbeda dengan slug yang ada pada tabel, lakukan validasi
        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        // validasi request yang masuk
        $validate = $request->validate($rules);

        // generate nama random berdasarkan waktu saat ini
        $imageName = time() . '.' . $request->file('image')->extension();

        // jika request file image ada, simpan file image ke dalam public storage & hapus file lama
        if ($request->hasFile('image')) {
            $validate['image'] = $request->file('image')->storeAs('category-images', $imageName);

            if ($request->oldimage) {
                Storage::delete($request->oldimage);
            }
        }

        // update data
        Category::where('slug', $category->slug)->update($validate);

        return redirect()->route('dashboard.categories.categories.index')->with('success', 'berhasil mengubah kategori');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // hapus image yang ada di storage
        Storage::delete($category->image);

        // hapus data yang ada di tabel
        $category->delete();

        return redirect()->route('dashboard.categories.categories.index')->with('success', 'berhasil menghapus kategori');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
