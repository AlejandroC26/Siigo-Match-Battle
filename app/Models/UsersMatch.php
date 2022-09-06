<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersMatch extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'state',
        'fk_user',
        'fk_match',
    ];
}
