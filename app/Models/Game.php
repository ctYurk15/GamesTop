<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Developer;
use App\Models\GalleryImage;
use App\Models\Comment;

class Game extends Model
{
    use HasFactory;
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category__games');
    }
    
    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }
    
    public function gallery()
    {
        return $this->hasMany(GalleryImage::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
