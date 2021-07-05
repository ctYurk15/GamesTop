<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['count', 'game_id', 'user_id'];
    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    
    public function total_price()
    {
        return $this->game->price * $this->count;
    }
}
