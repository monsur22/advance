<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'desc', 'slug', 'is_published'];


    // Local scope

    // public function scopePublished($query)
    // {
    //     return $query->where('is_published', true);
    // }

    // global scope
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('is_published', true);
        });

        // static::observe(PostObserver::class);
    }
}
