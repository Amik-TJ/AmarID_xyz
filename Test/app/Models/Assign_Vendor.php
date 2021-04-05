<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_Vendor extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'assign_vendor';
    // Primary Key
    public $primaryKey = 'orderID';
    public $timestamps = false;
}
