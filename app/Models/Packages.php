<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    // Table Name
    protected $table = 'packages';
    // Primary Key
    public $primaryKey = 'packageID';
    public $timestamps = false;
}
