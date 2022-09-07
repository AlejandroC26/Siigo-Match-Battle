<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsMatchModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'fk_card',
        'fk_user_match',
    ];
    protected $table = "cards_match";

}
