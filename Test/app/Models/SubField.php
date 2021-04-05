<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubField extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'sub_field';
    // Primary Key
    public $primaryKey = 'subFieldID';
    public $timestamps = false;
}
