<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predesigned extends Model
{
    // Table Name
    protected $table = 'predesigned';
    // Primary Key
    public $primaryKey = 'designID';
    public $timestamps = false;

    protected $fillable = [
        //'username',
        'designID',
        'json',
        'frontUrl',
        'backUrl',
        'weight',
    ];
}
