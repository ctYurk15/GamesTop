<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Developer;

class Game extends Model
{
    use HasFactory;
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }
    
}
