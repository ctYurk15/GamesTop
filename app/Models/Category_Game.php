<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Game extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'game_id', 'category_id'];
}
