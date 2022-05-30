<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{
    use HasFactory;

    use Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title', 'body'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($query, $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) => 
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('body', 'like', '%' . $search . '%')
                )
            );

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category));
        });

        $query->when($filters['tag'] ?? false, function ($query, $tag) {
            $query->whereHas('tags', fn($query) => 
                $query->where('slug', $tag));
        });
    }
}
