<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'images',
        'featured_image',
        'status',
        'published_at',
        'author_id',
    ];

    protected $casts = [
        'images' => 'array',
        'published_at' => 'datetime',
        'status' => PostStatus::class,
    ];

    // Author relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Event: before creating a new post
        static::creating(function ($post) {
            // Auto-generate slug if not provided
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
