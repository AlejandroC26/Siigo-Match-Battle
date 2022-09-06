<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoundsMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user_match',
        'charasteristic',
    ];
}
