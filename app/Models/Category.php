<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title'];
    
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
    
}
