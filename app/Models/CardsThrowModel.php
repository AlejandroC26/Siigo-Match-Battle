<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsThrowModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'fk_cards_match',
        'fk_rounds_match',
    ];
}
