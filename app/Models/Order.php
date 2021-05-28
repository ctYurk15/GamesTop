<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['count'];
    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
