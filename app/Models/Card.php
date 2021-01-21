<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    // Table Name
    protected $table = 'card_registration';
    // Primary Key
    public $primaryKey = 'cardID';
    public $timestamps = false;
}
