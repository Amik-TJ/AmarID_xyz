<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    // Table Name
    protected $table = 'templates';
    // Primary Key
    public $primaryKey = 'templateID';
    public $timestamps = false;

    protected $fillable = [
        'templateID','frontUrl','backUrl','weight',
    ];
}
