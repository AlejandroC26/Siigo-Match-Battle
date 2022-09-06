<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'cylinder',
        'year',
        'torque',
        'top_speed',
        'weight',
        'name',
        'image',
    ];
}
