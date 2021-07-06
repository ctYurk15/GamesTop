<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievment_User extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'user_id', 'achievment_id'];
}
