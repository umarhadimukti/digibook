<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    // mass assignment guard id
    protected $guarded = ['id'];

    // eager loading ketika terdapat query yang memiliki relasi dengan tabel user dan category
    protected $with = [
        'user',
        'category'
    ];

    // query scope (local)
    public function scopeFilter(Builder $query, array $filters): void
    {
        // jika ada request pencarian, maka cari buku berdasarkan keyword
        $query->when($filters['keyword'] ?? false, function ($query, $keyword) {
            $query->where("title", "like", "%" . $keyword . "%")->orWhere("excerpt", "like", "%" . $keyword . "%")->orWhere("description", "like", "%" . $keyword . "%");
        });

        // jika ada request kategori, maka cari buku berdasarkan kategori
        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', fn ($query) => $query->where('slug', $category));
        });
    }

    public function scopeCategories(Builder $query, $category): void
    {
        // jika ada request kategori, maka cari buku berdasarkan kategori
        $query->when($category ?? false, function ($query, $category) {
            $query->whereHas('category', fn ($query) => $query->where('slug', $category));
        });
    }

    // relasi belongs to dengan tabel user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relasi belongs to dengan tabel category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
