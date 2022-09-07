<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'cylinder',
        'year',
        'torque',
        'top_speed',
        'weigth',
        'name',
        'image',
    ];
}
