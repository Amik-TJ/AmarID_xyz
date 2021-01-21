<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'field';
    // Primary Key
    public $primaryKey = 'fieldID';
    public $timestamps = false;

}
