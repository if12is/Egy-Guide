<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category_image')
            ->singleFile();
    }
}
